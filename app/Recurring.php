<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use App\{Transaction,User,Customer,SGMailService,StripePaymentMethod};

// /use Illuminate\Database\Eloquent\SoftDeletes;

class Recurring extends Authenticatable
{

	 //use SoftDeletes;
    protected $table = 'recurring';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'booking_detail_id', 'user_id', 'user_type', 'business_id', 'payment_date', 'amount', 'tax', 'charged_amount', 'payment_method', 'stripe_payment_id', 'status','transfer_provider_status','provider_amount','provider_transaction_id','attempt','payment_number','payment_on','error_msg'];
    protected $appends = ['total_amount' ,'card','customer_name' ,'customer_id','membership_name'];

    public function getTotalAmountAttribute(){

        return number_format($this->amount + $this->tax,2);
    }

    public function getCardAttribute(){
        $transaction = Transaction::where(['item_id' => $this->id ,'item_type' => 'Recurring'])->first();
        if($transaction){
            $card = $transaction->getPmtMethod();
        }
        return $card ?? 'N/A';
    }


    public function getMembershipNameAttribute(){
        return $this->UserBookingDetail->business_services_with_trashed->program_name.' ('.$this->UserBookingDetail->business_price_detail_with_trashed->price_title.')';
    }

    public function getCustomerNameAttribute(){
        if($this->user_type == 'user'){
            $user = User::find($this->user_id);
            $customer = Customer::where(['user_id'=>@$user->user_id, 'email' => @$user->email])->first();
            return @$customer->full_name;
        }else{
            $customer = Customer::find($this->user_id);
            return @$customer->full_name;
        }
    }

    public function getCustomerIdAttribute(){
        if($this->user_type == 'user'){
            $user = User::find($this->user_id);
            $customer = Customer::where(['user_id'=>@$user->user_id, 'email' => @$user->email])->first();
            return @$customer->id;
        }else{
            return $this->user_id;
        }
    }

    public function company_information(){
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function UserBookingDetail(){
        return $this->belongsTo(UserBookingDetail::class, 'booking_detail_id');
    }

    public function Customer(){
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function autoPayRemaining($totalCount,$id){
        //echo $totalCount;
        $paymentDoneCount = Recurring::where('booking_detail_id',$id)->where('stripe_payment_id' ,'==' , '')->where('user_type','customer')->count();
        $remaining = $totalCount - $paymentDoneCount;
        return $remaining;
    }

    public function getStripeCard(){
        $stripe = new \Stripe\StripeClient(
            config('constants.STRIPE_KEY')
        );

        $last4 = '';
        $card_id = 'N/A';
        $brand = '';
        $stripe_id = $this->stripe_payment_id;
        $payment_method = $this->payment_method;
    
        if($stripe_id != '' && $payment_method == 'card'){
            try{
                $payment_intent = $stripe->paymentIntents->retrieve(
                    $stripe_id,
                    []
                );
                $last4 = $payment_intent['charges']['data'][0]['payment_method_details']['card']['last4'];
                $brand = $payment_intent['charges']['data'][0]['payment_method_details']['card']['brand'];

                $card_id =  ucfirst($brand).'  XXXX '.$last4;
            }catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException $e) {
            }catch(Exception $e){
            }
        }else{
            $card = StripePaymentMethod::where('payment_id' , $payment_method)->first();
            if($card){
                $card_id = ucfirst($card->brand).'  XXXX '.@$card->last4;
            }else{
                $lastCard = StripePaymentMethod::where(['user_id' => $this->user_id ,'user_type' => 'Customer'])->latest()->first();
                $card_id = (@$lastCard->last4) ? ucfirst($lastCard->brand).'  XXXX '.@$lastCard->last4 : '';
            }
        }

        return $card_id ?? 'N/A';
    }

    public function createRecurringPayment(){
        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

        if ($this->user_type == 'user') {
            $customer = User::find($this->user_id);
            $personalData = $this->User;
        } else {
            $customer = Customer::find($this->user_id); 
            $personalData = $this->Customer;
        }

        $stripeCustomerId = @$customer->stripe_customer_id;
        $cardDetails = @$customer != '' ? $customer->stripePaymentMethods()->latest()->first() : '';
        $stripeCardID = $cardDetails ? $cardDetails->payment_id : null;
       
        $cardID =  $this->payment_method;
        $cardID = $cardID != ''  ?  $cardID : $stripeCardID;
            
        $priceOption = $this->UserBookingDetail != '' ? $this->UserBookingDetail->business_price_detail_with_trashed : '';
        $category =  @$priceOption->business_price_details_ages_with_trashed;
        $emailDetailProvider = array(
            'CompanyImage'=> $this->company_information->getCompanyImage(),
            'CompanyName'=> $this->company_information->company_name,
            'ProviderName'=> $this->company_information->full_name,
            'CustomerName'=> @$personalData->full_name,
            'PriceOption'=> @$priceOption->price_title,
            'CategoryName'=> @$category->category_title ,
            'amount'=> $this->amount,
            'email'=> $this->company_information->business_email,
        );

        $emailDetailCustomer = array(
            'CompanyImage'=> $this->company_information->getCompanyImage(),
            'CompanyName'=> $this->company_information->company_name,
            'ProviderName'=> $this->company_information->full_name,
            'address'=> $this->company_information->company_address(),
            'ProviderEmail'=> $this->company_information->business_email,
            'phone'=> $this->company_information->business_phone,
            'CustomerName'=> @$personalData->full_name,
            'email'=> @$personalData->email,
            'PriceOption'=> @$priceOption->price_title,
            'CategoryName'=> @$category->category_title ,
            'amount'=> $this->amount,
            'Website' => env('APP_URL'),
            'url'=> env('APP_URL').'personal/manage-account',
        );
       
        if($cardID != '' && $stripeCustomerId != ''){
            try {
                $totalPrice = ($this->amount + $this->tax )*100;
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' =>  round($totalPrice) ,
                    'currency' => 'usd',
                    'customer' => $stripeCustomerId,
                    'payment_method' => $cardID,
                    'off_session' => true,
                    'confirm' => true,
                ]);

                $this->stripe_payment_id = $paymentIntent->id;
                $this->charged_amount = round($totalPrice)/100;
                $this->status = 'Completed';
                $this->payment_on = date('Y-m-d');
                $this->attempt += 1;
            
                $transactiondata = array( 
                    'user_type' => $this->user_type ,
                    'user_id' => $this->user_id,
                    'item_type' =>'Recurring',
                    'item_id' => $this->id,
                    'channel' =>'stripe',
                    'kind' => 'card',
                    'transaction_id' =>$paymentIntent->id,
                    'amount' => round($totalPrice)/100,
                    'qty' =>'1',
                    'status' =>'complete',
                    'refund_amount' =>0,
                    'payload' =>json_encode($paymentIntent,true),
                );
                $transactionstatus = Transaction::create($transactiondata);
                $this->charged();
            }catch(\Stripe\Exception\CardException $e ) {
                $this->error_msg = $e->getError()->message;
                $this->payment_method = NULL;
                $this->attempt += 1;
                $this->status = "Retry";
            }catch(\Stripe\Exception\ApiErrorException  $e ) {
                $this->error_msg = $e->getMessage();
                $this->payment_method = NULL;
                $this->attempt += 1;
                $this->status = "Retry";
            }catch(\Stripe\Exception\AuthenticationException  $e ) {
                $this->error_msg = "Stripe can’t authenticate you with the information provided";
                $this->payment_method = NULL;
                $this->attempt += 1;
                $this->status = "Retry";
            }catch(\Stripe\Exception\InvalidRequestException $e ) {
                $this->error_msg = 'An invalid request occurred in stripe';
                if (isset($e->getError()->param)) {
                    $this->error_msg =  "The parameter {$e->getError()->param} is invalid or missing.";
                }

                $this->payment_method = NULL;
                $this->attempt += 1;
                $this->status = "Retry";
            }catch(\Stripe\Exception\RateLimitException $e ) {
                $this->error_msg = "Our system is currently experiencing a high volume of requests, and as a result, we've received too many API calls in a short period of time. We will try again later. We apologize for any inconvenience";
                $this->payment_method = NULL;
                $this->attempt += 1;
                $this->status = "Retry";
            }catch(\Stripe\Exception\StripeApiException $e ) {
                $this->error_msg = $e->getError()->message;
                $this->payment_method = NULL;
                $this->attempt += 1;
                $this->status = "Retry";
            }catch(\Stripe\Exception\NetworkException $e ) {
                $this->error_msg = $e->getError()->message;
                $this->payment_method = NULL;
                $this->attempt += 1;
                $this->status = "Retry";
            }catch(\Stripe\Exception\InvalidResponseException  $e ) {
                $this->error_msg = "We're sorry, but there was a problem processing your payment due to a network error. Please try again later";
                $this->payment_method = NULL;
                $this->attempt += 1;
                $this->status = "Retry";
            }catch(\Stripe\Exception\StripeServerException   $e ) {
                $this->error_msg = $e->getError()->message;
                $this->payment_method = NULL;
                $this->attempt += 1;
                $this->status = "Retry";
            }catch (Exception $e) {
                $this->error_msg = 'Another problem occurred, maybe unrelated to Stripe';
                $this->status = "Retry";
                $this->attempt += 1;
            }finally {
                $this->save();
                if($this->attempt != 'complete'){
                    SGMailService::sendAutoPayFaildAlertToProvider($emailDetailProvider);
                    SGMailService::sendAutoPayFaildAlertToCustomer($emailDetailCustomer);
                }
            }
        }else{

            $this->status = "Retry";
            $this->error_msg = 'No Card Added.';
            $this->attempt += 1;
            $this->save();
            SGMailService::sendAutoPayFaildAlertToProvider($emailDetailProvider);
            SGMailService::sendAutoPayFaildAlertToCustomer($emailDetailCustomer);
        }
    }

    public function provider_get_total(){
        return $this->charged_amount - $this->platform_total();
    }

    public function platform_total(){
        $fitnessity_fee = $this->company_information->users->fitnessity_fee;
        return round(($this->charged_amount * $fitnessity_fee)/100, 2);
    }

    public function charged(){
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $company_information = $this->company_information;
        $transfer_amount = $this->provider_get_total();

        $transfer_amount = $this->provider_get_total();
        $stripe_account  = $stripe->accounts->retrieveCapability(
            $company_information->stripe_connect_id,
            'transfers',
            []
        );

        $payment_intent = $stripe->paymentIntents->retrieve(
            $this->stripe_payment_id,
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
                $this->update(['transfer_provider_status'=>'paid', 'provider_amount' => $transfer_amount ,'provider_transaction_id' => $transfer->id]);
            }

        }
    }
}