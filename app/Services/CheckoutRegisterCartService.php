<?php

namespace App\Services;

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
        $this->_cart = session()->get('cart_item', []);

    }

    // with tax + 
    public function total($user)
    {
        // var_dump($this->items());
        $taxTotal = 0;
        foreach($this->items() as $item){
            
            $pretaxTotal = $item['totalprice'] + $item['tip']  - $item['discount'];
            $taxTotal += $item["tax"];
        }


        $service_fee = ($pretaxTotal * $user->recurring_fee) / 100;

        return $pretaxTotal + $service_fee + $taxTotal;
    }

    public function items(){
        return $this->_cart['cart_item'];
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
        $service_fee = $this->getRecurringFeeByItem($item, $user);


        return $pretaxSubTotal + $service_fee + $item["tax"];
    }
}
