<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\{User,CompanyInformation,CustomerPlanDetails,Transaction,StripePaymentMethod,Plan,PromoCodes,OnboardQuestions};
use App\Repositories\FeaturesRepository;
use Str;
use DateTime;
use Carbon\Carbon;
use Session;
class MembershipPlanController extends Controller {
<<<<<<< HEAD
    protected $features;
    public function __construct(FeaturesRepository $features)
    { $this->features = $features;}
=======


    protected $features;

    public function __construct(FeaturesRepository $features)
    {
        $this->features = $features;
    }

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function index(Request $request) { 
        $plans = Plan::get();
        $currentPlan = Auth::user()->currentPlan();
        $faqs = OnboardQuestions::get();
        $features = $this->features->getAllFeatures();
        if (session()->has('redirectToOnboard')) {
            session()->forget('redirectToOnboard');
        }
        return view('membership-plan.index',compact('plans','features','currentPlan','faqs'));
    }
<<<<<<< HEAD
    public function store(Request $request){
=======

    public function store(Request $request){
        //print_r($request->all());exit;
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $user = Auth::user();
        if($request->type == 'month'){
            $eDate = Carbon::now()->addMonth()->format('Y-m-d');
            $sDate = Carbon::now()->format('Y-m-d');
        }else{
            $eDate = Carbon::now()->addYear()->format('Y-m-d');
            $sDate = Carbon::now()->format('Y-m-d');
        }
<<<<<<< HEAD
=======

       /* $chkPlan = CustomerPlanDetails::where(['user_id' => $user->id])->whereDate('starting_date' ,'=', $sDate)->whereDate('expire_date' ,'=', $eDate)->first();*/
       
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $paymentIntentData = [
            'amount' => round($request->total * 100),
            'currency' => 'usd',
            'customer' => $user->stripe_customer_id,
            'off_session' => true,
            'confirm' => true,
            'metadata' => [],
        ];
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $stripPayment = 0;
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        if ($request->cardinfo != '') {
            $paymentIntentData['payment_method'] = $request->cardinfo;
            $stripPayment = 1;
        } else if($request->new_card_payment_method_id != '') {
            $paymentIntentData['payment_method'] = $request->new_card_payment_method_id;
            if ($request->save_card != 1) {
                $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $request->new_card_payment_method_id)->firstOrFail();
                $stripePaymentMethod->delete();
            }
            $stripPayment = 1;
        }else{
            CustomerPlanDetails::create([
                'user_id' => $user->id,
                'plan_id' => $request->plan,
                'amount' => $request->total,
                'starting_date' => $sDate,
                'expire_date' => $eDate,
                'payment_for' => $request->type,
                'price' => $request->total,
                'discount' => $request->discount ?? 0,
                'promo_code_id' => $request->promo_code_id,
                'promo_code_name' => $request->promo_code_name,
                'payment_id' =>'',
                'payload' =>'',
            ]);
        }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        if($stripPayment == 1){
            try {
                $paymentIntent = $stripe->paymentIntents->create($paymentIntentData);
                if ($paymentIntent['status'] == 'succeeded') {
                    
                    CustomerPlanDetails::create([
                        'user_id' => $user->id,
                        'plan_id' => $request->plan,
                        'amount' => $request->total,
                        'starting_date' => $sDate,
                        'expire_date' => $eDate,
                        'payment_for' => $request->type,
                        'price' => $request->price,
                        'discount' => $request->discount,
                        'promo_code_id' => $request->promo_code_id,
                        'promo_code_name' => $request->promo_code_name,
                        'payment_id' => $paymentIntent["id"],
                        'payload' =>json_encode($paymentIntent,true),
                    ]);
<<<<<<< HEAD
                    $user->update(['default_card'=>$paymentIntent['charges']['data'][0]['payment_method_details']['card']['last4']]);
=======

                    $user->update(['default_card'=>$paymentIntent['charges']['data'][0]['payment_method_details']['card']['last4']]);
                    
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                }
            } catch (\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException $e) {
                $errormsg = "Your card is not connected with your account. Please add your card again.";
                return redirect('/choose-plan')->with('stripeErrorMsg', $errormsg);
            } catch (\Exception $e) {
                $errormsg = $e->getError()->message;
                return redirect('/choose-plan')->with('stripeErrorMsg', $errormsg);
            } 
            return redirect()->route('business.subscription.index',['business_id' =>  Auth::user()->cid]);  
        }else{
            return '/business/'.Auth::user()->cid.'/subscription'; 
        }
<<<<<<< HEAD
    }
=======
   
    }

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function getCardForm(Request $request){
        $user = Auth::user();
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $intent = $stripe->setupIntents->create([
                'customer' => @$user->stripe_customer_id,
                'payment_method_types' => ['card']
            ]);

        $plan = Plan::find($request->id);
        $total = $request->type == 'year' ? $plan->price_per_year : $plan->price_per_month;
        $total = $total ?? 0;
        $cardInfo = StripePaymentMethod::where('user_type', 'User')->where('user_id', $user->id)->get();
        $cards = View('membership-plan.cards',['cardInfo' =>$cardInfo])->render();
        return view('membership-plan.card_form', compact('intent','user','cardInfo','request','total','cards'));
    }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function checkPromoCode(Request $request){
        $data = PromoCodes::where('code',$request->pCode)->first();
        if($data){
            if($data->price_in =='$'){
                $dis = $data->price;
                $totalAfterDiscount = $request->price - $data->price;
            }else{
                $dis = ($data->price * $request->price)/100;
                $totalAfterDiscount = $request->price - (($data->price * $request->price)/100);
            }
            $responseArray = [
                'status' => 'success',
                'dis' => $dis,
                'totalAfterDiscount' => $totalAfterDiscount,
                'pCodeName' => $data->code,
                'pCodeId' => $data->id,
            ];
        }else{
            $responseArray = [
                'status' => 'not'
            ];
        }
        return json_encode($responseArray);
    }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function getCardData(){
        $user = Auth::user();
        $cardInfo = StripePaymentMethod::where('user_type', 'User')->where('user_id', $user->id)->get();
        $cards = View('membership-plan.cards',['cardInfo' =>$cardInfo])->render();
        return $cards;
    }
}   