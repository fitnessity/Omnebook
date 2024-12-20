<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\{Recurring,Transaction,StripePaymentMethod,Customer,SGMailService};

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
        $autopayListScheduled = $bookingDetail->Recurring()->where('status','!=','Completed')->orderby('payment_on')->get();
        $autopayListHistory = $bookingDetail->Recurring()->where('status' , 'Completed')->orderby('payment_on')->get();
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
        $rec->update(["payment_date" =>date('Y-m-d',strtotime($request->payment_date)),"payment_on" =>date('Y-m-d'),"amount" =>$request->amount,"tax" =>$request->tax]);
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
            $recurringDetail = Recurring::findOrFail($i);
            $recurringDetail->delete();
        }
    }

    public function pay_recurring_item(Request $request, $business_id){

        $company = $request->current_company;
        $stripeCustomerId = $cardID = $customer = $priceOption = $category = '' ;  $amount = 0;   $cardDetails = [];
        $ids = explode(',', $request->ids);
        $recurringDetails = Recurring::whereIn('id', $ids)->get();
        foreach ($recurringDetails as $recurringDetail) {
            $customer = Customer::where('id' ,$recurringDetail->user_id)->first();
            $priceOption = $recurringDetail->UserBookingDetail != '' ? $recurringDetail->UserBookingDetail->business_price_detail_with_trashed : '';
            $category =  @$priceOption->business_price_details_ages_with_trashed;

            $amount += $recurringDetail->amount + $recurringDetail->tax;
            $stripeCustomerId = $recurringDetail->Customer != '' ? $recurringDetail->Customer->stripe_customer_id : '';
            $cardDetails = StripePaymentMethod::whereRaw('((user_type = "User" and user_id = ?) or (user_type = "Customer" and user_id = ?))', [@$customer->user_id, $recurringDetail->user_id])->get();
        }

        $chkCard = 1;
        if(!empty($cardDetails) && $stripeCustomerId){
            foreach($cardDetails as $card){
                if($chkCard == 1){
                    $cardID = $card->checkCardValidity($stripeCustomerId,$card->payment_id);
                }
                if($cardID){
                    $chkCard = 0;
                }

            }
        }
        
        $amount = number_format( $amount ,2,'.','');
        $emailDetailProvider = array(
            'CompanyImage'=> $company->getCompanyImage(),
            'CompanyName'=> $company->company_name,
            'ProviderName'=> $company->full_name,
            'CustomerName'=> @$customer->full_name,
            'PriceOption'=> @$priceOption->price_title,
            'CategoryName'=> @$category->category_title ,
            'amount'=> $amount,
            'email'=> $company->business_email,
        );

        $emailDetailCustomer = array(
            'CompanyImage'=> $company->getCompanyImage(),
            'CompanyName'=> $company->company_name,
            'ProviderName'=> $company->full_name,
            'address'=> $company->company_address(),
            'ProviderEmail'=> $company->business_email,
            'phone'=> $company->business_phone,
            'CustomerName'=> @$customer->full_name,
            'email'=> @$customer->email,
            'PriceOption'=> @$priceOption->price_title,
            'CategoryName'=> @$category->category_title ,
            'amount'=> $amount,
            'Website' => env('APP_URL'),
            'url'=> env('APP_URL').'personal/manage-account',
        );

        if($cardID != '' && $stripeCustomerId != ''){
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            try {
                $payment = $stripe->paymentIntents->create([
                    'amount' =>  $amount *100,
                    'currency' => 'usd',
                    'customer' => $stripeCustomerId,
                    'payment_method' => $cardID,
                    'off_session' => true,
                    'confirm' => true,
                    'metadata' => [],
                ]);

                foreach($ids as $id){
                    $update_recurring_detail = Recurring::findOrFail($id);
                    $charged_amt =  $update_recurring_detail->amount + $update_recurring_detail->tax;
                    $update_recurring_detail->update(['charged_amount'=>$charged_amt, 'payment_method' =>'card' ,'stripe_payment_id' => $payment->id ,'status' => 'Completed','payment_on' => date('Y-m-d')]);

                    $transactiondata = array( 
                        'user_type' =>$update_recurring_detail->user_type,
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
                    //print_r($transactiondata);
                    $transactionstatus = Transaction::create($transactiondata);
                    $update_recurring_detail->charged();
                }
                return response()->json(['message' => 'success']);
            }catch(\Stripe\Exception\CardException $e ) {
                $error_msg = $e->getError()->message;
            }catch(\Stripe\Exception\ApiErrorException  $e ) {
                $error_msg = $e->getMessage();
            }catch(\Stripe\Exception\AuthenticationException  $e ) {
                $error_msg = "Stripe can’t authenticate you with the information provided";
            }catch(\Stripe\Exception\InvalidRequestException $e ) {
                $error_msg = 'An invalid request occurred in stripe';
                if (isset($e->getError()->param)) {
                    $error_msg =  "The parameter {$e->getError()->param} is invalid or missing.";
                }
            }catch(\Stripe\Exception\RateLimitException $e ) {
                $error_msg = "Our system is currently experiencing a high volume of requests, and as a result, we've received too many API calls in a short period of time. We will try again later. We apologize for any inconvenience";
            }catch(\Stripe\Exception\StripeApiException $e ) {
                $error_msg = $e->getError()->message;
            }catch(\Stripe\Exception\NetworkException $e ) {
                $error_msg = $e->getError()->message;
            }catch(\Stripe\Exception\InvalidResponseException  $e ) {
                $error_msg = "We're sorry, but there was a problem processing your payment due to a network error. Please try again later";
            }catch(\Stripe\Exception\StripeServerException   $e ) {
                $error_msg = $e->getError()->message;
            }catch (Exception $e) {
                $error_msg = 'Another problem occurred, maybe unrelated to Stripe';
            }

            if($error_msg){
                Recurring::whereIn('id', $ids)->update(['status' => 'Retry']);
                SGMailService::sendAutoPayFaildAlertToProvider($emailDetailProvider);
                SGMailService::sendAutoPayFaildAlertToCustomer($emailDetailCustomer);
                return response()->json(['message' => $error_msg]);
            }
        }else{
            Recurring::whereIn('id', $ids)->update(['status' => 'Retry']);
            SGMailService::sendAutoPayFaildAlertToProvider($emailDetailProvider);
            SGMailService::sendAutoPayFaildAlertToCustomer($emailDetailCustomer);
            return response()->json(['message' => 'Credit Card is not valid. Please Add again.']);
        }
    }
}
