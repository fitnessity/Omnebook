<?php


namespace App\Services;
use App\{BusinessPriceDetails,BusinessSubscriptionPlan};

class CartService
{
    
    /**
     *
     */
    private $_cart;

    /**
     *
     * @throws ConfigurationException
    */

    public function __construct()
    {
        $this->_cart = session()->get('cart_item', []);

    }

    // with tax + 
        
    public function updatedCartitems(){
        $cart['cart_item'] = [];
        foreach($this->_cart['cart_item'] as $key=>$c)
        {   
            if($c['chk'] == 'activity_purchase') {
                $cart['cart_item'][] = $c;
            }
        }

        return $cart['cart_item'];
    }


    public function items(){
        $cart['cart_item'] = [];
        foreach($this->_cart['cart_item'] as $key=>$c)
        {   
            if($c['chk'] != 'activity_purchase') {
                $cart['cart_item'][] = $c;
            }
        }

        return $cart['cart_item'];
    }

    public function getQtyPriceByItem($item){
        $result = [];
        foreach(['adult', 'child', 'infant'] as $role){
            if(array_key_exists("quantity",$item[$role])){
                $result['qty'][$role] = $item[$role]['quantity'];    
            }else{
                $result['qty'][$role] = 0;
            }

            if(array_key_exists("price",$item[$role])){
                $result['price'][$role] = $item[$role]['price'];    
            }else{
                $result['price'][$role] = 0;
            }
        }
        return $result;
    }

    public function getPriceDetail($priceid){
        return BusinessPriceDetails::find($priceid);
    }


    public function getSubTotalByItem($item, $user){
        $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
        $tax = $bspdata->site_tax;
        $pretaxSubTotal = $this->getGrossSubtotalByItem($item);
        $service_fee = $this->getRecurringFeeByItem($item, $user);
        return $pretaxSubTotal + $service_fee + ($pretaxSubTotal * $tax)/100;
    }

    public function getRecurringFeeByItem($item, $user){
        $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
        $service_fee = $bspdata->service_fee;
        return $this->getGrossSubtotalByItem($item) * $service_fee/100;
    }

    public function getGrossSubtotalByItem($item){
        $grossTotal = 0.00;
        $result = [];
        foreach(['adult', 'child', 'infant'] as $role){
            if(array_key_exists("quantity",$item[$role])){
                $result['qty'][$role] = $item[$role]['quantity'];    
            }else{
                $result['qty'][$role] = 0;
            }

            if(array_key_exists("price",$item[$role])){
                $result['price'][$role] = $item[$role]['price'];    
            }else{
                $result['price'][$role] = 0;
            }
            $grossTotal += $result['price'][$role] * $result['qty'][$role];
        }
        return $grossTotal;
    }

    public function getDiscountTotal($item)
    {
        $discount = 0.00;
        $result = [];
        foreach(['adult', 'child', 'infant'] as $role){
            if(array_key_exists("quantity",$item[$role])){
                $result['qty'][$role] = $item[$role]['quantity'];    
            }else{
                $result['qty'][$role] = 0;
            }
            $priceDetail = $this->getPriceDetail($item['priceid']);
            if(array_key_exists("price",$item[$role])){
                $result['price'][$role] = $item[$role]['price']; 
                if($role == 'adult'){
                    $dis = $priceDetail->adult_discount;
                }if($role == 'child'){
                    $dis = $priceDetail->child_discount;
                }if($role == 'infant'){
                    $dis = $priceDetail->infant_discount;
                }
            }else{
                $result['price'][$role] = 0;
            }
            $discount += $result['qty'][$role] * ($result['price'][$role] * $dis)/100; 
        }
        return $discount;
    }

        




    /*[
        {'activity_id': 1, 'price_detail_id': 1, }
    ]

    {'participating_details': {
        'adult': { 'quantity': 1, 'unit_price': 1, 'discount_precentage': 0.23, 'sub_total': 123 }
        'infant': { 'quantity': 1, 'unit_price': 1, 'discount_precentage': 0.23, 'sub_total': 123 }
        'child': { 'quantity': 1, 'unit_price': 1, 'discount_precentage': 0.23, 'sub_total': 123 }
    }}*/
}
