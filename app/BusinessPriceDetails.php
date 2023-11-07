<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessPriceDetails extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
    protected $table = 'business_price_details';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'business_service_id',
        'userid',
        'cid',
        'serviceid',
        'pay_chk',
        'pay_session_type',
        'pay_session',
        'pay_price',
        'pay_discountcat',
        'pay_discounttype',
        'pay_discount',
        'pay_estearn',
        'pay_setnum',
        'pay_setduration',
        'pay_after',
		'fitnessity_fee',
		'membership_type',
        'category_id',
        'price_title',
        'adult_cus_weekly_price',
        'adult_weekend_price_diff',
        'adult_discount',
        'adult_estearn',
        'child_cus_weekly_price',
        'child_weekend_price_diff',
        'child_discount',
        'child_estearn',
        'infant_cus_weekly_price',
        'infant_weekend_price_diff',
        'infant_discount',
        'infant_estearn',
        'weekend_adult_estearn',
        'weekend_infant_estearn',
        'weekend_child_estearn',
        'is_recurring_adult',
        'recurring_price_adult',
        'recurring_run_auto_pay_adult',
        'recurring_cust_be_charge_adult',
        'recurring_every_time_num_adult',
        'recurring_every_time_adult',
        'recurring_nuberofautopays_adult',
        'recurring_happens_aftr_12_pmt_adult',
        'recurring_client_be_charge_on_adult',
        'recurring_first_pmt_adult',
        'recurring_recurring_pmt_adult',
        'recurring_total_contract_revenue_adult',

        'is_recurring_child',
        'recurring_price_child',
        'recurring_run_auto_pay_child',
        'recurring_cust_be_charge_child',
        'recurring_every_time_num_child',
        'recurring_every_time_child',
        'recurring_nuberofautopays_child',
        'recurring_happens_aftr_12_pmt_child',
        'recurring_client_be_charge_on_child',
        'recurring_first_pmt_child',
        'recurring_recurring_pmt_child',
        'recurring_total_contract_revenue_child',

        'is_recurring_infant',
        'recurring_price_infant',
        'recurring_run_auto_pay_infant',
        'recurring_cust_be_charge_infant',
        'recurring_every_time_num_infant',
        'recurring_every_time_infant',
        'recurring_nuberofautopays_infant',
        'recurring_happens_aftr_12_pmt_infant',
        'recurring_client_be_charge_on_infant',
        'recurring_first_pmt_infant',
        'recurring_recurring_pmt_infant',
        'recurring_total_contract_revenue_infant',
        'dispaly_section'
    ];
    

    public function business_price_details_ages(){
        return $this->belongsTo(BusinessPriceDetailsAges::class, 'category_id');
    }

    public function business_price_details_ages_with_trashed(){
        return $this->belongsTo(BusinessPriceDetailsAges::class, 'category_id')->withTrashed();
    }

    public function UserBookingDetail()
    {
        return $this->hasMany(UserBookingDetail::class, 'priceid');
    }

    public function BusinessServices(){
        return $this->belongsTo(BusinessServices::class, 'serviceid'); 
    }

    public function getCurrentPrice($type,$date){
        switch ($type) {
            case 'adult':
                $price = $this->adult_cus_weekly_price;
                break;
            case 'child':
                $price = $this->child_cus_weekly_price;
                break;
            case 'infant':
                $price = $this->infant_cus_weekly_price;
                break;
        }

        if (date('l', strtotime($date)) == 'Saturday' || date('l', strtotime($date)) == 'Sunday') {
            switch ($type) {
                case 'adult':
                    $price = $this->adult_weekend_price_diff;
                    break;
                case 'child':
                    $price = $this->child_weekend_price_diff;
                    break;
                case 'infant':
                    $price = $this->infant_weekend_price_diff;
                    break;
            }
        }

        $price = $price != '' ? $price: 0;
        return $price;
    }

    public function getDiscoutPrice($type, $date){
        $price = $this->getCurrentPrice($type, $date);

        switch ($type) {
            case 'adult':
                $discount = $this->adult_discount ?? 0;
                break;
            case 'child':
                $discount = $this->child_discount ?? 0;
                break;
            case 'infant':
                $discount = $this->infant_discount ?? 0;
                break;
        }
        return ($discount  != '' && $price != 0 ? ($price - ($price * $discount )/100) : $price);  
    }

    public function getExpirationDate($startDate){
        $date = new \DateTime($startDate);
        return $date->modify('+'.$this->pay_setnum.' '.$this->pay_setduration);
    }
}