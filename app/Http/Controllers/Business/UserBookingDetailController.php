<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\{UserBookingDetail,UserBookingStatus, Transaction};

class UserBookingDetailController extends Controller
{
    //  
	
    protected $loggedId;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Session::has('StaffLogin')) {
                $this->loggedId = 'staff~~'.Session::get('StaffLogin');
            } elseif (Auth::check()) {
                $this->loggedId = 'user~~'.Auth::user()->id;
            } else {
                $this->loggedId = null;
            }

            return $next($request);
        });
    }


	public function index()
    {
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $business_id)
    {
        $company = $request->current_company->findOrFail($business_id);
        $customer = $company->customers()->findOrFail($request->customer_id);
        $booking_detail = $customer->bookingDetail()->findOrFail($request->booking_detail_id);
        if($request->expired_at){
            $expired_at = date('Y-m-d',strtotime($request->expired_at));
        }

        if($request->contract_date){
            $contract_date = date('Y-m-d',strtotime($request->contract_date));
        }
           $update = $booking_detail->update([
            'pay_session' =>$request->pay_session,
            'contract_date' =>$contract_date, 
            'expired_at'=>$expired_at
        ]);
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $business_id,$id)
    {
        $company = $request->current_company->findOrFail($business_id);
        $customer = $company->customers()->findOrFail($request->customer_id);
        $booking_detail = $customer->bookingDetail()->findOrFail($request->booking_detail_id);
        $booking_detail->update(["status" => 'void']);
    }
 
    public function refund(Request $request, $business_id, $booking_id){
        $company = $request->current_company->findOrFail($business_id);        
        $customer = $company->customers()->findOrFail($request->customer_id);

        $booking_detail = $customer->bookingDetail()->findOrFail($request->booking_detail_id);
            if($booking_detail->can_refund()){
                if($request->refund_method == 'credit'){
                    $transaction=Transaction::whereIn('user_type', ['customer', 'user'])->where('item_id',$booking_id)->whereIn('user_id',[$customer->id,$customer->user_id])->first();
                    if($transaction && $transaction->can_refund()){
                        if(!$transaction->refund($request->refund_amount ? $request->refund_amount : Null)){
                            return response()->json(['message' => 'refund failed.'], 400);
                        }
                            if($request->return_method=='credit')
                            {
                                    try
                                    {
                                        \Stripe\Stripe::setApiKey(env('SECRET_KEY'));    
                                        $refund = \Stripe\Refund::create([
                                            'charge' => $transaction->transaction_id, 
                                            'amount' => intval($request->refund_amount * 100), 
                                        ]);

                                        if (!$refund->status || $refund->status !== 'succeeded') 
                                        {
                                            return response()->json(['message' => 'Refund failed.'], 400);
                                        }
                                    } 
                                    catch (\Exception $e) 
                                    {
                                        return response()->json(['message' => 'Refund failed: ' . $e->getMessage()], 400);
                                    }
                            }
                        }
                }
                else{
                    return response()->json(['message' => 'not pay by credit card ot transction can not found'], 400);
                }
            $result = [
                'status' => 'refund',
                'expired_at' => date('Y-m-d',strtotime($request->refund_date)),
                "refund_amount" => $request->refund_amount,
                "refund_method" => $request->refund_method,
                "refund_date" => date('Y-m-d',strtotime($request->refund_date)),
                "refund_reason" => $request->refund_reason,
                "refund_by" => $this->loggedId,
            ];
            $booking_detail->update($result);
        }
        else{
            return response()->json(['message' => 'membership can not found'], 400);
        }
        
    } 

    public function suspend(Request $request, $business_id){

        $company = $request->current_company->findOrFail($business_id);
        $customer = $company->customers()->findOrFail($request->customer_id);

        $booking_detail = $customer->bookingDetail()->findOrFail($request->booking_detail_id);

        if($booking_detail->can_suspend()){
            if($request->stop_recurring == 1){
                if($customer->charge($request->suspension_fee, 'terminate')){
                    $booking_detail->update(["status" => 'suspend' ,
                                            'stop_reccuring'=>$request->stop_recurring,
                                            'suspend_reason' => $request->suspension_reason,
                                            'suspend_started' => date('Y-m-d',strtotime($request->suspensionstartdate)),
                                            'suspend_ended' =>date('Y-m-d',strtotime($request->suspensionenddate)) ,
                                            'suspend_fee' => $request->suspension_fee,
                                            'suspend_comment' =>$request->suspension_comment,
                                            'suspend_by' => $this->loggedId]);
                }
                else{
                    return response()->json(['message' => 'charge user failed.'], 400);
                }
            }
            else{
                $booking_detail->update(["status" => 'suspend',
                'suspend_reason' => $request->suspension_reason,
                'suspend_started' => date('Y-m-d',strtotime($request->suspensionstartdate)),
                'suspend_ended' =>date('Y-m-d',strtotime($request->suspensionenddate)) ,
                'suspend_comment' =>$request->suspension_comment,
                'suspend_by' => $this->loggedId]);
            }
        }else{
            return response()->json(['message' => 'is not acive membership, can not suspend.'], 400);
        }
        
    } 

    public function terminate(Request $request, $business_id){
        $company = $request->current_company->findOrFail($business_id);
        $customer = $company->customers()->findOrFail($request->customer_id);

        $booking_detail = $customer->bookingDetail()->findOrFail($request->booking_detail_id);

        if($booking_detail->can_terminate()){
            if($request->terminate_fee > 0){
                if($customer->charge($request->terminate_fee, 'terminate')){
                    $booking_detail->update(["status" => 'terminate' ,
                                            'expired_at' => date('Y-m-d',strtotime($request->terminated_at)),
                                            'terminate_reason' => $request->terminate_reason,
                                            'terminated_at' => date('Y-m-d',strtotime($request->terminated_at)),
                                            'terminate_fee' => $request->terminate_fee,
                                            'terminate_comment' =>$request->terminate_comment,
                                            'terminate_by' => $this->loggedId]);
                }else{
                    return response()->json(['message' => 'charge user failed.'], 400);
                }
            }
        }else{
            return response()->json(['message' => 'is not acive membership, can not terminate.'], 400);
        }
    }

    public function void(Request $request, $business_id, $booking_id){
        $company = $request->current_company->findOrFail($business_id);

        $customer = $company->customers()->findOrFail($request->customer_id);
        

        $transaction = $customer->Transaction()->where('item_id', $booking_id)->first();

        if($transaction->can_void()){
            $transaction->void(); 
            $customer->bookingDetail()->where('booking_id', $booking_id)->update(["status" => 'void']);
        }else{
            return response()->json(['message' => 'transction not found or already complete, can only refund'], 400);
        }
    }
    public function cancelFreeze(Request $request)
    {
        $decryptedId = decrypt($request->input('booking_id'));
        $booking_detail = UserBookingDetail::where('id',$decryptedId)->first();
        $booking_detail->update([
            'status' => 'active',
            'stop_reccuring'=>Null,
            'suspend_reason' => Null,
            'suspend_started' => Null,
            'suspend_ended' =>Null,
            'suspend_comment' =>Null,
            'suspend_by' => NULL,
            'suspend_fee'=>Null,
        ]);

        return response()->json(['message' => 'Freeze cancelled successfully']);

    }
}
