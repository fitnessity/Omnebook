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
use App\Customer;

use App\Miscellaneous;
use App\Repositories\CustomerRepository;

class RegistrationController extends Controller
{

	protected $customers;

    public function __construct(CustomerRepository $customers) {

        $this->customers = $customers;
    }

    public function emailvalidation_customer(Request $request) {
        $postArr = $request->all();

        $rules = [
            'email' => 'required|unique:customers',
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
        }

    }

	public function postRegistrationCustomer(Request $request) {
        $postArr = $request->all();
        //print_r($postArr);exit;
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:customers',
            'contact' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'username' => 'unique:customers'
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
            //check for unique email id
            if (!$this->customers->validateCustomer($postArr['email'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Email already exists. Please select different Email',
                );
                return Response::json($response);
            };
            //check for unique customer name
            if (!$this->customers->validateCustomer($postArr['username'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'User name already exists. Please select different Name',
                );
                return Response::json($response);
            };

            if (count($postArr) > 0) {

                $customerObj = New Customer();
                $customerObj->business_id = $postArr['business_id'];
                $customerObj->fname = $postArr['firstname'];
                $customerObj->lname = ($postArr['lastname']) ? $postArr['lastname'] : '';
                $customerObj->username = $postArr['username'];
                $customerObj->password = Hash::make(str_replace(' ', '', $postArr['password']));
                $customerObj->email = $postArr['email'];
                $customerObj->country = 'US';
                $customerObj->status = 0;
                $customerObj->phone_number = $postArr['contact'];
                $customerObj->birthdate = date("Y-m-d", strtotime($postArr['dob']));

                $customerObj->save();

                if ($customerObj) {                    
                   
                    //MailService::sendEmailSignupVerification($customerObj->id);

                    $response = array(
                        'id'=>$customerObj->id,
                        'type' => 'success',
                        'msg' => 'Customer Successfully Registered.',
                        //'redirecturl' => $url,
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
        $customers = Customer::where('id',$request->cust_id)->first();
        $customers->gender=$request->gender;
        $customers->save();
         return response()->json(['status'=>200]);
    }

    public function saveaddressCustomer(Request $request)
    {
        
        $customers = Customer::where('id',$request->cust_id)->first();
        $customers->address=$request->address;
        $customers->country=$request->country;
        $customers->city=$request->city;
        $customers->state=$request->state;
        $customers->zipcode=$request->zipcode;
        /*$customers->latitude=$request->lat;
        $customers->longitude=$request->lon;*/
        $customers->save();
        $url = '/viewcustomer/'.$request->id;
        return response()->json(['status'=>200,'redirecturl'=>$url]);
    }

    public function savephotoCustomer(Request $request)
    {   
        $customers = Customer::where('id',$request->cust_id)->first();
        if ($request->hasFile('file_upload_profile')) {
            $name = $request->file('file_upload_profile')->getClientOriginalName();
            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'customers' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR;
    
            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'customers' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
    
            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('file_upload_profile'), $file_upload_path, 1, $thumb_upload_path, '415', '354');
            $customers->profile_pic =  $image_upload['filename']; 
        }
        $customers->save();
        return response()->json(['status'=>200]);
    }
}