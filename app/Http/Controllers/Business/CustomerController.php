<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Customer;
use App\StripePaymentMethod;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $business_id, $id)
    {
        //notes
        $company = $request->current_company;

        $customer = $company->customers()->findOrFail($id);

            

        $customer->update(array_merge(
            $request->only(['notes']), []));

        return redirect()->route('business_customer_show',['business_id' => $company->id, 'id'=>$customer->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function visit_membership_modal(Request $request, $business_id ){
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $customer = $company->customers->find($request->id);
        $booking_status = $customer->bookingStatus()->findOrFail($request->booking_id);
        $booking_detail = $booking_status->UserBookingDetail()->findOrFail($request->booking_detail_id);
        return view('customers._edit_membership_info_model', ['booking_detail' => $booking_detail ,'business_id' =>$business_id ,"customer_id"=>$request->id]);
    }

    public function card_editing_form(Request $request, $business_id){
        $company = $request->current_company;

        $customer = $company->customers()->findOrFail($request->customer_id);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

        $intent = $stripe->setupIntents->create(
          [
            'customer' => $customer->stripe_customer_id,
            'payment_method_types' => ['card'],
          ]
        );

        return view('business.customers.card_editing_form', compact('intent'));
    }


    public function refresh_payment_methods(Request $request){
        
        $customer = Customer::findOrFail($request->customer_id);

        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $payment_methods = $stripe->paymentMethods->all(['customer' => $customer->stripe_customer_id, 'type' => 'card']);


        foreach($payment_methods as $payment_method){
            
            $stripePaymentMethod = StripePaymentMethod::firstOrNew([
                'payment_id' => $payment_method['id'],
                'user_type' => 'Customer',
                'user_id' => $customer->id,
            ]);

            $stripePaymentMethod->pay_type = $payment_method['type'];
            $stripePaymentMethod->brand = $payment_method['card']['brand'];
            $stripePaymentMethod->exp_month = $payment_method['card']['exp_month'];
            $stripePaymentMethod->exp_year = $payment_method['card']['exp_year'];
            $stripePaymentMethod->last4 = $payment_method['card']['last4'];
            $stripePaymentMethod->save();

        }
        if($request->return_url)
            return redirect($request->return_url);
    }
}
