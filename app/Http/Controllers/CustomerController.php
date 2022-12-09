<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
use Carbon\Carbon;

use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;

use App\BusinessCompanyDetail;
use App\BusinessServices;
use App\User;
use App\Customer;

use Request as resAll;

class CustomerController extends Controller {
	/**
     * The user repository instance.
     *
     * @var CustomerRepository
     */

 	protected $customers;
 	protected $users;

 	public function __construct(CustomerRepository $customers,UserRepository $users) {
        $this->customers = $customers;
        $this->middleware('auth');
        $this->users = $users;
     
    }

    public function manage_customer (){
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

		//print_r($orderedcustomers);exit;
        return view('customers.manage-customer', [
            'companyId'=>$companyId,
             'business_details' => $business_details,
            'companyservice' => $companyservice,
            'customers' =>$orderedcustomers,
            'customer_count' => count($customer_data),
        ]); 
        //return view('profiles.manage-customer');
    }

    public function searchcustomersaction(Request $request) {
        if($request->get('query'))
        {
            $array_data=array();
            $query = $request->get('query');
          
            $data_cus = Customer::where('fname', 'LIKE', "%{$query}%")->get();
           
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

        $customerdata = $this->customers->findById($id);
        return view('customers.viewcustomer', [
             'business_details' => $business_details,
            'companyservice' => $companyservice,
            'customerdata'=>$customerdata,
        ]);
        //return view('profiles.viewcustomer');
    }


}