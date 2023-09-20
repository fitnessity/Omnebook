<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use App\{Transaction,User,Customer};

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
    protected $fillable = [ 'booking_detail_id', 'user_id', 'user_type', 'business_id', 'payment_date', 'amount', 'tax', 'charged_amount', 'payment_method', 'stripe_payment_id', 'status','transfer_provider_status','provider_amount','provider_transaction_id','attempt'];


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

                $card_id =  $brand.'  XXXX'.$last4;
            }catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException $e) {
            }catch(Exception $e){
            }
        }else{
             $card_id = $payment_method;
        }

        return $card_id;
    }

    public function createRecurringPayment(){
        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

        if ($this->user_type == 'user') {
            $customer = User::find($this->user_id);
        } else {
            $customer = Customer::find($this->user_id); 
        }

        $stripeCustomerId = @$customer->stripe_customer_id;
        $cardDetails = @$customer != '' ? $customer->stripePaymentMethods()->latest()->first() : '';
        $stripeCardID = $cardDetails ? $cardDetails->payment_id : null;
       
        $cardID =  $this->payment_method;
        $cardID = $cardID != ''  ?  $cardID : $stripeCardID;
        
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
            }catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException $e ) {
                $this->payment_method = NULL;
                $this->attempt += 1;
                $this->status = "Retry";
            }catch (Exception $e) {
                $this->status = "Retry";
                $this->attempt += 1;
            }finally {
                $this->save();
            }
        }else{
            $this->status = "Retry";
            $this->save();
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
        try {
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
        } catch(\Stripe\Exception\CardException  | \Stripe\Exception\InvalidRequestException | \Exception $e) {
        } 
    }

}