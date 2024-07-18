<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Products extends Model
{
  
	
	protected $table='products';
	//protected $fillable = ['user_id','business_id','name','description','gallery','policy_returning'];  
	protected $guarded = [];  

	public function company() {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function getPic(){
    	$profile_pic = '';
        if(Storage::disk('s3')->exists($this->product_image)){
            $profile_pic = Storage::url($this->product_image);
        }
        return $profile_pic;
    }


    public function soldProducts($sDate = null , $eDate = null){
        $totalQty = 0;
        $details = UserBookingDetail::whereRaw("FIND_IN_SET(?, productIds)", [$this->id]);
        if($sDate && $eDate){
            $details->whereDate('created_at', '>=', $sDate)->whereDate('created_at', '<=', $eDate);
        }
        $details = $details->get();
        foreach ($details as  $value) {
            $products = explode(',', $value->productIds);
            $qtyList = explode(',', $value->productQtys);

            $key = array_search((string) $this->id, $products);
            if ($key !== false) {
                $totalQty += $qtyList[$key];
            }
        } 

        return $totalQty;
    }

    public function getSoldProducts($sDate = null , $eDate = null){
        if($sDate != '' && $eDate != ''){
            $soldQty = $this->soldProducts($sDate, $eDate);
        }else{
            $soldQty = $this->soldProducts();
        }

        $reminingQty = $this->quantity - $soldQty;
        $reminingQty =  $reminingQty > 0 ? $reminingQty : 0;
        return $reminingQty;  
    }

    public function getMembership($sDate,$eDate){
        return UserBookingDetail::whereRaw("FIND_IN_SET(?, productIds)", [$this->id])->whereDate('user_booking_details.created_at','>=',$sDate)->whereDate('user_booking_details.created_at','<=',$eDate);
    }

    public function getProductPrice($sDate,$eDate){
        $prices = [];
        foreach ($this->getMembership($sDate,$eDate)->get() as $m) {
            $ids = $m->productIds;
            $qtys = explode(',', $m->productQtys);
            $types = explode(',', $m->productTypes);
            $position = array_search($this->id, explode(',', $ids));
            if($types[$position] == 'rent'){
                if (!in_array( ucfirst($types[$position]). ': $' .$this->rental_price,$prices)) {
                    $prices[] = ucfirst($types[$position]) . ': $' .$this->rental_price;
                }
            }else {
                if (!in_array( ucfirst($types[$position]). ': $' .$this->sale_price,$prices)) {
                    $prices[] = ucfirst($types[$position]) . ': $' .$this->sale_price;
                }
            }
        }

        return implode(', ', $prices) ?: '$0';
    }

    public function getProductQty($sDate,$eDate){
        $qty ='';
        $sumQuantities = [ 'sale' => 0, 'rent' => 0];
        foreach ($this->getMembership($sDate,$eDate)->get() as $m) {
            $ids = $m->productIds;
            $qtys = explode(',', $m->productQtys);
            $types = explode(',', $m->productTypes);
            $position = array_search($this->id, explode(',', $ids));
            if($types[$position] == 'rent'){
                $sumQuantities['rent'] += (int)$qtys[$position];
            }else{
                $sumQuantities['sale'] += (int)$qtys[$position];
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
    
    public function getProductRevenue($sDate,$eDate){
        $price = 0;
        foreach ($this->getMembership($sDate,$eDate)->get() as $m) {
            $ids = $m->productIds;
            $qtys = explode(',', $m->productQtys);
            $types = explode(',', $m->productTypes);
            $position = array_search($this->id, explode(',', $ids));
            if($types[$position] == 'rent'){
                $price += $qtys[$position] * $this->rental_price;
            }else {
                $price += $qtys[$position] * $this->sale_price;
            }
        }

        return $price;
    }
}
