<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public $timestamps = false;
    protected $table = 'transaction';
    
    public $timestamps = true;
	
	protected $fillable = [
        'user_type', 'user_id', 'item_type','item_id', 'channel','kind','transaction_id','amount','qty','status','refund_amount','payload','stripe_payment_method_id'
    ];

    /**
     * Get the user that owns the task.
     */

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function Customer(){
        return $this->belongsTo(Customer::class,'user_id');
    }

    public function UserBookingStatus(){
        return $this->belongsTo(UserBookingStatus::class,'item_id');
    }

    public function Recurring(){
        return $this->belongsTo(Recurring::class,'item_id');
    }

    public function getPmtMethod(){
        $pmt_by = $this->kind;
        if($pmt_by == 'card'){
            $data = json_decode($this->payload);
            $cardData = $data->charges->data[0]->payment_method_details->card;
            $last4 =  $cardData->last4;
            $brand = $cardData->brand;
            return $brand.' ****'.$last4;
        }else{
            return $pmt_by;
        }
    }

    public function item_type_terms(){
        if($this->item_type == 'UserBookingStatus'){
            return 'Membership';
        }if($this->item_type == 'Recurring'){
            return 'Auto Pay';
        }else{
            return 'Product';
        }
    }

    public function item_description($chkBusiness = null){
        $itemDescription = $itemPrice = $itemSubTotal = $itemDis = $itemTax = $location = $notes = $addOnTotal = '';
        $totalTax = $totalDis = $totalPaid =  $qty = 0;
        $arry = [];
        if($this->item_type == 'UserBookingStatus'){
            if($this->userBookingStatus != ''){
                $bookingData = $this->userBookingStatus->UserBookingDetail;
                if(!empty($bookingData)){
                    foreach($bookingData as $key => $bd){
                        if($bd->business_id == $chkBusiness){
                            $activityName = $bd->business_services_with_trashed->program_name;
                            $categoryName = $bd->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title;
                            $priceOption = $bd->business_price_detail_with_trashed->price_title;
                            $itemDescription .= ($key+1).'. '.$activityName.' ('.$categoryName.') ,'.$priceOption.'<br>';
                            $itemPrice .= $bd->total() != '' ? '$'.$bd->total().'<br>' : '$0<br>';
                            $itemSubTotal .= '$'. $bd->subtotal ?? 0 .'<br>';
                            $itemDis .= $bd->discount != '0.00' ? '$'.$bd->discount.'<br>' : '$0<br>';
                            $itemTax .= $bd->tax != '0.00' ? '$'.$bd->tax.'<br>' : '$0<br>';
                            $addOnTotal .= $bd->addOnservice_total != '' ? '$'.$bd->addOnservice_total.'<br>' : '$0<br>';
                            $location .= @$bd->company_information != '' ? @$bd->company_information->public_company_name.'<br>' : '<br>';
                            $totalTax += $bd->tax != '0.00' ? $bd->tax : 0;
                            $totalDis += $bd->discount != '0.00' ? $bd->discount : 0;
                            $totalPaid += $bd->subtotal != '0.00' ?  $bd->subtotal : 0;
                            $notes .= $bd->note != '' ? $bd->note.'<br>' : 'N/A<br>';
                            $qty++;
                        }
                    }
                }
            }
            //echo $booking_data;exit();
        }else if ($this->item_type == 'Recurring') {
            $bookingData = $this->Recurring->UserBookingDetail;
            if($bookingData != ''){
                $activityName = $bookingData->business_services_with_trashed->program_name;
                $categoryName = $bookingData->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title;
                $priceOption = $bookingData->business_price_detail_with_trashed->price_title;
                $itemDescription = $activityName.' ('.$categoryName.') ,'.$priceOption;
                $itemPrice .= $this->Recurring->amount != '' ? '$'.$this->Recurring->amount .'<br>' : '$0<br>';
                $itemSubTotal .= '$'. (($this->Recurring->amount + $this->Recurring->tax) ?? 0 ) .'<br>' ;
                $itemDis .= '$0<br>';
                $itemTax .= '$' . ($this->Recurring->tax ?? 0) . '<br>';
                $addOnTotal .= '$0<br>';
                            
                $location .= @$bookingData->company_information != '' ? @$bookingData->company_information->public_company_name.'<br>' : '<br>';
                $totalTax += $this->Recurring->tax ?? 0;
                $totalDis +=  0;
                $totalPaid += ($this->Recurring->amount + $this->Recurring->tax) ?? 0;
                $notes .= $bookingData->note != '' ? $bookingData->note.'<br>' : 'N/A<br>';
                $qty++;
            }
        }
        
        $arry = array("qty"=>$qty,"itemDescription"=>$itemDescription,"itemPrice"=> $itemPrice ?? 0,"itemSubTotal"=> $itemSubTotal ?? 0,"itemDis"=> $itemDis ?? 0,"itemTax"=> $itemTax ?? 0,"location"=> $location  ?? 'N/A',"totalTax"=> $totalTax ?? 0, "totalDis"=> $totalDis ?? 0,"totalPaid"=> $totalPaid  ?? 0,'notes'=>$notes);
        return $arry;
    }

    public function getCustomer($business_id){
        if($this->user_type == 'customer'){
            return $this->Customer;
        }else{
            $user = $this->User;
            return Customer::where(['email'=>@$user->email ,'fname' => @$user->firstname ,'lname' => @$user->lastname ,'business_id' =>$business_id])->first();
        }
    }
}