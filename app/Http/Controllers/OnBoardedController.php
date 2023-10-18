<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\{User,CompanyInformation,CustomerPlanDetails,Transaction,StripePaymentMethod};
use Str;
use DateTime;

class OnBoardedController extends Controller {


    public function index(Request $request) { 
        /*if (Auth::check()) {
            return redirect()->route('business_dashboard');
        }*/
        
        $cid = $request->cid ?? '';
        $id = $request->id ?? '';
            
        $companyDetail = CompanyInformation::find($cid);
        $companay = CompanyInformation::where('id' ,$cid)->whereNotNull('stripe_connect_id')->first();
        $user = $companyDetail != '' ? $companyDetail->users : '';
        if($id){
            $user = User::find($id);
        }
        if(Auth::check()){
            $user = Auth::user();
        }

        if($request->show == 3 ){
            $user->update(['show_step' => 3]);
            return redirect('/onboard_process?cid='.$cid.'&id='.$user->id);
        }

        if($request->show == 6 ){
            $user->update(['show_step' => 6]);
            return redirect('/onboard_process?cid='.$cid);
        }

        $show = @$user->show_step ?? 1;
        return view('on-boarded.index',compact('show','cid','companyDetail','user','id','show'));
    }

    public function store(Request $request){
        //print_r($request->all());    exit;


        $userDt = User::find($request->id);
        $companyDt = CompanyInformation::find($request->cid);

        if($request->step == 1){

            $show_step = 2;
            if(Auth::check() || @$companyDt->id == ''){
                $show_step = 3;
            }
        
            $proPic = $request->has('profile_pic') ? $request->file('profile_pic')->store('customer') : @$userDt->profile_pic;
            $birthdate = $request->birthdate ?? date('Y-m-d');

            $user = [
                "firstname" => $request->fname,
                "lastname" => $request->lname,
                "username" => $request->username,
                "gender" => $request->gender,
                "birthdate" => $birthdate,
                "role" => "customer",
                "phone_number" => $request->phone,
                "address" => $request->address,
                "city" => $request->city,
                "state" => $request->state,
                "country" => $request->country,
                "zipcode" => $request->zipcode,
                "confirmation_code" => Str::random(25),
                "latitude" => $request->lat,
                "longitude" => $request->long,
                "profile_pic" => $proPic,
                "show_step" => $request->show_step,
                "quick_intro" => $request->quick_intro,
                "favorit_activity" => $request->favorit_activity,
                "business_info" => $request->business_info,
                "show_step" => $show_step,
            ];

            if ($request->password !== null) {
                $user["password"] = bcrypt($request->password);
                $user["buddy_key"] = $request->password;
            }

            if ($request->email !== null) {
                $user["email"] = $request->email;
            }

            $user  =  User::updateOrCreate(['id' => $request->id],$user);

            $data = [
                'cid' => @$companyDt->id,
                'id' => $user->id,
            ];
        }else{
    
            $companyImage = $request->has('logo') ? $request->file('logo')->store('company') :  @$companyDt->logo;; 
            $company = [
                "user_id" => @$userDt->id,
                "company_name" => $request->companyName,
                "dba_business_name" => $request->dbaBusinessName,
                "contact_number" => $request->contact,
                "logo" => $companyImage,
                "address" => $request->bAddress,
                "state" => $request->bstate,
                "country" => $request->bcountry,
                "zip_code" => $request->bzipcode,
                "city" => $request->bcity,
                "business_user_tag" => $request->businessUserName,
                "latitude" => $request->blat,
                "longitude" => $request->blon,
                "additional_address" => $request->additionalAddress,
                "neighborhood" => $request->neighborhood,
                "business_phone" => $request->businessPhone,
                "business_email" => $request->businessEmail,
                "business_website" => $request->website,
                "business_type" => $request->businessType,
                "first_name" => @$userDt ->firstname,
                "last_name" => @$userDt->lastname,
                "email" => $request->email,
                "about_company" => $request->aboutCompany,
                "short_description" => $request->shortDescription,
            ];

            @$userDt->update(['show_step'=>4]);

            $companyDetail  =  CompanyInformation::updateOrCreate(['id' => $request->cid],$company);
            $data = [
                'cid' => $companyDetail->id,
                'id' => $companyDetail->user_id,
            ];
        } 

        return response()->json($data); 
    }

    public function welcome(Request $request){
        $cid = $request->cid;
        $company = CompanyInformation::where('id', $cid)->first();
        /*$user = User::find($company->user_id);
        $user->update(['show_step' =>1]);*/
        return view('on-boarded.welcome_provider',compact('cid'));
    }

    public function stripeDashboard(Request $request){
        $stripe_client = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $company = CompanyInformation::where('id', $request->cid)->first();
        $current_user = User::where('id',@$company->user_id)->first();

        if(!@$company->stripe_connect_id) $company->stripe_connect_id = '111111111';
        
        try{
            $stripe_account = $stripe_client->accounts->retrieve(
              $company->stripe_connect_id,
              []
            );

        }catch(\Stripe\Exception\PermissionException $e){
            $stripe_account = $stripe_client->accounts->create([
                'type' => 'express', 
                'email' => $current_user->email,
            ]);
            $company->stripe_connect_id = $stripe_account->id;
            $company->save();
        }


        if($stripe_account->charges_enabled){
            $company->charges_enabled = 1;
            $company->save();
            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $login_link = \Stripe\Account::createLoginLink($stripe_account->id);
            $url = $login_link["url"];
        }else{
            $link = $stripe_client->accountLinks->create(
              [
                'account' => $stripe_account->id,
                'refresh_url' => env('APP_URL').'/onboard_process?id='.$company->user_id.'&cid='.$company->id,
                'return_url' => env('APP_URL').'/onboard_process?id='.$company->user_id.'&cid='.$company->id,
                'type' => 'account_onboarding',
              ]
            );
            $url = $link['url'];

        }       
        $current_user->show_step = 5;
        $current_user->save();
    
        return redirect($url);
    }

    public function storePlan(Request $request){
        $currentDate = new DateTime();
        $sDate = $currentDate->format('Y-m-d');
        $currentDate->modify('+14 days');
        $eDate = $currentDate->format('Y-m-d');

        $company = CompanyInformation::find($request->cid);
        $user = User::find($company->user_id);

        $chkPlan = CustomerPlanDetails::where(['user_id' => $user->id])->whereDate('expire_date' ,'=', $eDate)->first();
        if($chkPlan == ''){
            CustomerPlanDetails::create([
                'user_id'=> $user->id,
                'plan_id'=> $request->id,
                'starting_date'=> $sDate,
                'expire_date'=> $eDate
            ]);
        }
        $user->update(['show_step' => 6]);
    }

    public function getCardForm(Request $request){
        $company = CompanyInformation::find($request->cid);
        $user = User::find($company->user_id);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $intent = $stripe->setupIntents->create(
          [
            'customer' => @$user->stripe_customer_id,
            'payment_method_types' => ['card'],
          ]
        );
        return view('on-boarded.card_form', compact('intent','user','company'));
    }

    public function storeCards(Request $request){
        $company = CompanyInformation::find($request->cid);
        $user = User::where('id', $company->user_id)->first();
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $payment_methods = $stripe->paymentMethods->all(['customer' => $user->stripe_customer_id, 'type' => 'card']);
        $fingerprints = [];
        foreach($payment_methods as $payment_method){
            $fingerprint = $payment_method['card']['fingerprint'];
            if (in_array($fingerprint, $fingerprints, true)) {
                $deletePaymentMethod = StripePaymentMethod::where('payment_id', $payment_method['id'])->first();
                if($deletePaymentMethod != ''){
                    $deletePaymentMethod->delete();
                }
            } else {
                $fingerprints[] = $fingerprint;
                $stripePaymentMethod = StripePaymentMethod::firstOrNew([
                    'payment_id' => $payment_method['id'],
                    'user_type' => 'User',
                    'user_id' => $user->id,
                ]);

                $stripePaymentMethod->pay_type = $payment_method['type'];
                $stripePaymentMethod->brand = $payment_method['card']['brand'];
                $stripePaymentMethod->exp_month = $payment_method['card']['exp_month'];
                $stripePaymentMethod->exp_year = $payment_method['card']['exp_year'];
                $stripePaymentMethod->last4 = $payment_method['card']['last4'];
                $stripePaymentMethod->save();
            }
        }
        return redirect('/onboard_process?show=5&cid='.$request->cid);
    }

    public function doLoginProcess(Request $request){
        $company = CompanyInformation::find($request->cid);
        if(!Auth::check()){
            Auth::loginUsingId($company->user_id);
        }
        if($request->redirect == 'dashboard'){
            return redirect()->route('business_dashboard');
        }else{
            return redirect()->route('business.service.select' ,['business_id' => $request->cid]);
        }
    }
}   