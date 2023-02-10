<?php

namespace App;



use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class UserBookingDetail extends Model

{

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public $timestamps = false;
    protected $table = 'user_booking_details';
	protected $fillable = [
        'booking_id', 'sport', 'booking_detail','zipcode','quote_by_text','quote_by_email','note','schedule','act_schedule_id','priceid', 'price','qty', 'bookedtime','payment_number','participate','provider_amount','transfer_provider_status', 'provider_transaction_id','provider_transaction_id','extra_fees', 'pay_session', 'expired_at','expired_duration','contract_date'
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

    public function UserBookingStatus()
    {
     	//return $this->belongsTo(UserBookingStatus::class, 'booking_id');
		return $this->belongsToMany(UserBookingStatus::class, 'booking_id'); ///nnn 22-10-2022
    }


    public function booking(){
        return $this->belongsTo(UserBookingStatus::class, 'booking_id');
    }

    public function business_services(){
        return $this->belongsTo(BusinessServices::class, 'sport');
    }

    public function business_price_detail(){

        return $this->belongsTo(BusinessPriceDetails::class, 'priceid');

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
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

        $company_information = $this->business_services->company_information;
        /*print_r($this->business_services);
        print_r($this->business_services->company_information);
        echo $company_information;exit;*/
        try {
            $transfer_amount = $this->provider_get_total();
            $stripe_account  = $stripe->accounts->retrieveCapability(
                $company_information->stripe_connect_id,
                'transfers',
                []
            );

            $payment_intent = $stripe->paymentIntents->retrieve(
                $this->booking->stripe_id,
                []
            );

            if($stripe_account['status'] == 'active'){
                    
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

            }
            

        } catch(\Exception $e) {
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
                    $familydata = UserFamilyDetail::select('first_name','last_name','birthday')->where('id',$pr['id'])->first();
                    if( $familydata != ''){
                        $name = $familydata->first_name.' '.$familydata->last_name .' ( age '. Carbon::parse($familydata->birthday)->age .' ) ';
                        $all_pr .= $name.' </br> ';
                    }
                }
            }
        }
        return  rtrim($all_pr,' </br> ');
    }

    public function getremainingsession(){
        $pay_session = $this->pay_session;
        //$checkindetailscnt = BookingCheckinDetails::where(['booking_detail_id'=> $this->id])->whereNotNull('checked_at')->count();
        $checkindetailscnt = BookingCheckinDetails::where(['booking_detail_id'=> $this->id])->whereNotNull('checked_at')->sum('use_session_amount');
        $remaining = $pay_session - $checkindetailscnt;
        return $remaining;
    }

}

