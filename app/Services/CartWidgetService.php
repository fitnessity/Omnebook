<?php

namespace App\Services;

use App\{BusinessPriceDetails, BusinessSubscriptionPlan, CompanyInformation, UserFamilyDetail, User, Customer};

class CartWidgetService
{
    /**
     * Array to hold cart items
     */
    private $_cart;

    /**
     * Constructor to initialize cart array
     */
    public function __construct()
    {
        // Initialize the cart as an empty array
        $this->_cart = [
            'cart_item' => []
        ];
    }

    /**
     * Updates cart items by filtering only those with 'chk' equal to 'activity_purchase'
     */
    public function updateCartItem($cart_item)
    {
        // Add new cart_item into the internal _cart array
        $this->_cart['cart_item'][] = $cart_item;
    }
    
    public function updatedCartitems()
    {
        // $cart['cart_item'] = [];
        // foreach ($this->_cart['cart_item'] as $key => $c) {
        //     if ($c['chk'] == 'activity_purchase') {
        //         $cart['cart_item'][] = $c;
        //     }
        // }

        // return $cart['cart_item'];
        return  $this->_cart['cart_item'];
    }

    /**
     * Gets items with 'chk' equal to '' or 'checkin'
     */
    public function items()
    {
        // $cart['cart_item'] = [];
        // foreach ($this->_cart['cart_item'] as $key => $c) {
        //     if ($c['chk'] == '' || $c['chk'] == 'checkin') {
        //         $cart['cart_item'][] = $c;
        //     }
        // }
        // return $cart['cart_item'];
        return  $this->_cart['cart_item'];
    }

    /**
     * Retrieves subscription plan data
     */
    public function planData()
    {
        return BusinessSubscriptionPlan::where('id', 1)->first();
    }

    /**
     * Get the quantity and price by item role (adult, child, infant)
     */
    public function getQtyPriceByItem($item)
    {
        $result = [];
        foreach (['adult', 'child', 'infant'] as $role) {
            $result['qty'][$role] = array_key_exists("quantity", $item[$role]) ? $item[$role]['quantity'] : 0;
            $result['price'][$role] = array_key_exists("price", $item[$role]) ? $item[$role]['price'] : 0;
        }
        return $result;
    }

    /**
     * Retrieves price details by price ID
     */
    public function getPriceDetail($priceid)
    {
        return BusinessPriceDetails::find($priceid);
    }

    /**
     * Calculate subtotal with tax for an item
     */
    public function getSubTotalByItem($item, $user)
    {
        $bspdata = $this->planData();
        $tax = $bspdata->site_tax;
        $pretaxSubTotal = $this->getGrossSubtotalByItem($item);

        return $pretaxSubTotal + ($pretaxSubTotal * $tax) / 100;
    }

    /**
     * Calculate fitness fee for an item
     */
    public function getFitnessityFeeByItem($item, $user)
    {
        return $this->getGrossSubtotalByItem($item) * $user->fitnessity_fee / 100;
    }

    /**
     * Calculate gross subtotal for an item
     */
    public function getGrossSubtotalByItem($item)
    {
        $grossTotal = 0.00;
        $result = [];
        foreach (['adult', 'child', 'infant'] as $role) {
            $result['qty'][$role] = array_key_exists("quantity", $item[$role]) ? $item[$role]['quantity'] : 0;
            $result['price'][$role] = array_key_exists("price", $item[$role]) ? $item[$role]['price'] : 0;
            $grossTotal += $result['price'][$role] * $result['qty'][$role];
        }
        return $grossTotal;
    }

    /**
     * Calculate total discount for an item
     */
    public function getDiscountTotal($item)
    {
        $discount = 0.00;
        $dis = 0.00;
        $result = [];
        foreach (['adult', 'child', 'infant'] as $role) {
            $result['qty'][$role] = array_key_exists("quantity", $item[$role]) ? $item[$role]['quantity'] : 0;
            $priceDetail = $this->getPriceDetail($item['priceid']);
            $dis = 100;

            if (array_key_exists("price", $item[$role])) {
                $result['price'][$role] = $item[$role]['price'];
                $dis = $this->getRoleDiscount($role, $priceDetail);
            } else {
                $result['price'][$role] = 0;
            }

            $discount += $result['qty'][$role] * ($result['price'][$role] * $dis) / 100;
        }
        return $discount;
    }

    /**
     * Helper function to get the discount for each role
     */
    private function getRoleDiscount($role, $priceDetail)
    {
        switch ($role) {
            case 'adult':
                return $priceDetail->adult_discount;
            case 'child':
                return $priceDetail->child_discount;
            case 'infant':
                return $priceDetail->infant_discount;
            default:
                return 0;
        }
    }

    // Other methods like getCompany, participateLoop, getSubTotal, etc., remain unchanged but now reference the _cart array instead of session storage.
    public function getCompany($id){
        $company = CompanyInformation::where('id',$id)->first();
        return $company;
    }

    public function getParticipateByComa($participateData){
        $participate = json_decode($participateData,true);
        $names = '';
        if(!empty($participate)){
            if(@$participate['from'] == 'customer'){
                $data = Customer::where('id',@$participate['id'])->first();
                if($data != '' ){
                    $names .= $data->full_name.' ,';
                }
            }else{
                $data = User::where('id',@$participate['id'])->first();
                if($data != '' ){
                    $names .= $data->full_name.' ,';
                }
            }
            $names = rtrim($names ,' ,');
        }
        /*if(!empty($participate)){
            foreach($participate as $p){
                print_r( $p).'!!!<br>';
                // if($p['from'] == 'family'){
                //     $data = UserFamilyDetail::where('id',$p['id'])->first();
                //     if($data != '' ){
                //         $names .= $data->full_name.' ,';
                //     }
                // }

                if($p['from'] == 'customer'){
                    $data = Customer::where('id',$p['id'])->first();
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
        }*/
        return $names;
    }

    public function participateLoop($item ,$businessID){
        $newArray = [];
        foreach($item['participate'] as $key => $p){
            if (isset($item['infant']) && isset($item['infant']['quantity']) && $key < $item['infant']['quantity']) {
                $category = 'infant';
            } elseif (isset($item['child']) && isset($item['child']['quantity']) && $key < (@$item['infant']['quantity'] + $item['child']['quantity'])) {
                $category = 'child';
            } else {
                $category = 'adult';
            }

            if($p['from'] == 'user'){
                $findCustomer = Customer::where(['business_id' => $businessID,'user_id' => $p['id']])->first();
                $userID = $findCustomer->id;
            }else if($p['from'] == 'family'){
                $family = UserFamilyDetail::where('id', $p['id'])->first();
                $customer = Customer::where(['business_id' => $businessID, 'fname' => $family->first_name, 'lname' => $family->last_name ,'email' =>$family->email])->first();
                if($customer == ''){
                    $parentId= $family->user != '' ? $family->user->id : NULL;
                    $customer = Customer::create([
                        'business_id' => $businessID,
                        'fname' => $family->first_name,
                        'lname' => $family->last_name,
                        'email' => $family->email,
                        'phone_number' => $family->mobile,
                        'emergency_contact' => $family->emergency_contact,
                        'relationship' => $family->relationship,
                        'profile_pic' => $family->profile_pic,
                        'user_id' => NULL,
                        'parent_cus_id' => $parentId,
                        'gender' => $family->gender,
                        'birthdate' => $family->birthday,
                    ]);
                }
                $userID = @$customer->id;
            }else{
                $userID = $p['id'];
            }

            $participant['id'] = $userID;
            $participant['from'] = $p['from'];
            $participant['type'] = $category;
            $participant['quantity'] = $item[$category]['quantity'];
            $participant['price'] = $item[$category]['price'];

            $newArray[] = $participant;
        }
        return $newArray; 
    }

    public function getSubTotal($priceId,$role,$price,$addOnServicePrice)
    {
        $subTotal = 0;
        $discount = $this->getDiscount($priceId,$role,$price);
        $priceWithDiscount = $price - $discount + $addOnServicePrice;
        $tax = $this->getTax($priceWithDiscount);
        $serviceFee = $this->getServiceFee($priceWithDiscount);
        $subTotal = $price + $tax + $serviceFee - $discount + $addOnServicePrice;
        $subTotal = $subTotal < 0 ?  0 : $subTotal;
        return number_format( $subTotal, 2);
    }

    public function getMembershipTotal($priceId,$role,$price){
        $discount = $this->getDiscount($priceId,$role,$price);
        return  number_format(  $price - $discount, 2);
    }

    public function getMembershipTax($priceId,$role,$price){
        $discount = $this->getDiscount($priceId,$role,$price);
        return number_format( $this->getTax($price - $discount) , 2);
    }

    public function getDiscount($priceId,$role,$price){
        $discount = 0;
        $priceDetail = $this->getPriceDetail($priceId);
        if($role == 'adult'){
            $dis = $priceDetail->adult_discount;
        }if($role == 'child'){
            $dis = $priceDetail->child_discount;
        }if($role == 'infant'){
            $dis = $priceDetail->infant_discount;
        }
        $discount = number_format(($price * $dis)/100 ,2);
        return $discount;
    }

    public function getTax($price){
        $bspdata = $this->planData();
        $tax = @$bspdata->site_tax !='' ? @$bspdata->site_tax : 0;
        return  number_format( ($price * $tax)/100,2);
    }

    public function getServiceFee($price){
        $bspdata = $this->planData();
        $service_fee = @$bspdata->service_fee !='' ? @$bspdata->service_fee : 0;
        return  number_format(  ($price * $service_fee)/100 ,2);
    }

    public function getFitnessFee($price, $user){
        return $price * $user->fitnessity_fee/100;
    }

   

}
