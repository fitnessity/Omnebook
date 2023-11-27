<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\{User,CompanyInformation,CustomerPlanDetails,Transaction,StripePaymentMethod,Plan};
use App\Repositories\FeaturesRepository;
use Str;
use DateTime;

class MembershipPlanController extends Controller {


    protected $features;

    public function __construct(FeaturesRepository $features)
    {
        $this->features = $features;
    }

    public function index(Request $request) { 
        $plans = Plan::get();
        $features = $this->features->getAllFeatures();
        return view('membership-plan.index',compact('plans','features'));
    }

    public function store(Request $request){
        //print_r($request->all());exit;
        $currentDate = new DateTime();
        $sDate = $currentDate->format('Y-m-d');
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
        $user = Auth::user();
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $intent = $stripe->setupIntents->create(
          [
            'customer' => @$user->stripe_customer_id,
            'payment_method_types' => ['card'],
          ]
        );

        $cardInfo = StripePaymentMethod::where('user_type', 'User')->where('user_id', $user->id)->get();
        return view('membership-plan.card_form', compact('intent','user','cardInfo'));
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
}   