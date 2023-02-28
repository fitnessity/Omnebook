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
		/*'recurring_every',
		'recurring_duration',*/
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
        'recurring_total_contract_revenue_infant'
    ];
    

    public function business_price_details_ages(){
        return $this->belongsTo(BusinessPriceDetailsAges::class, 'category_id');
    }

}