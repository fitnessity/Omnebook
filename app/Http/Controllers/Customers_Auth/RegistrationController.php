<?php

namespace App\Http\Controllers\Customers_Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Api;
use Str,DB,Validator,Input,Redirect,Storage,Response;
use App\{Customer,UserBookingDetail,User,CustomerFamilyDetail,Miscellaneous,SGMailService,UserFamilyDetail};
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
        //print_r($request->all());exit;
        $postArr = $request->all();
        $user = Auth::user();
        $company = $user->businesses->find(Auth::user()->cid);

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
                    [ 'name' => $cus_name,
                        'email'=> $postArr['email'] 
                    ]);
                $stripe_customer_id = $customer->id;  

                if($request->password){
                    $random_password = $request->password;
                }else{
                    $random_password = Str::random(8);    
                }
               
                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->signpath));
                $filename = 'signatures/signature_' . time() . '.png';
                Storage::disk('s3')->put($filename, $image);

                $customerObj = New Customer();
                $customerObj->business_id = $company->id;
                $customerObj->fname = $postArr['firstname'];
                $customerObj->lname = $postArr['lastname'] ?? '';
                $customerObj->password = Hash::make($random_password);
                $customerObj->email = $postArr['email'];
                $customerObj->primary_account = $request->primaryAccountHolder ?? 0;
                $customerObj->status = 0;
                $customerObj->phone_number = $postArr['contact'];
                $customerObj->birthdate = $postArr['dob'];
                $customerObj->stripe_customer_id = $stripe_customer_id;
                $customerObj->request_status = 1;
                $customerObj->gender=@$request->gender;
                $customerObj->get_fitnessity_info_from = @$request->know_from;

                $customerObj->address = @$request->address;
                $customerObj->country = @$request->country;
                $customerObj->city = @$request->city;
                $customerObj->state = @$request->state;
                $customerObj->zipcode = @$request->zipcode;

                $customerObj->terms_covid = date('Y-m-d');
                $customerObj->terms_liability = date('Y-m-d');
                $customerObj->terms_contract = date('Y-m-d');
                $customerObj->terms_condition = date('Y-m-d');
                $customerObj->terms_refund = date('Y-m-d');

                $customerObj->terms_sign_path = $filename;
                $customerObj->contract_sign_path = $filename;
                $customerObj->liability_sign_path = $filename;
                $customerObj->refund_sign_path = $filename;
                $customerObj->covid_sign_path = $filename;

                $fitnessity_user = User::where(['firstname'=> $postArr['firstname'],'lastname'=>$postArr['lastname'] ,'email' => $postArr['email']])->first();
                if($fitnessity_user){
                    $ids = $fitnessity_user->orders()->get()->map(function($item){
                        return $item->id;
                    });

                    $result = UserBookingDetail::whereIn('sport', function($query) use ($company){
                        $query->select('id')->from('business_services')->where('cid', $company->id);
                    })->whereIn('booking_id', $ids)->exists();

                    if($result){
                        $customerObj->user_id = $fitnessity_user->id;
                    }
                    $customerObj->save();
                }else{
                    $userObj = New User();
                    $userObj->role = 'customer';
                    $userObj->firstname = $postArr['firstname'];
                    $userObj->lastname = $postArr['lastname'] ?? '';
                    $userObj->username = $postArr['firstname'].$postArr['lastname'];
                    $userObj->password = $customerObj->password;
                    $userObj->buddy_key = $random_password;
                    $userObj->email = $postArr['email'];
                    $userObj->primary_account = $request->primaryAccountHolder ?? 0;
                    $userObj->country = 'United Status';
                    $userObj->phone_number = $postArr['contact'];
                    $userObj->birthdate = $postArr['dob'];
                    $userObj->stripe_customer_id = $stripe_customer_id;
                    $userObj->save(); 
                    $customerObj->user_id = $userObj->id;
                }
    
                $customerObj->save();
                if ($customerObj) {    

                    $parentId = NULL;
                    $currentCustomer = $customerObj;
                    for($i=0;$i<=$request->familycnt;$i++){
                        if($request->fname[$i] != ''){

                            $date = $request->birthdate[$i] ?? NULL;
                            if($request->primaryAccount == 1 && $currentCustomer->primary_account != 1){
                                if($i == 0){
                                    $parentId = NULL;
                                    $isParentAccount = 1;
                                }
                            }else{
                                $parentId = $currentCustomer->id;
                                $isParentAccount = 0;
                            }

                            $customerFamily = New Customer();
                            $customerFamily->parent_cus_id = $parentId;
                            $customerFamily->primary_account = $isParentAccount;
                            $customerFamily->business_id = $company->id;
                            $customerFamily->fname = $request->fname[$i];
                            $customerFamily->lname = $request->lname[$i];
                            $customerFamily->relationship = $request->relationship[$i];
                            $customerFamily->email = $request->emailid[$i];
                            $customerFamily->country = 'United Status';
                            $customerFamily->status = 0;
                            $customerFamily->phone_number = $request->mphone[$i];
                            $customerFamily->birthdate = $date;
                            $customerFamily->emergency_contact = $request->emergency_phone[$i];
                            $customerFamily->emergency_name = $request->emergency_name[$i];
                            $customerFamily->emergency_email = $request->emergency_email[$i];
                            $customerFamily->emergency_relation = $request->emergency_relation[$i];
                            $customerFamily->gender =  $request->familygender[$i];
                            $customerFamily->request_status =  1;
                            $customerFamily->save();
                            $customerFamily->create_stripe_customer_id();
                            if($request->primaryAccount == 1 && $currentCustomer->primary_account != 1){
                                if($i == 0){
                                   $parentId = $customerFamily->id;
                                   $currentCustomer->update(['parent_cus_id' =>$parentId]);
                                }
                            }

                            if ($customerFamily) {      
                                SGMailService::sendWelcomeMailToCustomer($customerFamily->id,$company->id,'');
                            }

                            $is_user = User::where(['firstname'=> $request->fname[$i],'lastname'=> $request->lname[$i],'email' => $request->emailid[$i]])->first();

                            if(!$is_user){
                                $familyUser = New User();
                                $familyUser->role = 'customer';
                                $familyUser->firstname =  $request->fname[$i];
                                $familyUser->lastname =  $request->lname[$i];
                                $familyUser->username = $request->fname[$i].$request->lname[$i];
                                $familyUser->password = Hash::make($random_password);
                                $familyUser->buddy_key = $random_password;
                                $familyUser->email = $request->emailid[$i];
                                $familyUser->primary_account = $isParentAccount;
                                $familyUser->country = 'United Status';
                                $familyUser->phone_number = $request->mphone[$i];
                                $familyUser->birthdate =  $date;
                                $familyUser->gender = $request->familygender[$i];
                                $familyUser->stripe_customer_id = $customerFamily->stripe_customer_id;
                                $familyUser->save(); 
                                $customerFamily->user_id = $familyUser->id;
                            }else{
                                $customerFamily->stripe_customer_id = @$is_user->stripe_customer_id;
                                $customerFamily->user_id = @$is_user->id;
                            }

                            $customerFamily->save();

                            UserFamilyDetail::create([
                                'user_id' => $currentCustomer->user_id,
                                'first_name' => $request->fname[$i],
                                'last_name' => $request->lname[$i],
                                'email' => $request->emailid[$i],
                                'mobile' => $request->mphone[$i],
                                'emergency_contact' =>$request->emergency_phone[$i],
                                'relationship' =>  $request->relationship[$i],
                                'gender' => $request->familygender[$i],
                                'birthday' =>  $date,
                                'emergency_contact_name' => $request->emergency_name[$i],
                            ]);
                        }
                    }

                    session()->put('success-register', '1');

                    $status = SGMailService::sendWelcomeMailToCustomer($customerObj->id,Auth::user()->cid,$random_password); 
                    $response = array(
                        'id'=>$customerObj->id,
                        'type' => 'success',
                        'msg' => 'Registration was successful.',
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
        // print_r($request->all());exit;
        $postArr = $request->all();
        $parentId = NULL;
        $currentCustomer = Customer::find($request->cust_id);
        for($i=0;$i<=$request->familycnt;$i++){
            if($request->fname[$i] != ''){
                $date = NULL;
                if($request->birthdate[$i] != ''){
                    $date = $request->birthdate[$i];
                }
                if($request->primaryAccount == 1 && $currentCustomer->primary_account != 1){
                    if($i == 0){
                        $parentId = NULL;
                        $isParentAccount = 1;
                    }
                }else{
                    $parentId = $request->cust_id;
                    $isParentAccount = 0;
                }

                $customerObj = New Customer();
                $customerObj->parent_cus_id = $parentId;
                $customerObj->primary_account = $isParentAccount;
                $customerObj->business_id = $request->business_id;
                $customerObj->fname = $request->fname[$i];
                $customerObj->lname = $request->lname[$i];
                $customerObj->relationship = $request->relationship[$i];
                $customerObj->email = $request->emailid[$i];
                $customerObj->country = 'United Status';
                $customerObj->status = 0;
                $customerObj->phone_number = $request->mphone[$i];
                $customerObj->birthdate = $date;
                $customerObj->emergency_contact = $request->emergency_phone[$i];
                $customerObj->emergency_name = $request->emergency_name[$i];
                $customerObj->emergency_email = $request->emergency_email[$i];
                $customerObj->emergency_relation = $request->emergency_relation[$i];
                $customerObj->gender =  $request->gender[$i];
                $customerObj->request_status =  1;
                $customerObj->save();

                $customerObj->create_stripe_customer_id();
                if($request->primaryAccount == 1 && $currentCustomer->primary_account != 1){
                    if($i == 0){
                       $parentId = $customerObj->id;
                       $currentCustomer->update(['parent_cus_id' =>$parentId]);
                    }
                }
                if ($customerObj) {      
                    SGMailService::sendWelcomeMailToCustomer($customerObj->id,$postArr['business_id'],'');
                }

                $is_user = User::where('email', $request->emailid[$i])->whereRaw('LOWER(firstname) = ? AND LOWER(lastname) = ?', [strtolower( $request->fname[$i]), strtolower($request->lname[$i])])->first();

                $is_user = User::where('email', $request->emailid[$i])->first();
                if(!$is_user){
                    $familyUser = New User();
                    $familyUser->role = 'customer';
                    $familyUser->firstname =  $request->fname[$i];
                    $familyUser->lastname =  $request->lname[$i];
                    $familyUser->username = $request->fname[$i].$request->lname[$i];
                    /*$familyUser->password = Hash::make($random_password);
                    $familyUser->buddy_key = $random_password;*/
                    $familyUser->email = $request->emailid[$i];
                    $familyUser->gender = $request->gender[$i];
                    $familyUser->primary_account = $isParentAccount;
                    $familyUser->country = 'United Status';
                    $familyUser->phone_number = $request->mphone[$i];
                    $familyUser->birthdate =  $date;
                    $familyUser->stripe_customer_id =  $customerObj->stripe_customer_id;
                    $familyUser->save(); 
                    $customerObj->user_id =  $familyUser->id;
                }else{
                    $customerObj->user_id =  @$is_user->id;
                }
                $customerObj->save();
            }
        }
        
        $response = array(
            'type' => 'success',
            'msg' => 'Successfully added family member',
            'redirecturl' => route('business_customer_show',['business_id' =>$request->business_id, 'id'=>$request->cust_id])
        );

        return Response::json($response);
    }
}