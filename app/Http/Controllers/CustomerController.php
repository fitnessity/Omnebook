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
use App\BusinessTerms;

use Request as resAll;

class CustomerController extends Controller {
	/**
     * The user repository instance.
     *
     * @var CustomerRepository
     */

 	protected $customers;
    protected $company;
    public $error = '';

 	public function __construct(CustomerRepository $customers,UserRepository $users) {
        $this->middleware('auth');
        $this->customers = $customers;
    }

    public function index(Request $request, $business_id){

        $user = Auth::user();
        $company = $user->businesses->find($business_id);

        $customers = $company->customers()->orderBy('fname');
        if($request->fname){
            $customers = $customers->whereRaw('LOWER(`fname`) LIKE ?', [ '%'. strtolower($request->fname) .'%' ]);
        }

        $customer_count = $customers->count();
        $customers = $customers->get();

        $grouped_customers= array();
		foreach ($customers as $customer) {
		  $grouped_customers[strtoupper($customer['fname'][0])][] = $customer;
		}


        if ($request->ajax()) {
            return response()->json($customers);
        }
        return view('customers.index', [
            'company' => $company,
            'grouped_customers' => $grouped_customers,
            'customer_count' => $customer_count,
        ]); 
    }

    public function delete(Request $request, $business_id){
        $customerdata = $this->customers->findById($request->id);
        if( $customerdata != ''){
            Customer::where('id',$request->id)->delete();
        }
    }

    public function show($business_id, $id){
        $user = Auth::user();
        $company = $user->businesses->find($business_id);

        $terms = $company->business_terms->first();

        $customerdata = $company->customers->find($id);
        $visits = $customerdata->visits()->get();
        $active_booking_details = $customerdata->active_booking_details()->get();
        $complete_booking_details = $customerdata->complete_booking_details()->get();

        $strpecarderror = '';
        if (session()->has('strpecarderror')) {
            $strpecarderror = Session::get('strpecarderror');
        }
        return view('customers.show', [
            'customerdata'=>$customerdata,
            'cardInfo'=>$customerdata->get_stripe_card_info(),
            'strpecarderror'=>$strpecarderror,
            'terms'=> $terms,
            'visits' => $visits,
            'active_booking_details' => $active_booking_details,
            'complete_booking_details' => $complete_booking_details
        ]);
    }

    public function searchcustomersaction(Request $request) {

        if($request->get('query'))
        {
            $array_data=array();
            $query = $request->get('query');
          
            // $data_cus = $this->customers->findByfname($query); 
            $data_cus = User::where('firstname', 'LIKE', "%{$query}%")->orWhere('lastname', 'LIKE', "%{$query}%")->orWhere('username', 'LIKE', "%{$query}%")->get();
           
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
                    $output .= '<li class="searchclick" >
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
                $output .= "Looks like there's no client with that name listed.</li>";
            }
           
            echo $output;
        }
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

    public function activity_visits(Request $request, $business_id, $id){
        $user = Auth::user();
        $company = $user->businesses->find($business_id);
        $customer = $company->customers->find($id);
        $visits = $customer->visits()->where('order_detail_id', $request->booking_detail_id)->get();
        
        return view('customers.activity_visits', ['visits' => $visits, 'customer' => $customer]);
    }

    public function savenotes(Request $request){
        Customer::where('id',$request->cus_id)->update(["notes"=>$request->notetext]);
        
        return redirect()->route('business_customer_show',['business_id' => $cust->company_information->id, 'id'=>$request->cus_id]);
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
      /*print_r($request->all());exit;*/
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
            
            
            $data = $request->all();

            if($request->hasFile('profile_pic')){
                $data['profile_pic'] = $request->file('profile_pic')->store('customer');
            }
            if(@$data['birthdate'] != ''){
                $data['birthdate'] = date('Y-m-d',strtotime($request->birthdate));
            }

            if(@$data['terms_covid'] != ''){
                $data['terms_covid'] = date('Y-m-d');
            }

            if(@$data['terms_liability'] != ''){
                $data['terms_liability'] = date('Y-m-d');
            }

            if(@$data['terms_contract'] != ''){
                $data['terms_contract'] = date('Y-m-d');
            }
            
            $position = array_search(request()->_token, $data);
            $position1 = array_search(request()->cus_id, $data);
            unset($data[$position]);
            unset($data[$position1]);
            
            $cust = Customer::find($request->cus_id);
            $cust->update($data);
        }
        
        return redirect()->route('business_customer_show',['business_id' => $cust->company_information->id, 'id'=>$cust->id]);
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