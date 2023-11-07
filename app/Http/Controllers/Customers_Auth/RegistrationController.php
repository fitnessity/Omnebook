<?php

namespace App\Http\Controllers\Customers_Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Redirect;
use Response;
use App\Api;
use Str;
use App\MailService;
use DB;
use Validator;
use Input;
use App\Customer;
use App\UserBookingDetail;
use App\User;
use App\CustomerFamilyDetail;

use App\Miscellaneous;
use App\SGMailService;
use App\Repositories\CustomerRepository;

class RegistrationController extends Controller
{

	protected $customers;

    public function __construct(CustomerRepository $customers) {

        $this->customers = $customers;
    }

    public function emailvalidation_customer(Request $request) {
        $chk = $this->customers->finduniqueemailperbusiness($request->business_id,$request->email);
        if($chk == 'false'){
            $response = array(
                'type' => 'danger',
                'msg' => 'The email has already been taken.',
            );
            return Response::json($response);
        }
    }

	public function postRegistrationCustomer(Request $request) {
        $postArr = $request->all();
        $user = Auth::user();
        $company = $user->businesses->find($request->business_id);

        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'contact' => 'required',
        ];

        $validator = Validator::make($postArr, $rules);
        if ($validator->fails()) {
            $errMsg = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            return Response::json($response);
        } else {

            //check for unique customer name
            /*if (!$this->customers->findUniquefeildPerBusiness($company->id, 'username',$postArr['username'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'User name already exists. Please select different Name',
                );
                return Response::json($response);
            };*/

            //check for unique email id
            if (!$this->customers->findUniquefeildPerBusiness($company->id, 'email',$postArr['email'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Email already exists. Please select different Email',
                );
                return Response::json($response);
            }; 

            if (!$this->customers->findUniquefeildPerBusiness($company->id, 'phone_number',$postArr['contact'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Phone Number already exists. Please Enter different Phone Number',
                );
                return Response::json($response);
            };
            
            if (count($postArr) > 0) {

                \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

                $last_name = ($postArr['firstname']) ? $postArr['lastname'] : '';
                $cus_name = $postArr['firstname'].' '.$last_name;
                $customer = \Stripe\Customer::create(
                    [
                        'name' => $cus_name,
                        'email'=> $postArr['email'],
                    ]);
                $stripe_customer_id = $customer->id;  


                $random_password = Str::random(8);

                $customerObj = New Customer();
                $customerObj->business_id = $company->id;
                $customerObj->fname = $postArr['firstname'];
                $customerObj->lname = ($postArr['lastname']) ? $postArr['lastname'] : '';
                // $customerObj->username = $postArr['username'];
                //$customerObj->password = Hash::make(str_replace(' ', '', $postArr['password']));
                $customerObj->password = Hash::make($random_password);
                $customerObj->email = $postArr['email'];
                $customerObj->country = 'US';
                $customerObj->status = 0;
                $customerObj->phone_number = $postArr['contact'];
                $customerObj->birthdate = date("Y-m-d", strtotime($postArr['dob']));
                $customerObj->stripe_customer_id = $stripe_customer_id;

                $fitnessity_user = User::where('email', $postArr['email'])->first();

                if($fitnessity_user){
                    $ids = $fitnessity_user->orders()->get()->map(function($item){
                        return $item->id;
                    });

                    $result = UserBookingDetail::whereIn('sport', function($query) use ($company){
                        $query->select('id')
                              ->from('business_services')
                              ->where('cid', $company->id);
                    })->whereIn('booking_id', $ids)->exists();

                    if($result){
                        $customerObj->user_id = $fitnessity_user->id;
                    }
                }
                
                $customerObj->save();

                $userObj = New User();
                $userObj->role = 'customer';
                $userObj->firstname = $postArr['firstname'];
                $userObj->lastname = ($postArr['lastname']) ? $postArr['lastname'] : '';
                $userObj->username = $postArr['firstname'].$postArr['lastname'];
                /*$userObj->password = Hash::make(str_replace(' ', '', $postArr['password']));
                $userObj->buddy_key = $postArr['password'];*/
                $userObj->password = $customerObj->password;
                $userObj->buddy_key = $random_password;
                $userObj->email = $postArr['email'];
                $userObj->country = 'US';
                $userObj->phone_number = $postArr['contact'];
                $userObj->birthdate = date("Y-m-d", strtotime($postArr['dob']));
                $userObj->stripe_customer_id = $stripe_customer_id;
                $userObj->save(); 
               
                $customerObj->user_id = $userObj->id;
                 $customerObj->save();
                if ($customerObj) {    
                    $status = SGMailService::sendWelcomeMailToCustomer($customerObj->id,$postArr['business_id'],$random_password); 
                    $response = array(
                        'id'=>$customerObj->id,
                        'type' => 'success',
                        'msg' => 'Customer Successfully Registered.',
                    );

                    return Response::json($response);
                } else {

                    $response = array(
                        'type' => 'danger',
                        'msg' => 'Some wrror occured while registering. Please try again later.',
                    );

                    return Response::json($response);
                }
            } else {

                $response = array(
                    'type' => 'danger',
                    'msg' => 'Invalid email or password',
                );

                return Response::json($response);
            }
        }
    }

    public function saveGenderCustomer(Request $request)
    {
        $customers = Customer::where('id',@$request->cust_id)->first();
        $customers->gender=@$request->gender;
        $customers->save();
         return response()->json(['status'=>200]);
    }

    public function saveaddressCustomer(Request $request)
    {
        $customers = Customer::where('id',$request->cust_id)->first();
        $customers->address=@$request->address;
        $customers->country=@$request->country;
        $customers->city=@$request->city;
        $customers->state=@$request->state;
        $customers->zipcode=@$request->zipcode;
        /*$customers->latitude=$request->lat;
        $customers->longitude=$request->lon;*/
        $customers->save();

        $customers->create_stripe_customer_id();
        $intent = $client_secret = null;
        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        if($customers->stripe_customer_id != ''){
            $intent = $stripe->setupIntents->create([
                'payment_method_types' => ['card'],
                'customer' => $customers->stripe_customer_id,
            ]);
            $client_secret = $intent['client_secret'];
        }

        return response()->json(['status'=>200,'redirecturl'=>route('business_customer_show',['business_id' => $customers->company_information->id, 'id'=>$customers->id ] ),'client_secret'=>$client_secret]);
    }

    public function savephotoCustomer(Request $request)
    {   
        $customers = Customer::where('id',$request->cust_id)->first();
        if ($request->hasFile('file_upload_profile')) {
           $customers->profile_pic =  $request->file('file_upload_profile')->store('customer');
        }
        $customers->save();
        return response()->json(['status'=>200]);
    }

    public function submitFamilyCustomer(Request $request) {

        $postArr = $request->all();

        for($i=0;$i<=$request->familycnt;$i++){
            if($request->fname[$i] != ''){
                $date = NULL;
                if($request->birthdate[$i] != ''){
                    $date = date('Y-m-d',strtotime($request->birthdate[$i]));
                }
                $customerObj = New Customer();
                $customerObj->parent_cus_id = $request->cust_id;
                $customerObj->business_id = $request->business_id;
                $customerObj->fname = $request->fname[$i];
                $customerObj->lname = $request->lname[$i];
                $customerObj->relationship = $request->relationship[$i];
                $customerObj->email = $request->emailid[$i];
                $customerObj->country = 'US';
                $customerObj->status = 0;
                $customerObj->phone_number = $request->mphone[$i];
                $customerObj->birthdate = $date;
                $customerObj->emergency_contact = $request->emergency_phone[$i];
                $customerObj->emergency_name = $request->emergency_name[$i];
                $customerObj->emergency_email = $request->emergency_email[$i];
                $customerObj->emergency_relation = $request->emergency_relation[$i];
                $customerObj->gender =  $request->gender[$i];
                $customerObj->save();
                if ($customerObj) {      
                    SGMailService::sendWelcomeMailToCustomer($customerObj->id,$postArr['business_id'],'');
                }
            }
        }
        

        $url = '/viewcustomer/'.$request->cust_id;
        $response = array(
            'type' => 'success',
            'msg' => 'Successfully added family member',
            'redirecturl' => route('business_customer_show',['business_id' =>$request->business_id, 'id'=>$request->cust_id])
        );

        return Response::json($response);
    }
}