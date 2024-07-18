<?php

namespace App;



use App\{User,SGMailService,BusinessStaff};
use Auth,Storage;
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
        'booking_id', 'sport','business_id', 'booking_detail','zipcode','quote_by_text','quote_by_email','note','schedule','act_schedule_id','priceid','category_id', 'price','qty', 'bookedtime','payment_number','participate','provider_amount','transfer_provider_status', 'provider_transaction_id','provider_transaction_id','extra_fees', 'pay_session', 'expired_at','expired_duration','contract_date','status','refund_date','refund_amount','refund_method' ,'refund_reason','suspend_reason','suspend_started','suspend_ended','suspend_fee','suspend_comment','terminate_reason','terminated_at','terminate_fee','terminate_comment', 'subtotal', 'fitnessity_fee', 'tax', 'tip', 'discount','user_type','user_id', 'repeateTimeType','everyWeeks','monthDays','enddate','activity_days','booking_from','booking_from_id','order_from','calendar_booking_time','addOnservice_total','addOnservice_ids','addOnservice_qty','service_fee' ,'productIds','productQtys','productSize','productColor','productTypes','productTotalPrices','order_type','membership_for','membershipTotalPrices','membershipTotalTax','productTotalTax','suspend_by','terminate_by','refund_by'];
     

    /**

     * Get the user that owns the education.

     */

    protected $appends = ['last_attended','refunded_person','terminated_person','suspended_person'];

    public static function boot(){
        parent::boot();

        self::creating(function($model){
            $type = '';
            if($model->qty){
               $item = json_decode($model->qty,true);
               foreach(['adult', 'child', 'infant'] as $key){
                    if(@$item[$key] != 0){
                        if(!empty($type)) {
                            $type .= ', ';
                        }
                        $type .= ucfirst($key);
                    }
                }
                $model->membership_for = $type;
            }
        });
    }

    public function getLastAttendedAttribute(){
        $checkIn = $this->BookingCheckinDetails()->latest()->first();
        return ($checkIn != '') ? date('m/d/Y',strtotime(@$checkIn->checkin_date)) : 'N/A';
    }

    public function getRefundedPersonAttribute(){
        if($this->refund_by){
            $parts = explode("~~", $this->refund_by);
            if(!empty($parts) && @$parts[0] == 'user'){
                $user = User::find($parts[1]);
                return @$user->full_name;
            }else{
                $user = BusinessStaff::find($parts[1]);
                return @$user->full_name;
            }
        }else{
            if(Auth::check()){
                return Auth::user()->full_name;
            }
            return '';
        }
    }

    public function getTerminatedPersonAttribute(){
        if($this->terminate_by){
            $parts = explode("~~", $this->terminate_by);
            if(!empty($parts) && @$parts[0] == 'user'){
                $user = User::find($parts[1]);
                return @$user->full_name;
            }else{
                $user = BusinessStaff::find($parts[1]);
                return @$user->full_name;
            }
        }else{
            if(Auth::check()){
                return Auth::user()->full_name;
            }
            return '';
        }
    }

    public function getSuspendedPersonAttribute(){
        if($this->suspend_by){
            $parts = explode("~~", $this->suspend_by);
            if(!empty($parts) && @$parts[0] == 'user'){
                $user = User::find($parts[1]);
                return @$user->full_name;
            }else{
                $user = BusinessStaff::find($parts[1]);
                return @$user->full_name;
            }
        }else{
            if(Auth::check()){
                return Auth::user()->full_name;
            }
            return '';
        }
    }

    public function getBookingCheckinDetails(){
       $data = BookingCheckinDetails::where('booking_detail_id',$this->id)->whereMonth('checked_at', date('m'))->first();
       return @$data->checked_at;
    }

    public function BookingCheckinDetails(){
        return $this->hasMany(BookingCheckinDetails::class,'booking_detail_id');
    }

    public function Customer(){
        return $this->belongsTo(Customer::class,'user_id');
    }

    public function Recurring(){
        return $this->hasMany(Recurring::class,'booking_detail_id');
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

    public function businessPriceDetailsAges(){
        return $this->belongsTo(BusinessPriceDetailsAges::class, 'category_id');
    }

     public function businessPriceDetailsAgesTrashed(){
        return $this->belongsTo(BusinessPriceDetailsAges::class, 'category_id')->withTrashed();
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

    public function getCustomer(){
         return $this->Customer->full_name;
    }

    public function provider_get_total(){
        return $this->total() - $this->platform_total();
    }

    public function getActivityPic(){
        if(Storage::disk('s3')->exists($this->business_services_with_trashed->first_profile_pic())) {
            return Storage::url($this->business_services_with_trashed->first_profile_pic()); 
        }else {
            return env('APP_URL').'/images/service-nofound.jpg';
        } 
    }

    public function userBookingDetailQty(){
        $item = json_decode($this->qty,true);
        $totalquantity = 0;
        foreach(['adult', 'child', 'infant'] as $key){
            $totalquantity +=  @$item[$key];
        }
    
        return $totalquantity;
    }

    public function total(){
        $total = 0.0;
        $price = json_decode($this->price);
        $qty = json_decode($this->qty);

        foreach(['adult', 'child', 'infant'] as $key){
            $total += (@$price->$key * @$qty->$key);
        }

        return $total;
    }

    public function platform_total(){
        $fitnessity_fee = BusinessSubscriptionPlan::where('id',1)->first()->fitnessity_fee;
        return round(($this->total() * $fitnessity_fee)/100, 2);
    }

    public function transfer_to_provider(){
        if($this->business_services != ''){
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
                            $transfer_amount = round($transaction->amount/1.039, 2) - $total_fitnessity_fee - $tax;
                        }else{
                            $transfer_amount = round($transaction->amount/1.039, 2);
                        }
                
                        $transfer = $stripe->transfers->create([
                            'amount' => $transfer_amount * 100,
                            'currency' => 'usd',
                            'source_transaction' => $payment_intent->charges->data[0]->id,
                            'destination' => $company_information->stripe_connect_id,
                        ]);

                        if($transfer->id){
                          $transfer_amount += $transaction->amount;
                        }
                    } catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException | \Exception $e) {

                        $this->update(['transfer_provider_status'=>'unpaid', 
                               'provider_amount' => 0]);
                        return;
                    }    
                }

                if(@$transfer->id){
                    $this->update(['transfer_provider_status'=>'paid', 
                                   'provider_amount' => $transfer_amount]);
                }

                return;
            }
            
            try {
                $transaction = Transaction::where('channel', 'stripe')->where('item_type', 'UserBookingStatus')->where('item_id', $this->booking->id)->firstOrFail();
                $transfer_amount = round($this->subtotal - $this->fitnessity_fee - $this->tax - $this->service_fee , 2);

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
            } catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException | \Exception $e) {
                $this->update(['transfer_provider_status'=>'unpaid', 
                               'provider_amount' => 0]);
                        return;
            } 
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
                if(@$pr['from'] == "user"){
                    $user = User::where('id',$pr['id'])->first();
                    $name = @$user->firstname.' '.@$user->lastname .' ( age '. Carbon::parse(@$user->birthdate)->age .' ) ' ; 
                    //$name = Auth::user()->firstname.' '.Auth::user()->lastname .' ( age '. Carbon::parse(Auth::user()->birthdate)->age .' ) ' ;
                    $all_pr .= $name.' </br> ';
                }else if(@$pr['from'] == "customer"){
                    if($this->booking->user_type == 'customer'){
                        $name = str_replace('(me)','',@$pr['pc_name']);
                        $all_pr .= $name.' </br> ';
                    }else{
                        $cus = Customer::where('id',@$pr['id'])->first();
                        $all_pr = @$cus->fname.' '.@$cus->lname.' </br> ';
                    }
                }else{
                    if($this->booking->user_type == 'customer'){
                        $name = str_replace('(me)','',@$pr['pc_name']);
                        $all_pr .= $name.' </br> ';
                    }else{
                        $familydata = UserFamilyDetail::select('first_name','last_name','birthday')->where('id',@$pr['id'])->first();
                        if( $familydata != ''){
                            $name = $familydata->first_name.' '.$familydata->last_name .' ( age '. Carbon::parse($familydata->birthday)->age .' ) ';
                            $all_pr .= $name.' </br> ';
                        }
                    }
                    
                }
            }
        }

        if($all_pr != ''){
            return  rtrim($all_pr,' </br> ');
        }else{
            return  "N/A";
        }
    }

    public function baseSessionCountQuery(){
        return BookingCheckinDetails::where(['booking_detail_id'=> $this->id]);
    }

    public function getWithoutAttendBookedSession(){
        return $this->baseSessionCountQuery()->whereNull('checked_at')->count('use_session_amount');
    }

    public function getUsedSession(){
        return $this->baseSessionCountQuery()->whereNotNull('checked_at')->count('use_session_amount');
    }

    public function getRemainingSessionAfterAttend(){
        $pay_session = $this->pay_session;
        return $pay_session - max($this->getUsedSession(),0);
    }

    public function getremainingsession(){
        $pay_session = $this->pay_session;
        //$checkindetailscnt = $this->baseSessionCountQuery()->whereNotNull('checked_at')->count();
        //$checkindetailscnt = $this->baseSessionCountQuery()->sum('use_session_amount');
        // $checkindetailscnt = $this->baseSessionCountQuery()
        //             ->where('checkin_date' ,'!=',NULL)
        //             ->whereNotNull('checked_at')
        //             ->orWhere(function($query) {
        //                 $query->whereNull('checked_at')
        //                       ->whereDate('checkin_date', '>=', now())->where(['booking_detail_id'=> $this->id]);
        //             })->count();
        
        $checkindetailscnt = $this->baseSessionCountQuery()->whereNotNull('checkin_date')->count();
        return max($pay_session - $checkindetailscnt,0);
    }

    public function getReserveData($feildName)
    {
        $reserve_data = BookingCheckinDetails::where(['booking_detail_id'=> $this->id])->orderBy('checkin_date','desc')->first();
        if($reserve_data != ''){
            $start = date('h:i A', strtotime(@$reserve_data->scheduler->shift_start));
            $end = date('h:i A', strtotime(@$reserve_data->scheduler->shift_end));
            if($reserve_data->checkin_date != '')
                $reserve_date = date('m/d/Y',strtotime($reserve_data->checkin_date));
            if($reserve_data->checked_at != '')
                $check_in_time = date('m/d/Y',strtotime($reserve_data->checked_at));
            $reserve_time = $start .' to '.$end;
        }

        if($feildName == 'reserve_date'){
            return $reserve_date ?? "N/A";
        }
        if($feildName == 'check_in_time'){
            return $check_in_time ?? "N/A";
        }
        if($feildName == 'reserve_time'){
            return $reserve_time ?? "N/A";
        }
        
    }

    public function getextrafees($feeName){
        $extra_fees =  json_decode($this->extra_fees, true);

        return $extra_fees[$feeName] ?? 0;
    }

    public function getperoderprice(){
        $fees = 0;
        
        if($this->tax != 0){
            $fees += $this->tax ;
        }
        if($this->tip != 0){
            $fees +=  $this->tip ;
        }
        if($this->discount != 0){
            $fees -=  $this->discount ;
        }
        if($this->addOnservice_total != 0){
            $fees +=  $this->addOnservice_total ;
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

    public function membershipOrSessionAboutToExpireAlert($type){
        $customer =  $this->Customer;
        if($customer){
            $company = $this->company_information;
            $business_price_detail =  $this->business_price_detail;
            $business_price_details_ages =  $this->businessPriceDetailsAgesTrashed;
            $business_services = $this->business_services;
            $email_detail = array(
                "email" =>$customer->email, 
                "CustomerName" => $customer->full_name, 
                "ReNewUrl" => env('APP_URL').'/activity-details/'.$this->sport, 
                "ProfileUrl" => env('APP_URL').'/profile/viewProfile', 
                "ProviderName"=> $company->dba_business_name,
                "ProgramName"=> @$business_services->program_name,
                "CategoryName"=> @$business_price_details_ages->category_title,
                "PriceOptionName"=> @$business_price_detail->price_title,
                "ExpirationDate"=> date('m/d/Y' ,strtotime($this->expired_at)),
                "ProviderPhoneNumber"=> $company->business_phone,
                "ProviderEmail"=> $company->business_email,
                "ProviderAddress"=> $company->company_address(),
                "for" =>$type
            );
            if($type == 'membership'){
                $date = Carbon::parse($this->expired_at)->subWeek()->format('Y-m-d');
                $today = Carbon::now()->format('Y-m-d');
                if( $date  == $today){
                    SGMailService::sendReminderOfSessionOrMembershipAboutToExpireToCustomer($email_detail);
                }
            }else{
                SGMailService::sendReminderOfSessionOrMembershipAboutToExpireToCustomer($email_detail);
            } 
        }
    }


    public function membershipExpiredAlert($type){
        $customer =  $this->Customer;
        if($customer){
            $company = $this->company_information;
            $business_price_detail =  $this->business_price_detail;
            $business_price_details_ages =  $this->businessPriceDetailsAgesTrashed;
            $email_detail_provider = array(
                "email" =>$company->business_email, 
                "CustomerName" => $customer->full_name, 
                "ProviderName"=> $company->dba_business_name,
                "ProgramName"=> $this->business_services->program_name,
                "CategoryName"=> $business_price_details_ages->category_title,
                "PriceOptionName"=> @$business_price_detail->price_title,
                "ExpirationDate"=> date('m/d/Y' ,strtotime($this->expired_at)),
            );

            $email_detail_customer = array(
                "email" =>$customer->email, 
                "CustomerName" => $customer->full_name, 
                "ReNewUrl" => env('APP_URL').'/activity-details/'.$this->sport, 
                "ProfileUrl" => env('APP_URL').'/profile/viewProfile', 
                "ProviderName"=> $company->dba_business_name,
                "ProgramName"=> $this->business_services->program_name,
                "CategoryName"=> $business_price_details_ages->category_title,
                "PriceOptionName"=> @$business_price_detail->price_title,
                "ExpirationDate"=> date('m/d/Y' ,strtotime($this->expired_at)),
                "ProviderPhoneNumber"=> $company->business_phone,
                "ProviderEmail"=> $company->business_email,
                "ProviderAddress"=> $company->company_address(),
            );
            

            SGMailService::sendReminderOfMembershipExpireToProvider($email_detail_provider);
            SGMailService::sendReminderOfMembershipExpireToCustomer($email_detail_customer);
            
        }
    }

    public function can_void(){
        $transaction = Transaction::where('channel', 'stripe')->where('item_type', 'UserBookingStatus')->where('item_id', $this->userBookingStatus->id)->first();

        if($transaction && $transaction->status == 'requires_capture'){
            return True;
        }else{
            return False;
        }
    }

    public function can_refund(){
        $transaction = Transaction::where('channel', 'stripe')->where('item_type', 'UserBookingStatus')->where('item_id', $this->userBookingStatus->id)->first();

        if($transaction && $transaction->status == 'complete'){
            return True;
        }else{
            return False;
        }
    }

    public function can_terminate(){
        return $this->can_refund() && $this->status == 'active';
    }

    public function can_suspend(){
        return $this->can_refund() && $this->status == 'active';
    }
    

}

