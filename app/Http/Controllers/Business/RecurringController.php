<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\{Recurring,Transaction,StripePaymentMethod};

class RecurringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $business_id)
    {

        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $customer = $company->customers->find($request->customer_id);
        $bookingDetail = $company->UserBookingDetails->find($request->booking_detail_id);
        $autopayListScheduled = $bookingDetail->Recurring()->where('status', 'Scheduled')->orderby('payment_date')->get();
        $autopayListHistory = $bookingDetail->Recurring()->where('status' , 'Completed')->orderby('payment_date')->get();
        $autopayListCnt =  $bookingDetail->Recurring()->count();
        $remaining = count($autopayListScheduled);
        if($request->type == 'history'){
            $pageName = 'Autopay History';
        }else{
            $pageName = 'Autopay Schedule';
        }
        return view('business.recurring.index', ['autopayListScheduled' => $autopayListScheduled, 'autopayListHistory' => $autopayListHistory, 'customer' => $customer,'bookingDetail'=>$bookingDetail,'remaining'=>$remaining ,'i'=>1 ,'business_id'=>$business_id ,'autopayListCnt' =>$autopayListCnt,'type'=>$request->type,'pageName'=>$pageName ]);
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
    public function update(Request $request, $business_id ,$id)
    {
        $rec = Recurring::where('id',$id)->first();
        $rec->update(["payment_date" =>date('Y-m-d',strtotime($request->payment_date)) ,"amount" =>$request->amount]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($business_id,$id)
    {
        $ids = explode(",",$id);
        foreach($ids as $i){
            $recurring_detail = Recurring::findOrFail($i);
            $recurring_detail->delete();
        }
    }


    public function pay_recurring_item(Request $request, $business_id){
        //print_r($request->all());exit;
        $amount = 0;
        $ids = explode(",",$request->ids);
        foreach($ids as $id){
            $recurring_detail = Recurring::findOrFail($id);
            $amount += $recurring_detail->amount + $recurring_detail->tax;
            $stripe_customer_id = $recurring_detail->Customer->stripe_customer_id;
            $card_id = StripePaymentMethod::where('user_id',$recurring_detail->user_id)->first()->payment_id;
        }

        $amount = number_format( $amount ,2,'.','');
        
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        try {
            $payment = $stripe->paymentIntents->create([
                'amount' =>  $amount *100,
                'currency' => 'usd',
                'customer' => $stripe_customer_id,
                'payment_method' => $card_id,
                'off_session' => true,
                'confirm' => true,
                'metadata' => [],
            ]);

            foreach($ids as $id){
                $update_recurring_detail = Recurring::findOrFail($id);
                $charged_amt =  $update_recurring_detail->amount + $update_recurring_detail->tax;
                $update_recurring_detail->update(['charged_amount'=>$charged_amt, 'payment_method' =>'card' ,'stripe_payment_id' => $payment->id ,'status' => 'Completed']);

                $transactiondata = array( 
                    'user_type' => ucfirst($update_recurring_detail->user_type),
                    'user_id' => $update_recurring_detail->user_id,
                    'item_type' =>'Recurring',
                    'item_id' => $update_recurring_detail->id,
                    'channel' =>'stripe',
                    'kind' => 'card',
                    'transaction_id' =>$payment->id,
                    'amount' => $charged_amt ,
                    'qty' =>'1',
                    'status' =>'complete',
                    'refund_amount' =>0,
                    'payload' =>json_encode($payment,true),
                );
                print_r($transactiondata);
                $transactionstatus = Transaction::create($transactiondata);
                $update_recurring_detail->charged();
            }
            return response()->json(['message' => 'success']);
            //$request->session()->put('recurringPayment', 'Autopay Payment is successfully done..');
        } catch(\Exception $e) {
           /* print_r($e);
            echo"ghf";*/
            return response()->json(['message' => 'Autopay payment is failed due to some reason. Please try again latter. ']);

            //$request->session()->put('recurringPayment', 'Autopay payment is failed due to some reason. Please try again latter. ');
        }  
    }
}
