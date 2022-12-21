<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Exports\ExportCustomer;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\HeadingRowImport;
use Session;
use App\MailService;
use Redirect;
use DB;
use Input;
use Response;
use Auth;
use Hash;
use Validator;
use View;
use Mail;
use Config;
use Carbon\Carbon;

use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;

use App\BusinessCompanyDetail;
use App\BusinessServices;
use App\User;
use App\Customer;
use App\CustomerFamilyDetail;

use Request as resAll;

class CustomerController extends Controller {
	/**
     * The user repository instance.
     *
     * @var CustomerRepository
     */

 	protected $customers;
 	protected $users;
    public $error = '';
 	public function __construct(CustomerRepository $customers,UserRepository $users) {
        $this->customers = $customers;
        $this->middleware('auth');
        $this->users = $users;
     
    }

    public function manage_customer (Request $request){
        $companyId = !empty(Auth::user()->cid) ? Auth::user()->cid : "";
        $companyservice  =[];
        if(!empty($companyId)) {
             $business_details = BusinessCompanyDetail::where('cid', $companyId)->get();
              $business_details = isset($business_details[0]) ? $business_details[0] : [];
            $companyservice = BusinessServices::where('userid', Auth::user()->id)->where('cid', $companyId)->orderBy('id', 'DESC')->get();
        }

        $customer_data = Customer::getcustomerofthiscompany($companyId );
        $orderedcustomers= array();
		foreach ($customer_data as $topic) {
		  $orderedcustomers[strtoupper($topic['fname'][0])][] = $topic;
		}
        $html = '';
        if($request->ajax()){
            $data_cus = $this->customers->findByfname($request->inpuval); 
            $data_cusary= array();
            foreach ($data_cus as $topic) {
              $data_cusary[strtoupper($topic['fname'][0])][] = $topic;
            }
            $html .= '<div class="total-clients">
                        <i class="fas fa-user-circle"></i>
                        <label>You Have '.count($data_cus).' Clients</label>
                    </div>
                    <div class="panel-group" id="accordion-customer">';
                        $i= 0;
                        foreach ($data_cusary as $section=>$cust) {
                            $html .= '<div class="custom-panel panel panel-default">
                            <div class="custom panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-customer" href="#collapse_'.$i.'"> '.$section.'
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_'.$i.'" class="panel-collapse collapse';
                            if($i == 0){
                                $html .=' show in';
                            }
                            $html .='" data-parent="#accordion-customer">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">';
                                            foreach ($cust as $dt) {
                                                $age = Carbon::parse($dt->birthdate)->age; 
                                            $html .='<div class="collapse-inner-box mrb-2">
                                                <div class="row">
                                                    <div class="col-md-1 col-xs-3 col-sm-1">
                                                        <div class="collapse-img">
                                                            '.$dt->getimage().'
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-xs-8 col-sm-2">
                                                        <div class="client-name">
                                                            <span>'.$dt->fname.' '.$dt->lname.'</span>
                                                            <p>Last Attended: 20/09/2019</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-xs-12 col-sm-1">
                                                        <div class="client-age">
                                                            <span>Age: '.$age.'</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12 col-sm-2">
                                                        <div class="client-status">
                                                            <label>Status: </label>
                                                            
                                                            <span class="green-fonts">';
                                                                if($dt->status == 0)
                                                                    $html .='InActive';
                                                                else
                                                                    $html .='Active';
                                                            $html .='</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-xs-12 col-sm-3">
                                                        <div class="client-status">
                                                            <label>Active Memberships: </label>
                                                            <span class="green-fonts">2</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12 col-sm-2">
                                                        <div class="client-status">
                                                            <label>Expiring Soon: </label>
                                                            <span class="red-fonts">1</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-xs-12 col-sm-1">
                                                        <div class="client-status">
                                                            <a href="'.Config::get('constants.SITE_URL').'/viewcustomer/'.$dt->id.'">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> ';
                                            }                          
                                        $html .='</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $("#collapse_'.$i.'").click(function(){
                                $(".panel-collapse").removeClass(" show in");
                                $("#collapse_'.$i.'").addClass(" show in");
                            });
                        </script>';
                        $i++;  
                       }
                    $html .='</div>';
                    return $html;
        }

		//print_r($orderedcustomers);exit;
        return view('customers.manage-customer', [
            'companyId'=>$companyId,
            'business_details' => $business_details,
            'companyservice' => $companyservice,
            'customers' =>$orderedcustomers,
            'customer_count' => count($customer_data),
        ]); 
    }

    public function searchcustomersaction(Request $request) {
        if($request->get('query'))
        {
            $array_data=array();
            $query = $request->get('query');
          
            $data_cus = $this->customers->findByfname($query); 
           
            foreach($data_cus as $cuss)
            {	
                $array_data [] = array(
	                "name"=>$cuss->fname .' '.$cuss->lname , 
	                "cus_id"=>$cuss->id,
	                "image" => $cuss->profile_pic,
                    "email" => $cuss->email,
                    "phone_number" => $cuss->phone_number,
                    "age" => $cuss->getcustage(),
	            );
            }

            sort($array_data);
          
            $output = '<ul class="customer-list">';
            if(!empty($array_data)){
                foreach($array_data as $row)
                {
                    $output .= '<li class="searchclick" onClick="searchclick('.$row['cus_id'].')">
                        <div class="row rowclass-controller">
                            <div class="col-md-2">';
                            if($row['image'] != ''){
                            	$output .='<img src="'.asset('/customers/images/'.$row['image']).'">';
                            }else{
                            	$output .='<div class="company-profile-img-controller">';
										$pf=substr($row['name'], 0, 1);
								$output .='<p class="img-controller">'.$pf.'</p></div>';
                            }
                            $age = '';
                            if($row['age'] != '—'){
                                $age = '('.$row['age'].'  Years Old)';
                            }

                            $output .='</div>
                            <div class="col-md-10 div-controller">
                                <p class="pstyle">'.$row['name'].' <label class="liaddress">'.$age.'<label></p>
                                <p class="pstyle liaddress">'.$row['email'].'</p>
                                <p class="pstyle liaddress">'.$row['phone_number'].'</p>
                            </div>
                            <input type="hidden" name="cid" id="cid" value="'.$row['cus_id'].'">
                        </div></li>';
                }
            }
            else
            {
                $output .= '<li class="liimage"> ';
                $output .= "Looks like there's no cutomer with that name listed on Fitnessity.</li>";
            }
           
            echo $output;
        }
    }

    public function viewcustomer ($id){
        $companyId = !empty(Auth::user()->cid) ? Auth::user()->cid : "";
        $companyservice  =[];
        if(!empty($companyId)) {
             $business_details = BusinessCompanyDetail::where('cid', $companyId)->get();
              $business_details = isset($business_details[0]) ? $business_details[0] : [];
            $companyservice = BusinessServices::where('userid', Auth::user()->id)->where('cid', $companyId)->orderBy('id', 'DESC')->get();
        }
         $bdate = '—';
        $customerdata = $this->customers->findById($id);
        if(@$customerdata->birthdate != null){
            $date =  new Carbon($customerdata->birthdate);
            $bdate = $date->format('F jS\,  Y');
        }
       
        $sincedate = date('m/d/Y',strtotime(@$customerdata->created_at));
        $location = '';
        $address = '';
        if(@$customerdata->address != ''){
            $address .= @$customerdata->address.', ';
        }
        if(@$customerdata->city != ''){
            $address .= @$customerdata->city.', ';
        }
        if(@$customerdata->state != ''){
            $address .= @$customerdata->state.' '.@$customerdata->zipcode.', ';
            $location .= @$customerdata->state.', ';
        }
        if(@$customerdata->country != ''){
            $address .= @$customerdata->country;
            $location .= @$customerdata->country;
        }

        if($address == ''){
            $address = '—';
        }else if($address == 'US'){
            $address = 'United States';
        }

        if($location == ''){
           $location = '—'; 
        }else if($location == 'US'){
            $location = 'United States';
        }

        $cardInfo = [];
        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        if($customerdata->stripe_customer_id != ''){
            $savedEvents = $stripe->customers->allSources(
                $customerdata->stripe_customer_id,
                ['object' => 'card' ,'limit' => 30]
            );
            $savedEvents  = json_decode( json_encode( $savedEvents),true);
            $cardInfo = $savedEvents['data'];
        }

        $ageval = ($customerdata != '') ? @$customerdata->getcustage() : "—";
        $familydata = $customerdata->get_families();

        $strpecarderror = '';
        if (session()->has('strpecarderror')) {
            $strpecarderror = Session::get('strpecarderror');
        }
        return view('customers.viewcustomer', [
             'business_details' => $business_details,
            'companyservice' => $companyservice,
            'customerdata'=>$customerdata,
            'bdate'=>$bdate,
            'age'=> $ageval,
            'sincedate'=>$sincedate,
            'address'=>$address,
            'location'=>$location,
            'familydata'=>$familydata,
            'cardInfo'=>$cardInfo,
            'strpecarderror'=>$strpecarderror,
        ]);
        //return view('profiles.viewcustomer');
    }

    public function export(Request $request)
    {   
        return Excel::download(new ExportCustomer($request->id,$request->chk), 'customer.xlsx');
    }

    public function sendemailtocutomer(Request $request){
       $status =  MailService::sendEmailVerifiedAcknowledgementcustomer($request->cid,$request->bid);
        //print_r($request->all());exit;
       return  $status;
    }

    public function importcustomer(Request $request)
    {
        if($request->hasFile('import_file')){
            $ext = $request->file('import_file')->getClientOriginalExtension();
            if($ext != 'csv' && $ext != 'csvx' && $ext != 'xls' && $ext != 'xlsx' )
            {
                return response()->json(['status'=>500,'message'=>'File format is not supported.']);
            }
            ini_set('max_execution_time', 10000); 
            $headings = (new HeadingRowImport)->toArray($request->file('import_file'));
            /*print_r($headings);*/
            if(!empty($headings)){
                foreach($headings as $key => $row) {
                    $firstrow = $row[0];
                    /*print_r($firstrow);exit;*/
                    if(  $firstrow[0] != 'last_name' || $firstrow[1] != 'first_name' 
                        ||  $firstrow[2] != 'address'|| $firstrow[3] != 'city'|| $firstrow[4] != 'state' || $firstrow[5] != 'postal_code' || $firstrow[6] != 'country'|| $firstrow[7] != 'mobile_phone'|| $firstrow[8] != 'email') 
                    {
                        $this->error = 'Problem in header.';
                        break;
                    }
                }
            }
            if($this->error != '')
            {
                return response()->json(['status'=>500,'message'=>$this->error]);
            }

            Excel::import(new CustomerImport($request->business_id), $request->file('import_file'));
        }

        if($this->error != '')
        {
            return response()->json(['status'=>500,'message'=>$this->error]);
        }
        else{
            return response()->json(['status'=>200,'message'=>'File imported Successfully']);
        }
    }

    public function deletecustomer(Request $request){
        $customerdata = $this->customers->findById($request->id);
        if( $customerdata != ''){
            Customer::where('id',$request->id)->delete();
        }

        return redirect('manage-customer');
    }

    public function savenotes(Request $request){
        Customer::where('id',$request->cus_id)->update(["notes"=>$request->notetext]);
        return redirect('viewcustomer/'.$request->cus_id);
    }

    public function addcustomerfamily ($id){
        $companyId = !empty(Auth::user()->cid) ? Auth::user()->cid : "";
        $companyservice  =[];
        $UserFamilyDetails  =[];
        if(!empty($companyId)) {
            $business_details = BusinessCompanyDetail::where('cid', $companyId)->get();
            $business_details = isset($business_details[0]) ? $business_details[0] : [];
            $companyservice = BusinessServices::where('userid', Auth::user()->id)->where('cid', $companyId)->orderBy('id', 'DESC')->get();
        }
        $UserFamilyDetails  = Customer::where('parent_cus_id',$id)->get();
        return view('customers.add_family', [
            'business_details' => $business_details,
            'companyservice' => $companyservice,
            'UserFamilyDetails' => $UserFamilyDetails,
            'companyId' => $companyId,
            'parent_cus_id' => $id,
        ]);
        //return view('profiles.viewcustomer');
    }

    public function addFamilyMemberCustomer(Request $request) {
        //print_r($request->all());exit;
        $prev = $request['previous_family_count'];       
        $request['family_count'] . "---" . '----' . $prev;
        $request['family_count'] - $prev;

        $loggedinUser = Auth::user();
        $user = User::where('id', Auth::user()->id)->first();
        $data = '';

        if ($prev == $request['family_count'] && $request['family_count'] == 0) {
            if ($request['removed_family'][0] != 'delete') {
                $last_name = ($request['fname'][0]) ? $request['lname'][0] : '';
                $cus_name = $request['fname'][0].' '.$last_name;
                $customer = \Stripe\Customer::create(
                    [
                        'name' => $cus_name,
                        'email'=> $request['email'][0],
                    ]);
                $stripe_customer_id = $customer->id;  
                $data = Customer::create([
                            'business_id' => $request['business_id'],
                            'fname' => $request['fname'][0],
                            'lname' => $request['lname'][0],
                            'email' => $request['email'][0],
                            'phone_number' => $request['mobile'][0],
                            'emergency_contact' => $request['emergency_contact'][0],
                            'relationship' => $request['relationship'][0],
                            'gender' => $request['gender'][0],
                            'birthdate' => date('Y-m-d',strtotime($request['birthdate'][0])),
                            'parent_cus_id' => $request['parent_cus_id'],
                            'stripe_customer_id' => $stripe_customer_id,
                        ]);
            }           
        } else {          
            for ($i = 0; $i < $prev; $i++) {
                if ($request['removed_family'][$i] != 'delete') {
                    $last_name = ($request['fname'][$i]) ? $request['lname'][$i] : '';
                    $cus_name = $request['fname'][$i].' '.$last_name;
                    $customer = \Stripe\Customer::create(
                        [
                            'name' => $cus_name,
                            'email'=> $request['email'][$i],
                        ]);
                    $stripe_customer_id = $customer->id; 
                    $cat = Customer::find($request['cus_id'][$i]);
                    $cat->business_id = $request['business_id'];
                    $cat->fname = $request['fname'][$i];
                    $cat->lname = $request['lname'][$i];
                    $cat->email = $request['email'][$i];
                    $cat->phone_number = $request['mobile'][$i];
                    $cat->emergency_contact = $request['emergency_contact'][$i];
                    $cat->relationship = $request['relationship'][$i];
                    $cat->gender = $request['gender'][$i];
                    $cat->birthdate = date('Y-m-d',strtotime($request['birthdate'][$i]));
                    $cat->stripe_customer_id  = $stripe_customer_id ;
                    $data = $cat->update();
                } else {
                    $data = Customer::where('id', $request['cus_id'][$i])->delete();
                }
            }            
            for ($j = $prev; $j < $request['family_count']; $j++) {
                if ($request['removed_family'][$j] != 'delete') {
                    $last_name = ($request['fname'][$j]) ? $request['lname'][$j] : '';
                    $cus_name = $request['fname'][$j].' '.$last_name;
                    $customer = \Stripe\Customer::create(
                        [
                            'name' => $cus_name,
                            'email'=> $request['email'][$j],
                        ]);
                    $stripe_customer_id = $customer->id;
                    $data = Customer::create([
                                'business_id' => $request['business_id'],
                                'fname' => $request['fname'][$j],
                                'lname' => $request['lname'][$j],
                                'email' => $request['email'][$j],
                                'phone_number' => $request['mobile'][$j],
                                'emergency_contact' => $request['emergency_contact'][$j],
                                'relationship' => $request['relationship'][$j],
                                'gender' => $request['gender'][$j],
                                'birthdate' =>  date('Y-m-d',strtotime($request['birthdate'][$j])),
                                'parent_cus_id' => $request['parent_cus_id'],
                                'stripe_customer_id' => $stripe_customer_id,
                            ]);
                }
            }
        }
        if ($data)
            return Redirect::back()->with('success', 'Family details has been updated successfully.');
        else
            return Redirect::back()->with('error', 'Problem in updating family details.');
    }

    public function removefamilyCustomer(Request $request) {
        DB::delete('DELETE FROM customers WHERE id = "' . $request->rm . '"');
        return Redirect::back()->with('success', 'Family Member Delete.');
    }

    public function update_customer(Request $request){
      //print_r($request->all());exit;
        session()->forget('strpecarderror');
        if($request->chk == 'update_billing'){
            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            
            $customerdata = Customer::find($request->cus_id);
            // /echo $customerdata;exit();
            if($customerdata->stripe_customer_id == ''){
                $last_name = ($customerdata->firstname) ? $customerdata->lastname : '';
                $cus_name = $customerdata->firstname.' '.$last_name;
                $customer = \Stripe\Customer::create(
                    [
                        'name' => $cus_name,
                        'email'=> $customerdata->email,
                    ]);
                $stripe_customer_id = $customer->id;
                $data1 = array(
                    'stripe_customer_id'=>$stripe_customer_id,
                );
                $cust = Customer::find($request->cus_id);
                $cust->update($data1);
            }else{
                $stripe_customer_id = $customerdata->stripe_customer_id;
            }

            if($request->payment_type == 'update'){
                $stripval = $stripe->customers->deleteSource(
                    $stripe_customer_id,
                    $customerdata->card_stripe_id,
                    []
                );
                
            }

            try{
                if($request->card_month == ''){
                    $request->card_month = $request->card_monthhidden;
                }

                if($request->card_year == ''){
                    $request->card_year = $request->card_yearhidden;
                }
                $carddetails = $stripe->tokens->create([
                    'card' => [
                        'number' => $request->cardNumber,
                        'exp_month' =>  $request->card_month,
                        'exp_year' =>  $request->card_year,
                        'cvc' =>  $request->cvv,
                        'name' =>  $request->owner,
                    ],
                ]);
                print_r($carddetails);
                $customer_source = $stripe->customers->createSource(
                    $stripe_customer_id,
                    [ 'source' =>$carddetails->id]
                );

               /* print_r($carddetails);exit;*/
                $cust = Customer::find($request->cus_id);
                $data = array(
                    "card_stripe_id"=>$carddetails['card']->id,
                    "card_token_id"=> $carddetails->id,
                );
                $cust = Customer::find($request->cus_id);
                $cust->update($data);
            }catch(\Stripe\Exception\CardException $e) {
              // Since it's a decline, \Stripe\Exception\CardException will be caught
              $statusmsg= $e->getError()->message ;
              Session::put('strpecarderror', $statusmsg);
            }   
        }elseif($request->chk == 'update_personal'){
            if($request->profile_pic != ''){
                $filename = $request->profile_pic;
                $name = $filename->getClientOriginalName();
                //$filestatus = $filename->move(public_path().DIRECTORY_SEPARATOR.'customers'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR, $name);
            }

            $data = $request->all();
            if(@$data['birthdate'] != ''){
                $data['birthdate'] = date('Y-m-d',strtotime($request->birthdate));
            }

            $position = array_search(request()->_token, $data);
            $position1 = array_search(request()->cus_id, $data);
            unset($data[$position]);
            unset($data[$position1]);
            
            $cust = Customer::find($request->cus_id);
            $cust->update($data);
        }
        
        return redirect('viewcustomer/'.$request->cus_id);
    }

    public function paymentdeletecustomer(Request $request) {
        /*print_r($request->all());*/
        $customer = Customer::where('id', $request->cus_id)->first();
        if($customer != ''){
            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            $stripval = $stripe->customers->deleteSource(
                $customer->stripe_customer_id,
                $request->cardid,
                []
            );
            echo $stripval;
        }
    }

}