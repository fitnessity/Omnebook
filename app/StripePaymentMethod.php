<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\SGMailService;

class StripePaymentMethod extends Model
{
    
    public $timestamps = true;
    //
    protected $fillable = [
        'user_type',
        'user_id',
        'pay_type',
        'payment_id',
        'exp_month',
        'exp_year',
        'last4',
        'primary',
        'brand',
    ];

    public static function boot(){
        parent::boot();

        static::deleting(function($model) {
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            try {
                $stripe->paymentMethods->detach($model->payment_id,[]);
            }catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException | \Exception $e){
            }
        });
    }

    public function Customer(){
        return $this->belongsTo(Customer::class,'user_id');
    }

    public function checkCardValidity($id, $method)
    {
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        try {
            $pmtMethods =  $stripe->customers->allPaymentMethods($id, []);
            $isValid = collect($pmtMethods->data)->contains('id', $method);
            if (!$isValid) { return ''; }
            return $method;
        } catch (CardException | \Exception $e) {
            return '';
        }
    }

    public function checkExpiredCard(){
        $originalDate = $this->exp_month.' '.$this->exp_year;
        $carbonDate = Carbon::createFromFormat('m Y', $originalDate);
        $newDate = $carbonDate->addMonth()->format('m Y');
        if($this->user_type == 'Customer'){
            if($newDate == date('m Y')){
                if($this->Customer){
                    $company = $this->Customer->company_information;
                    $emailDetailCustomer = array(
                        'card'=> $this->last4,
                        'date'=>  $carbonDate->format('F Y'),
                        'brand'=>  $this->brand,
                        'companydata'=>  $company,
                        'userdata'=> $this->Customer,
                        'email'=> $this->Customer->email,
                    );

                    $emailDetailProvider = array(
                        'card'=> $this->last4,
                        'date'=>  $carbonDate->format('F Y'),
                        'brand'=>  $this->brand,
                        'companydata'=>  $company,
                        'userdata'=> $this->Customer,
                        'email'=> $company->business_email,
                    );
                    SGMailService::creditCardExpiredToCustomer($emailDetailCustomer);
                    SGMailService::creditCardExpiredToProvider($emailDetailProvider);
                }
            }
        }else{
            if($this->User){
                $emailDetailUser = array(
                    'card'=> $this->last4,
                    'brand'=>  $this->brand,
                    'full_name'=> $this->User->full_name,
                    'email'=> $this->User->email,
                    'temp_id'=> 'd-be2806a628fd4d03ae17e70afba7f3e0',
                );
                SGMailService::creditCardExpiredORExpringToUser($emailDetailUser);
            }
        }
    }


    public function checkExpiringCard(){

        $originalDate = $this->exp_month.' '.$this->exp_year;
        $carbonDate = Carbon::createFromFormat('m Y', $originalDate);
        $expiredDate = Carbon::createFromFormat('m Y', $originalDate)->addMonth()->format('m/d/Y');
        $endOfMonth = $carbonDate->endOfMonth();
        $seventhToLastDay = $endOfMonth->subDays(7)->format('Y-m-d');
        if($this->user_type == 'Customer'){
            if($seventhToLastDay == date('Y-m-d') && $this->Customer){

                $company = $this->Customer->company_information;
                $emailDetailCustomer = array(
                    'card'=> $this->last4,
                    'date'=>  $expiredDate,
                    'brand'=>  $this->brand,
                    'companydata'=>  $company,
                    'userdata'=> $this->Customer,
                    'email'=> $this->Customer->email,
                );

                $emailDetailProvider = array(
                    'card'=> $this->last4,
                    'date'=>  $expiredDate,
                    'brand'=>  $this->brand,
                    'companydata'=>  $company,
                    'userdata'=> $this->Customer,
                    'email'=> $company->business_email,
                );
                SGMailService::creditCardExpiringToCustomer($emailDetailCustomer);
                SGMailService::creditCardExpiringToProvider($emailDetailProvider);
            }
        }else{
            if($this->User){
                $emailDetailUser = array(
                    'card'=> $this->last4,
                    'brand'=>  $this->brand,
                    'full_name'=> $this->User->full_name,
                    'email'=> $this->User->email,
                    'temp_id'=> 'd-1538409bc9cf4f26896f988765421173',
                );
                SGMailService::creditCardExpiredORExpringToUser($emailDetailUser);
            }
        }
    }
}
