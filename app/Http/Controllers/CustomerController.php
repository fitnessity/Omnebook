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
	                "image" => $cuss->profile_pic
	            );
            }

            sort($array_data);
          
            $output = '<ul id="bussiness-list">';
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

                            $output .='</div>
                            <div class="col-md-10 div-controller">
                                <p class="pstyle">'.$row['name'].'</p>
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
        if($customerdata->birthdate != null){
            $date =  new Carbon($customerdata->birthdate);
            $bdate = $date->format('F jS\,  Y');
        }
       
        $sincedate = date('m/d/Y',strtotime($customerdata->created_at));
        $location = '';
        $address = '';
        if($customerdata->address != ''){
            $address .= $customerdata->address.', ';
        }
        if($customerdata->city != ''){
            $address .= $customerdata->city.', ';
        }
        if($customerdata->state != ''){
            $address .= $customerdata->state.' '.$customerdata->zipcode.', ';
            $location .= $customerdata->state.', ';
        }
        if($customerdata->country != ''){
            $address .= $customerdata->country;
            $location .= $customerdata->country;
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

        $familydata  = CustomerFamilyDetail::select('first_name','last_name','relationship','birthday')->where('cus_id',$customerdata->id)->get();
        /*$familydata  = $customerdata->CustomerFamilyDetail();*/
        //print_r($familydata);exit;
        return view('customers.viewcustomer', [
             'business_details' => $business_details,
            'companyservice' => $companyservice,
            'customerdata'=>$customerdata,
            'bdate'=>$bdate,
            'age'=>$customerdata->getcustage(),
            'sincedate'=>$sincedate,
            'address'=>$address,
            'location'=>$location,
            'familydata'=>$familydata,
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
}