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
    protected $guarded = [];

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

    public function CompanyInformation(){
        return $this->belongsTo(CompanyInformation::class, 'cid'); 
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

    public function getMembership($sDate,$eDate,$business_id){
        return $this->UserBookingDetail()->whereDate('user_booking_details.created_at','>=',$sDate)->whereDate('user_booking_details.created_at','<=',$eDate)->get();
    }

    public function getMembershipQty($sDate,$eDate,$business_id){
        $qty ='';
        $sumQuantities = [ 'adult' => 0, 'child' => 0, 'infant' => 0 ];
        foreach ($this->getMembership($sDate,$eDate,$business_id) as $m) {
            $item = json_decode($m->qty,true);
            foreach ($item as $type => $quantity) {
                $sumQuantities[$type] += (int)$quantity;
            }
        }

        foreach ($sumQuantities as $type => $sum) {
            if($sum > 0){
                if(!empty($qty)) {
                    $qty .= ', ';
                }
                $qty .= ucfirst($type) . ': ' . $sum;
            }
        }

        return $qty ?? 0;
    }

    public function getMembershipPrice($sDate,$eDate,$business_id){
        $prices = [];
        foreach ($this->getMembership($sDate, $eDate,$business_id) as $m) {
            $item = json_decode($m->price, true);
            foreach ($item as $key => $value) {
                if ($value > 0 && !in_array(ucfirst($key) . ': $' . $value, $prices)) {
                    $prices[] = ucfirst($key) . ': $' . $value;
                }
            }
        }
        return implode(', ', $prices) ?: '$0';
    }

    public function getMembershipRevenue($sDate,$eDate,$business_id){
        $revenue = 0;
        foreach ($this->getMembership($sDate,$eDate,$business_id) as $m) {
            $item = json_decode($m->price,true);
            foreach(['adult', 'child', 'infant'] as $key){
                if(@$item[$key] > 0){
                    $revenue += ($item[$key] ?? 0) ;
                }
            }
        }
        return $revenue;
    }

    public function getMembershipFor($sDate,$eDate,$business_id){
       $types = [];
        foreach ($this->getMembership($sDate,$eDate,$business_id) as $m) {
            $item = json_decode($m->qty,true);
            foreach(['adult', 'child', 'infant'] as $key){
                if(@$item[$key] > 0 && !in_array(ucfirst($key), $types)){
                    $types[] = ucfirst($key);
                }
            }
        }
       
        return implode(', ', $types);
    }

    public function getRevenueByType($type,$sDate,$eDate,$business_id){
        $revenue = 0;
        foreach ($this->getMembership($sDate,$eDate,$business_id) as $m) {
            $item = json_decode($m->price,true);
            foreach(['adult', 'child', 'infant'] as $key){
                if(@$item[$key] > 0 && $key == $type){
                    $revenue += ($item[$key] ?? 0) ;
                }
            }
        }
        return $revenue;
    } 


    public function getRecurringMembership($sDate,$eDate,$business_id){
        return UserBookingDetail::join('recurring as re' ,'re.booking_detail_id' ,'=','user_booking_details.id')->where(['user_booking_details.business_id'=>$business_id ,'user_booking_details.priceid'=>$this->id])->where('re.payment_number',NULL)->where('re.status','Completed')->whereDate('re.payment_on','>=',$sDate)->whereDate('re.payment_on','<=',$eDate)->orderBy('user_booking_details.membership_for')->get();
    }

    public function getRecurringMembershipQty($sDate,$eDate,$business_id){
        $qty ='';
        $sumQuantities = [ 'adult' => 0, 'child' => 0, 'infant' => 0 ];
        foreach ($this->getRecurringMembership($sDate,$eDate,$business_id) as $m) {
            $item = json_decode($m->qty,true);
            foreach ($item as $type => $quantity) {
                $sumQuantities[$type] += (int)$quantity;
            }
        }

        foreach ($sumQuantities as $type => $sum) {
            if($sum > 0){
                if(!empty($qty)) {
                    $qty .= ', ';
                }
                $qty .= ucfirst($type) . ': ' . $sum;
            }
        }

        return $qty ?? 0;
    }

    public function getRecurringMembershipPrice($sDate,$eDate,$business_id){
        $prices = [];
        foreach ($this->getRecurringMembership($sDate, $eDate,$business_id) as $m) {
            $item = json_decode($m->price, true);
            foreach ($item as $key => $value) {
                if ($value > 0 && !in_array(ucfirst($key) . ': $' . $value, $prices)) {
                    $prices[] = ucfirst($key) . ': $' . $value;
                }
            }
        }
        return implode(', ', $prices) ?: '$0';
    }

    public function getRecurringMembershipRevenue($sDate,$eDate,$business_id){
        $revenue = 0;
        foreach ($this->getRecurringMembership($sDate,$eDate,$business_id) as $m) {
            $item = json_decode($m->price,true);
            foreach(['adult', 'child', 'infant'] as $key){
                if(@$item[$key] > 0){
                    $revenue += ($item[$key] ?? 0) ;
                }
            }
        }
        return $revenue;
    }

    public function getRecurringMembershipFor($sDate,$eDate,$business_id){
       $types = [];
        foreach ($this->getRecurringMembership($sDate,$eDate,$business_id) as $m) {
            $item = json_decode($m->qty,true);
            foreach(['adult', 'child', 'infant'] as $key){
                if(@$item[$key] > 0 && !in_array(ucfirst($key), $types)){
                    $types[] = ucfirst($key);
                }
            }
        }
       
        return implode(', ', $types);
    }

    public function getRecurringRevenueByType($type,$sDate,$eDate,$business_id){
        $revenue = 0;
        foreach ($this->getRecurringMembership($sDate,$eDate,$business_id) as $m) {
            $item = json_decode($m->price,true);
            foreach(['adult', 'child', 'infant'] as $key){
                if(@$item[$key] > 0 && $key == $type){
                    $revenue += ($item[$key] ?? 0) ;
                }
            }
        }
        return $revenue;
    }

}