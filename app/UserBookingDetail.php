<?php

namespace App;



use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class UserBookingDetail extends Model

{

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */
    use SoftDeletes;
    protected $table = 'user_booking_details';
    public $timestamps = false;
	protected $fillable = [
        'booking_id', 'sport','business_id', 'booking_detail','zipcode','quote_by_text','quote_by_email','note','schedule','act_schedule_id','priceid', 'price','qty', 'bookedtime','payment_number','participate','provider_amount','transfer_provider_status', 'provider_transaction_id','provider_transaction_id','extra_fees', 'pay_session', 'expired_at','expired_duration','contract_date','status','refund_date','refund_amount','refund_method' ,'refund_reason','suspend_reason','suspend_started','suspend_ended','suspend_fee','suspend_comment','terminate_reason','terminated_at','terminate_fee','terminate_comment', 'subtotal', 'fitnessity_fee', 'tax', 'tip', 'discount','user_type','user_id'
    ];


    /**

     * Get the user that owns the education.

     */

    public function getBookingCheckinDetails(){
       $data = BookingCheckinDetails::where('booking_detail_id',$this->id)->whereMonth('checked_at', date('m'))->first();
       return @$data->checked_at;
    }

    public function BookingCheckinDetails(){
        return $this->hasMany(BookingCheckinDetails::class,'booking_detail_id');
    }

    public function BookingActivityCancel(){
        return $this->hasMany(BookingActivityCancel::class,'booking_detail_id');
    }

    public function userBookingStatus()
    {
		return $this->belongsTo(UserBookingStatus::class, 'booking_id');
    }


    public function booking(){
        return $this->belongsTo(UserBookingStatus::class, 'booking_id');
    }

    public function business_services(){
        return $this->belongsTo(BusinessServices::class, 'sport');
    }

    public function business_services_with_trashed(){
        return $this->belongsTo(BusinessServices::class, 'sport')->withTrashed();
    }

    public function company_information(){
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function business_price_detail(){

        return $this->belongsTo(BusinessPriceDetails::class, 'priceid');

    }
    public function business_price_detail_with_trashed(){
        return $this->belongsTo(BusinessPriceDetails::class, 'priceid')->withTrashed();
    }

    public function business_activity_scheduler(){

        return $this->belongsTo(BusinessActivityScheduler::class, 'act_schedule_id');

    }

    public static function getbyid($book_id){
        return UserBookingDetail::where('id',$book_id)->first();
    }

    public function provider_get_total(){
        return $this->total() - $this->platform_total();
    }

    public function total(){
        $total = 0.0;
        $price = json_decode($this->price);
        $qty = json_decode($this->qty);

        foreach(['adult', 'child', 'infant'] as $key){
            $total += ($price->$key * $qty->$key);
        }

        return $total;
    }

    public function platform_total(){
        $fitnessity_fee = BusinessSubscriptionPlan::where('id',1)->first()->fitnessity_fee;
        return round(($this->total() * $fitnessity_fee)/100, 2);
    }

    public function transfer_to_provider(){
      $company_information = $this->business_services->company_information;

      $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

      if($this->booking->order_type == 'checkout_register'){
        
        $transactions = Transaction::where('channel', 'stripe')->where('item_type', 'UserBookingStatus')->where('item_id', $this->booking->id)->get();
        $transfer_amount = 0;

        $total_fitnessity_fee = UserBookingDetail::where('booking_id', $this->booking->id)->sum('fitnessity_fee');
        $tax = UserBookingDetail::where('booking_id', $this->booking->id)->sum('tax');
        
        foreach($transactions as $transaction){

          $payment_intent = $stripe->paymentIntents->retrieve(
              $transaction->transaction_id,
              []
          );
          try {
            if($transaction->amount > $total_fitnessity_fee){
                $transfer_amount = $transaction->amount - $total_fitnessity_fee - $tax;
            }else{
                $transfer_amount = $transaction->amount;
            }
            var_dump($transfer_amount);
            
            $transfer = $stripe->transfers->create([
                'amount' => $transfer_amount * 100,
                'currency' => 'usd',
                'source_transaction' => $payment_intent->charges->data[0]->id,
                'destination' => $company_information->stripe_connect_id,
            ]);


            if($transfer->id){
              $transfer_amount += $transaction->amount;
            }
          } catch(\Exception $e) {
            var_dump($e);
            $this->update(['transfer_provider_status'=>'paid', 
                           'provider_amount' => 0]);
            return;
          }    
        }

        if($transfer->id){
            $this->update(['transfer_provider_status'=>'paid', 
                           'provider_amount' => $transfer_amount]);
        }

        return;
      }
        
      try {

        $transaction = Transaction::where('channel', 'stripe')->where('item_type', 'UserBookingStatus')->where('item_id', $this->booking->id)->firstOrFail();


        $transfer_amount = round($this->subtotal - $this->fitnessity_fee, 2);


        $payment_intent = $stripe->paymentIntents->retrieve(
            $transaction->transaction_id,
            []
        );


                  
        $transfer = $stripe->transfers->create([
            'amount' => $transfer_amount * 100,
            'currency' => 'usd',
            'source_transaction' => $payment_intent->charges->data[0]->id,
            'destination' => $company_information->stripe_connect_id,
        ]);

        if($transfer->id){
            $this->update(['transfer_provider_status'=>'paid', 
                           'provider_amount' => $transfer_amount ,
                           'provider_transaction_id' => $transfer->id]);
        }


          

      } catch(\Exception $e) {
        var_dump($e);
      }    
    }

    public function getparticipate(){
        $participate = '';
        $qty =  json_decode($this->qty);
        if(!empty($qty)){
            foreach(['adult', 'child', 'infant'] as $key){
                if($qty->$key != 0 && $qty->$key != ''){
                    $participate .=  $key.':'.$qty->$key.'</br>';
                }
            }
        }
        return rtrim($participate,' </br> ');
    }

    public function decodeparticipate(){
        $participate =  json_decode($this->participate,true);
        $all_pr = '';
        if(!empty($participate) && count($participate)>0){
            foreach($participate as $pr){
                if($pr['from'] == "user"){
                    $name = Auth::user()->firstname.' '.Auth::user()->lastname .' ( age '. Carbon::parse(Auth::user()->birthdate)->age .' ) ' ;
                    $all_pr .= $name.' </br> ';
                }else if($pr['from'] == "customer"){
                    $name = str_replace('(me)','',$pr['pc_name']);
                    $all_pr .= $name.' </br> ';
                }else{
                     
                    if($this->booking->user_type == 'customer'){
                        $name = str_replace('(me)','',$pr['pc_name']);
                        $all_pr .= $name.' </br> ';
                    }else{
                        $familydata = UserFamilyDetail::select('first_name','last_name','birthday')->where('id',$pr['id'])->first();
                        if( $familydata != ''){
                            $name = $familydata->first_name.' '.$familydata->last_name .' ( age '. Carbon::parse($familydata->birthday)->age .' ) ';
                            $all_pr .= $name.' </br> ';
                        }
                    }
                    
                }
            }
        }
        return  rtrim($all_pr,' </br> ');
    }

    public function getremainingsession(){
        $pay_session = $this->pay_session;
        //$checkindetailscnt = BookingCheckinDetails::where(['booking_detail_id'=> $this->id])->whereNotNull('checked_at')->count();
        $checkindetailscnt = BookingCheckinDetails::where(['booking_detail_id'=> $this->id])->sum('use_session_amount');
        $remaining = $pay_session - $checkindetailscnt;
        return $remaining;
    }

    public function getReserveData($feildName)
    {
        $reserve_data = BookingCheckinDetails::where(['booking_detail_id'=> $this->id])->select('checkin_date')->orderBy('checkin_date','desc')->first();
        
        $reserve_date = $reserve_time = $check_in_time ="—";
        if($reserve_data != ''){
            $start = date('h:ia', strtotime(@$reserve_data->scheduler->shift_start));
            $end = date('h:ia', strtotime(@$reserve_data->scheduler->shift_end));
            if($reserve_data->checkin_date != '')
                $reserve_date = date('m-d-Y',strtotime($reserve_data->checkin_date));
            if($reserve_data->checked_at != '')
                $check_in_time = date('m-d-Y',strtotime($reserve_data->checked_at));

            $reserve_time = $start .' to '.$end;
        }
        if($feildName == 'reserve_date'){
            return $reserve_date;
        }
        if($feildName == 'check_in_time'){
            return $check_in_time;
        }
        if($feildName == 'reserve_time'){
            return $reserve_time;
        }
        
    }

    public function getextrafees($feeName){
        $extra_fees =  json_decode($this->extra_fees, true);

        return $extra_fees[$feeName] ?? 0;
    }

    public function getperoderprice(){
        $fees = 0;
        /*$extra_fees =  json_decode($this->extra_fees, true);
        if(!empty($extra_fees)){
            foreach($extra_fees as $key => $value){
                if($key == 'service_fee' ){
                    $fees += ($this->total() * $value) /100;
                }else if($key == 'discount'){
                    $fees -= $value;
                }else if($key == 'fitnessity_fee'){
                    $fees += 0;
                }else{
                    $fees += $value;
                }
            }
        }*/
       
        if($this->tax != 0){
            $fees += $this->tax ;
        }
        if($this->tip != 0){
            $fees +=  $this->tip ;
        }
        if($this->discount != 0){
            $fees -=  $this->discount ;
        }
        if($this->fitnessity_fee != 0){
            $fees +=  $this->fitnessity_fee ;
        }

        return $fees;
    }

    public static function getexpiretime($time,$contract_date){
        $expired_at = '';
        $explodetime = explode(' ',$time);
        if(!empty($explodetime) && array_key_exists(1, $explodetime)){
            if($explodetime[1] == 'Months'){
                $daynum = '+'.$explodetime[0].' month';
                $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
            }else if($explodetime[1] == 'Days'){
                $daynum = '+'.$explodetime[0].' days';
                $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
            }else if($explodetime[1] == 'Weeks'){
                $daynum = '+'.$explodetime[0].' weeks';
                $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
            }else {
                $daynum = '+'.$explodetime[0].' years';
                $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
            }
        }
        return $expired_at;
    }

    public function getDuration(){
        $date1 = Carbon::parse($this->contract_date);
        $date2 = Carbon::parse($this->expired_at);

        $totalDuration = $date2->diff($this->contract_date);
        $string = "";

        if($totalDuration->format('%Y') > 0){
            $string .= $totalDuration->format(" %Y year");
        }

        if($totalDuration->format('%m') > 0){
            $string .= $totalDuration->format(" %m month");
        }

        if($totalDuration->format('%d') > 0){
            $string .= $totalDuration->format(" %d day");
        }
        return trim($string);
    }

    public function can_schedule(){
        
    }
}

