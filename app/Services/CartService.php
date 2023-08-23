<?php


namespace App\Services;
use App\{BusinessPriceDetails,BusinessSubscriptionPlan,CompanyInformation,UserFamilyDetail,User};

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
            if($c['chk'] == '') {
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

        return $pretaxSubTotal + ($pretaxSubTotal * $tax)/100;
    }

    public function getFitnessityFeeByItem($item, $user){
        return $this->getGrossSubtotalByItem($item) * $user->fitnessity_fee/100;
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
        $dis = 0.00;
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
            $discount += is_int(is_int($result['qty'][$role]) * is_int(($result['price'][$role] * $dis))/100); 
        }
        return $discount;
    }

    public function getCompany($id){
        $company = CompanyInformation::where('id',$id)->first();
        return $company;
    }

    public function getParticipateByComa($participateData){
        $participate =  json_decode($participateData,true);
        $names = '';
        if(!empty($participate)){
            foreach($participate as $p){
                if($p['from'] == 'family'){
                    $data = UserFamilyDetail::where('id',$p['id'])->first();
                    if($data != '' ){
                        $names .= $data->full_name.' ,';
                    }
                }else{
                    $data = User::where('id',$p['id'])->first();
                    if($data != '' ){
                        $names .= $data->full_name.' ,';
                    }
                } 
            }
            $names = rtrim($names ,' ,');
        }
        return $names;
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
