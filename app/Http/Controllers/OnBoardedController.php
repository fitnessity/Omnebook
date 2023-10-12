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
        $show = $request->show ?? 1;
        $cid = $request->cid ?? '';
        
        if ($show == 4 || $show == 5 || $show == 3 ) {
            if (empty($cid)) {
                return redirect('/onboard_process');
            }
        }
        $companyDetail = CompanyInformation::find($cid);
        $companay = CompanyInformation::where('id' ,$cid)->whereNotNull('stripe_connect_id')->first();
        $user = $companyDetail != '' ? $companyDetail->users : '';

        if(Auth::check()){
            $user = Auth::user();
        }

        $plan = CustomerPlanDetails::where(['cid'=> $request->cid])->first();
        if($show == 3){
            if($companay){
                return redirect('/onboard_process?show=4&cid='.$cid);
            }
        }elseif( $show == 4 ){
            if(!$companay){
                return redirect('/onboard_process?show=3&cid='.$cid);
            }
            if($plan){
                return redirect('/onboard_process?show=5&cid='.$cid);
            }
        }elseif($show == 5){
            if(!$companay){
                return redirect('/onboard_process?show=3&cid='.$cid);
            }elseif(!$plan){
                return redirect('/onboard_process?show=4&cid='.$cid);
                
            }
        }

        return view('on-boarded.index',compact('show','cid','companyDetail','user'));
    }

    public function store(Request $request){
        //print_r($request->all());exit;
        $userDt = User::find($request->id);
        $companyDt = CompanyInformation::find($request->cid);
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
            "longitude" =>$request->long,
            "profile_pic" => $proPic,
            "show_step" =>$request->show_step,
            "quick_intro" =>$request->quick_intro,
            "favorit_activity" =>$request->favorit_activity,
            "business_info" =>$request->business_info,
        ];

        if ($request->password !== null) {
            $user["password"] = bcrypt($request->password);
            $user["buddy_key"] = $request->password;
        }

        if ($request->email !== null) {
            $user["email"] = $request->email;
        }

        $createUser  =  User::updateOrCreate(['id' => $request->id],$user);

        $companyImage = $request->has('logo') ? $request->file('logo')->store('company') :  @$companyDt->logo;; 
        $company = [
            "user_id" => @$createUser->id,
            "company_name" => $request->companyName,
            "dba_business_name" => $request->dbaBusinessName,
            "contact_number" => $request->contact,
            "logo" => $companyImage,
            "address" => $request->caddress,
            "state" => $request->cstate,
            "country" => $request->ccountry,
            "zip_code" => $request->czipCode,
            "city" => $request->ccity,
            "business_user_tag" => $request->businessUserName,
            "latitude" => $request->clat,
            "longitude" => $request->clon,
            "additional_address" => $request->additionalAddress,
            "neighborhood" => $request->neighborhood,
            "business_phone" => $request->businessPhone,
            "business_email" => $request->businessEmail,
            "business_website" => $request->website,
            "business_type" => $request->businessType,
            "first_name" => $request->fname,
            "last_name" => $request->lname,
            "email" => $request->email,
            "about_company" => $request->aboutCompany,
            "short_description" => $request->shortDescription,
        ];

        $companyDetail  =  CompanyInformation::updateOrCreate(['id' => $request->cid],$company);
        return $companyDetail->id;
    }

    public function welcome(Request $request){
        $cid = $request->cid;
        return view('on-boarded.welcome_provider',compact('cid'));
    }

    public function stripeDashboard(Request $request){
        $stripe_client = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $company = CompanyInformation::where('id', $request->cid)->first();
        $current_user = User::find(@$company->user_id);
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
                'refresh_url' => env('APP_URL').'/onboard_process?show=4&cid='.$company->id,
                'return_url' => env('APP_URL').'/onboard_process?show=4&cid='.$company->id,
                'type' => 'account_onboarding',
              ]
            );
            $url = $link['url'];
        }       

        return redirect($url);
    }

    public function storePlan(Request $request){
        $currentDate = new DateTime();
        $sDate = $currentDate->format('Y-m-d');
        $currentDate->modify('+14 days');
        $eDate = $currentDate->format('Y-m-d');

        $company = CompanyInformation::find($request->cid);
        $user = User::find($company->user_id);

        $chkPlan = CustomerPlanDetails::where(['user_id' => $user->id,'cid'=> $request->cid])->whereDate('expire_date' ,'=', $eDate)->first();
        if($chkPlan == ''){
            CustomerPlanDetails::create([
                'user_id'=> $user->id,
                'cid'=> $request->cid,
                'plan_id'=> $request->id,
                'starting_date'=> $sDate,
                'expire_date'=> $eDate
            ]);
        }
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