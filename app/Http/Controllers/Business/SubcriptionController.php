<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\{User,CompanyInformation,CustomerPlanDetails,Transaction,StripePaymentMethod,Plan,PromoCodes};
use Str;
use DateTime;
use Carbon\Carbon;
use \PDF;

class SubcriptionController extends Controller {
	
	public function index(Request $request) { 
		$stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
		$intent = $stripe->setupIntents->create([
            'customer' => Auth::user()->stripe_customer_id,
            'payment_method_types' => ['card']
        ]);
		$cardInfo = StripePaymentMethod::where('user_type', 'User')->where('user_id', Auth::user()->id)->get();
		$cardForm = view('business.settings.subscriptions.card_form',['cardInfo'=>$cardInfo ,'intent'=>$intent,'user'=>Auth::user()])->render(); 

		$plans = CustomerPlanDetails::where('user_id',Auth::user()->id)->get();
		$years = CustomerPlanDetails::where('user_id',Auth::user()->id)->selectRaw('YEAR(starting_date) as year')->distinct()->pluck('year')->toArray();

        $currentPlan = CustomerPlanDetails::where('user_id',Auth::user()->id)->latest()->first();

        return view('business.settings.subscriptions.index',compact('cardForm','plans','years','currentPlan'));
    }

    public function update_card(Request $request){
    	if ($request->has('cardinfo')) {
            $data = StripePaymentMethod::where('payment_id', $request->cardinfo)->first();
            Auth::user()->update(['default_card'=>$data->last4]);
        }
        return redirect()->route('business.subscription.index')->with('success','Your card is saved.');
    }

    public function get_plan_html(Request $request){
    	$plans = CustomerPlanDetails::where('user_id',Auth::user()->id);
    	if($request->year != 'all'){
    		$plans = $plans->whereYear('starting_date',$request->year);
    	}
    	$plans = $plans->get();
    	return view('business.settings.subscriptions._plan_data',compact('plans'))->render();
    }

    public function export(Request $request){

        $user = Auth::user();
        $plan = CustomerPlanDetails::find($request->id);
        $paymentIntent = json_decode($plan->payload);
        $card = $paymentIntent != ''  ? $paymentIntent->charges->data[0]->payment_method_details->card->last4 : '';
        $method =  $paymentIntent != ''  ? $paymentIntent->charges->data[0]->payment_method_details->card->brand : 'N/A';
        $data = [
            'user'=>$user,
            'customerPlan'=>$plan,
            'method'=>$method,
            'card'=>$card,
            'app_url'=> env('APP_URL'),
        ];
        
        $pdf = PDF::loadView('business.settings.subscriptions.pdf',$data);
        $fileName = $plan->invoice_no != '' ? $plan->invoice_no.'.pdf' : 'invoice.pdf';
        return $pdf->download($fileName);
    }
}