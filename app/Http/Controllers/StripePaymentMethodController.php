<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{StripePaymentMethod,Customer};

class StripePaymentMethodController extends Controller
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
    public function update(Request $request)
    {

        $customer = Customer::find($request->customerID);
        $card = StripePaymentMethod::where('payment_id',$request->cardId)->first();
        //echo $card ;exit;
        try {

            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

            $stripe->paymentMethods->update(
                $request->cardId,
                [
                    'card' => [
                        'exp_month' => $request->month, 
                        'exp_year' => $request->year
                    ]
                ]
            );

            /*$stripe->customers->updateSource(
                $customer->stripe_customer_id,
                $request->cardId,
                [
                    'exp_month' => $request->month, 
                    'exp_year' => $request->year, 
                ]
            );
*/
            $card->exp_month = $request->month;
            $card->exp_year =  $request->year;
            $card->save();
            return "success";
        } catch (InvalidRequestException $e) {
            // Handle Stripe API errors
            return 'Error updating card: ' . $e->getMessage();
        } catch (\Exception $e) {
            // Handle other exceptions
            return 'Error updating card: ' . $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stripePaymentMethod = StripePaymentMethod::where('payment_id', $id)->firstOrFail();

        $stripePaymentMethod->delete();
    }
}
