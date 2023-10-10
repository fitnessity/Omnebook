<?php


namespace App\Services;
use App\{BusinessPriceDetails,BusinessSubscriptionPlan,CompanyInformation,UserFamilyDetail,User,Customer};

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

    public function planData(){
        return BusinessSubscriptionPlan::where('id',1)->first();
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
        $bspdata = $this->planData();
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
            $dis = 100;
            if(array_key_exists("price",$item[$role])){
                $result['price'][$role] = $item[$role]['price']; 

                if($role == 'adult'){
                    $dis = $priceDetail->adult_discount;
                }
                if($role == 'child'){
                    $dis = $priceDetail->child_discount;
                }
                if($role == 'infant'){
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
        return $subTotal;
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
        $discount = ($price * $dis)/100;
        return $discount;
    }

    public function getTax($price){
        $bspdata = $this->planData();
        $tax = @$bspdata->site_tax !='' ? @$bspdata->site_tax : 0;
        return  ($price * $tax)/100;
    }

    public function getServiceFee($price){
        $bspdata = $this->planData();
        $service_fee = @$bspdata->service_fee !='' ? @$bspdata->service_fee : 0;
        return  ($price * $service_fee)/100;
    }

    public function getFitnessFee($price, $user){
        return $price * $user->fitnessity_fee/100;
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
