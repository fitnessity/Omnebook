<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\{UserFamilyDetail,StripePaymentMethod,GiftedActivityDetails};

class CartController extends Controller {

    public function __construct() {
    	$this->middleware('auth');
    }

    public function index(Request $request){
    	if($request->session()->has('checkoutsession')){
    	    $request->session()->forget('checkoutsession');
    	}

    	$cardInfo = [];

	    $user = Auth::user();

	    $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

	    /*$savedEvents = $stripe->customers->allSources(
	        $user->stripe_customer_id,
	        ['object' => 'card' ,'limit' => 30]
	    );*/

	    $cardInfo = StripePaymentMethod::where('user_type', 'User')->where('user_id', $user->id)->get();

	    /*print_r($savedEvents);
	    exit;*/
	   /* $cardInfo  = json_decode( json_encode( $savedEvents),true);

	    
	    $cardInfo = $savedEvents['data'];*/
	    $cart = [];
	    $cartdata  =  $request->session()->get('cart_item', []);
	    if(!empty($cartdata )){
		    foreach($cartdata['cart_item'] as $key=>$dt){
		    	if($dt['chk'] != 'activity_purchase'){
		    		$cart['cart_item'] [$key]= $dt;
		    	}
		    }
		}

		$intent = null;
		$intent = $stripe->setupIntents->create([
            'payment_method_types' => ['card'],
            'customer' => $user->stripe_customer_id,
        ]);

    	return view('cart.index',[
	        'cart' => $cart,
	        'cardInfo' => $cardInfo,
	        'intent' => $intent, 
	        'user' => $user, 
    	]);
    }

    public function addfamilyfromcart(Request $request){
    	$data = UserFamilyDetail::create([
                'user_id' => Auth::user()->id,
                'first_name' => $request['fname'],
                'last_name' => $request['lname'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'emergency_contact' => $request['emergency_contact'],
                'relationship' => $request['relationship'],
                'gender' => $request['gender'],
                'birthday' => $request['birthdate'],
                'emergency_contact_name' => $request['emergency_name'],
    	]);

    	return redirect('/carts');
    	/*if($data){
    		return "success";
    	}else{
    		return "fail";
    	}*/
    }

    public function addactivitygift(Request $request){
    	//print_r($request->all());exit;
    	/*$data = GiftedActivityDetails::where(['priceid'=> $request->priceid ,'schedual_date' => date('y-m-d',strtotime($request->sc_date)) ,'userid' => Auth::user()->id])->first();*/
    	$List = implode(', ', $request->Emailb);
    	$List = rtrim($List , ', ');
    	$price_show = "0";
    	if($request->has('price_show')){
    		$price_show = "1";
    	}
    	$List = rtrim($List,",");
    	if($request->table_id == ''){
    		GiftedActivityDetails::create([
                'userid' => Auth::user()->id,
                'priceid' => $request->priceid,
                'schedual_date' => date('y-m-d',strtotime($request->sc_date)),
                'email' => $List,
                'price_show_chk' => $price_show,
                'gift_from' => $request->gift_from,
                'comment' => $request->comment,
    		]);
    	}else{
			//$email = $data->email .', '.$List;
    		GiftedActivityDetails::where(['priceid'=> $request->priceid ,'schedual_date' => date('y-m-d',strtotime($request->sc_date)) ,'userid' => Auth::user()->id])->update(['priceid' => $request->priceid,'email' => $List, 'price_show_chk' => $price_show,'gift_from' => $request->gift_from, 'comment' => $request->comment]);
    	}

    	return redirect('/carts');
    }

    public function activity_gift_model(Request $request){
    	$getdata = GiftedActivityDetails::where(['priceid'=> $request->pid ,'schedual_date' => date('y-m-d',strtotime($request->date)) ,'userid' => Auth::user()->id])->first();
    	$email_array = [];
    	if(@$getdata->email != ''){
    		$email_array = explode(',' ,@$getdata->email); 
    	}

    	$html = '';
    	$html .='<form action="'.route("addactivitygift").'" method="post" id="giftform">
			<input type="hidden" name="_token" value="'.csrf_token().'">
			<input type="hidden" name="priceid" id="priceid" value="'.$request->pid.'">
			<input type="hidden" name="sc_date" id="sc_date" value="'.$request->date.'">
			<input type="hidden" name="table_id" id="table_id" value="'.@$getdata->id.'">
			<div class="row contentPop"> 
				<div class="col-lg-12 nopadding">
				   <h4 class="modal-title" style="text-align: left; color: #000; line-height: inherit; font-weight: 600;">Leave a gift for your friends and family</h4>
				   <hr style="border: 8px solid #df0003; width: 80%; margin-left: -16px;">
				</div>
				<div class="row">
					<div class="col-lg-2">
						<div class="activity-title-img">
							<img src="'.$request->img.'" alt="Avatar" class="avatar">
						</div>
					</div>
					<div class="col-lg-10">
						<div class="activity-details">
							<h3 id="act_name">'.$request->name.'</h3>
							<p>We will include all of the booking details in the email your guest will receive</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6">
						<div class="gift-comments">
							<label>Leave a comment for them</label>
							<textarea class="form-control" rows="4"  name="comment" id="comment" maxlength="150">'.@$getdata->comment.'</textarea>
							<label>From:</label>
							<input type="name" class="form-control myemail" name="gift_from"  id="gift_from" autocomplete="off" placeholder="" size="30" maxlength="80" value="'.@$getdata->gift_from.'">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="gift-comments email multiple-email" id="emaildiv">';
							if(!empty($email_array)){
								foreach($email_array as $email){
									$html .='<input type="email" class="form-control myemail" name="Emailb[]" id="b_email" autocomplete="off" placeholder="Enter Recipient Email" size="30" maxlength="80" value="'.$email.'">';
								}
							}else{
								$html .='<input type="email" class="form-control myemail" name="Emailb[]" id="b_email" autocomplete="off" placeholder="Enter Recipient Email" size="30" maxlength="80" value="">';
							}

							
						$html .='</div>
						<a href="#" class="addnewemail" onclick="addemail();">+Add another email</a>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="booking-checkbox">
							  	<input type="checkbox" id="price_show" name="price_show" value="1"';
							  	if(@$getdata->price_show_chk == '1' ){
							  		$html .='checked';
							  	}

							$html .='>
							  <label for="price_show">Don’t Show The Price</label>
							  <p>If this is a gift, you can have the option not to show the price in the booking email.</p>
						</div>
					</div>
					<div class="col-lg-12 text-right">
						<button class="post-btn-red" type="submit" id="submit">Save</button>
					</div>
				</div>
			</div>
    	</form>';

    	return $html;
    }
}