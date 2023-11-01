<?php

namespace App\Services;
use App\{BusinessPriceDetails,BusinessServices,Customer,CompanyInformation};
class CheckoutRegisterCartService
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
        $this->_cart = session()->get('cart_item_for_checkout', []);
    }

    // with tax + 
    public function total($user)
    {
        // var_dump($this->items());
        $taxTotal = 0;
        foreach($this->items() as $item){
            $addOnServiceTotal = $item['addOnServicesTotalPrice'] ?? 0;
            $productTotal = $item['productTotalPrices'] ?? 0;
            $pretaxTotal = $item['totalprice'] + $item['tip']  - $item['discount'] + $addOnServiceTotal + $productTotal;
            $taxTotal += $item["tax"];
        }
        $service_fee = ($pretaxTotal * $user->recurring_fee) / 100;
        return $pretaxTotal + $service_fee + $taxTotal;
    }

    public function items(){
        $cart['cart_item'] = [];
        /*foreach($this->_cart['cart_item'] as $key=>$c)
        {   
            if($c['chk'] == 'activity_purchase') {
                $cart['cart_item'][] = $c;
            }
        }*/
        $cart['cart_item'] = $this->_cart['cart_item'];
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

    public function getRecurringFeeByItem($item, $user){
        return $this->getGrossSubtotalByItem($item) * $user->recurring_fee/100;
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
        return $grossTotal + $item['tip']  - $item['discount'];
    }

    public function getSubTotalByItem($item, $user){
        
        $pretaxSubTotal = $this->getGrossSubtotalByItem($item);

        return $pretaxSubTotal + $item["tax"] + (@$item['addOnServicesTotalPrice'] ?? 0) + (@$item['productTotalPrices'] ?? 0);
    }

    public function getPriceDetail($priceid){
        return BusinessPriceDetails::find($priceid);
    }

    public function getbusinessService($service){
        return BusinessServices::find($service);
    }

    public function getCategory($priceid){
        $BusinessPriceDetails =  BusinessPriceDetails::find($priceid);
        return @$BusinessPriceDetails->business_price_details_ages;
    }

    public function getbookedPerson($id){
        $customer = Customer::where('id',$id)->first();
        return $customer->full_name;
    }

    public function getCompany($id){
        $company = CompanyInformation::where('id',$id)->first();
        return $company;
    }

}
