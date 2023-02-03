<?php

namespace App\Http\Controllers\Customers_Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;
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
            if (!$this->customers->findUniquefeildPerBusiness($company->id, 'username',$postArr['username'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'User name already exists. Please select different Name',
                );
                return Response::json($response);
            };

            //check for unique email id
            if (!$this->customers->findUniquefeildPerBusiness($company->id, 'email',$postArr['email'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Email already exists. Please select different Email',
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

                $customerObj = New Customer();
                $customerObj->business_id = $company->id;
                $customerObj->fname = $postArr['firstname'];
                $customerObj->lname = ($postArr['lastname']) ? $postArr['lastname'] : '';
                $customerObj->username = $postArr['username'];
                /*$customerObj->password = Hash::make(str_replace(' ', '', $postArr['password']));*/
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

                if ($customerObj) {    
                                  
                    MailService::sendEmailVerifiedAcknowledgementcustomer($customerObj->id,$postArr['business_id']);

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
        $url = '/viewcustomer/'.$request->cus_id;
        return response()->json(['status'=>200,'redirecturl'=>route('business_customer_show',['business_id' => $customers->company_information->id, 'id'=>$customers->id])]);
    }

    public function savephotoCustomer(Request $request)
    {   
        $customers = Customer::where('id',$request->cust_id)->first();
        if ($request->hasFile('file_upload_profile')) {
            $name = $request->file('file_upload_profile')->getClientOriginalName();
            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'customers' ;
            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'customers';
    
            /*  $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('file_upload_profile'), $file_upload_path, 1, $thumb_upload_path, '415', '354');*/
            //$customers->profile_pic =  $image_upload['filename']; 
        }
        $customers->save();
        return response()->json(['status'=>200]);
    }

    public function submitFamilyCustomer(Request $request) {
        $postArr = $request->all();
        
        $customerObj = New Customer();
        $customerObj->parent_cus_id = Input::get('cust_id');
        $customerObj->business_id = Input::get('business_id');
        $customerObj->fname = Input::get('first_name');
        $customerObj->lname = Input::get('last_name');
        $customerObj->relationship = Input::get('relationship');
        $customerObj->email = Input::get('email');
        $customerObj->country = 'US';
        $customerObj->status = 0;
        $customerObj->phone_number = Input::get('mobile');
        $customerObj->birthdate = date('Y-m-d',strtotime(Input::get('birthday')));
        $customerObj->emergency_contact = Input::get('emergency_contact');
        $customerObj->gender =  Input::get('gender');

        $customerObj->save();

        if ($customerObj) {                    
            MailService::sendEmailVerifiedAcknowledgementcustomer($customerObj->id,$postArr['business_id']);
        }

        $url = '/viewcustomer/'.$request->cust_id;
        $response = array(
            'type' => 'success',
            'msg' => 'Successfully added family member',
            'redirecturl' => route('business_customer_show',['business_id' => $customerObj->company_information->id, 'id'=>$customerObj->id])
        );

        return Response::json($response);
            
    }
}