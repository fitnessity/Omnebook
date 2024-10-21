<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Str;
use App\{UserFamilyDetail,StripePaymentMethod,GiftedActivityDetails,Customer,User,SGMailService,BusinessTerms};

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
	    $cardInfo = StripePaymentMethod::where('user_type', 'User')->where('user_id', $user->id)->get();
	    $cart = [];

	    $cartdata  =  $request->session()->get('cart_item', []);
	 
	    if(!empty($cartdata) && count($cartdata) >0 ) {
		    foreach($cartdata['cart_item'] as $key=>$dt){
		    	if($dt['chk'] == '' ){
		    		$cart['cart_item'] [$key]= $dt;
		    	}
		    }
		}

		if($user->stripe_customer_id == '')
			$user->create_stripe_customer_id();
		
		$intent = null;
		$intent = $stripe->setupIntents->create([
            'payment_method_types' => ['card'],
            'customer' => $user->stripe_customer_id,
        ]);

		// dd($cart);
    	return view('cart.index',[
	        'cart' => $cart,
	        'cardInfo' => $cardInfo,
	        'intent' => $intent, 
	        'user' => $user, 
    	]);
    }

    public function addfamilyfromcart(Request $request){
    	$user = Auth::user();
    	$data = UserFamilyDetail::create([
            'user_id' => Auth::user()->id,
            'first_name' => $request['fname'],
            'last_name' => $request['lname'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'emergency_contact' => $request['emergency_contact'],
            'relationship' => $request['relationship'],
            'gender' => $request['gender'],
            'birthday' => date('Y-m-d', strtotime($request['birthdate'])),
            'emergency_contact_name' => $request['emergency_name'],
    	]);
    	$company = $user->company;
    	foreach($company as $key=>$c){
            if($key == 0){
                $random_password = Str::random(8);
                $Password = Hash::make($random_password);
            }
            $Customer = Customer::create([
                'business_id' => $c->id,
                'password' => $Password ,
                'fname' => $request['fname'],
                'lname' => $request['lname'],
                'email' => $request['email'],
                'phone_number' => $request['mobile'],
                'emergency_contact' => $request['emergency_contact'],
                'relationship' => $request['relationship'],
                'gender' => $request['gender'],
                'birthdate' => date('Y-m-d',strtotime($request['birthdate'])),
            ]);

            if($key == 0){
                $User = User::create([
                    'role' => 'customer',
                    'password' => $Password,
                    'firstname' => $request['fname'],
                    'lastname' => $request['lname'],
                    'username' => $request['fname'].' '.$request['lname'],
                    'email' => $request['email'],
                    'phone_number' => $request['mobile'],
                    'emergency_contact' => $request['emergency_contact'],
                    'relationship' => $request['relationship'],
                    'gender' => $request['gender'],
                    'birthdate' => date('Y-m-d',strtotime($request['birthdate'])),
                    'activated' => 1,
                    //'stripe_customer_id' => $Customer->stripe_customer_id
                ]);

                $status = SGMailService::sendWelcomeMailToCustomer($Customer->id,$c->id,$random_password); 
            }
            $Customer->update(['user_id'=>$User->id , 'stripe_customer_id' =>@$User->stripe_customer_id ]);            
        } 

    	return redirect('/carts');
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

			<div class="row">
				<div class="col-lg-2 col-sm-4 col-4">
					<div class="activity-title-img">
						<img src="'.$request->img.'" alt="Avatar" class="avatar-cart">
					</div>
				</div>
				<div class="col-lg-10 col-sm-8 col-8">
					<div class="activity-details">
						<h3 id="act_name">'.$request->name.'</h3>
						<p class="fs-13">We will include all of the booking details in the email your guest will receive</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<div class="gift-comments mb-15 mt-15">
						<label class="">Leave a comment for them</label>
						<textarea class="form-control" rows="4" name="comment" id="comment" maxlength="150" required>'.@$getdata->comment.'</textarea>
						<label>From:</label>
						<input type="name" class="form-control myemail" name="gift_from" id="gift_from" autocomplete="off" placeholder="" size="30" maxlength="80" value="'.@$getdata->gift_from.'" required>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="gift-comments email multiple-email mt-15" id="emaildiv">';
						if(!empty($email_array)){
							foreach($email_array as $email){
								$html .='<input type="email" class="form-control myemail mb-10" name="Emailb[]" id="b_email" autocomplete="off" placeholder="Enter Recipient Email" size="30" maxlength="80" value="'.$email.'" required>';
							}
						}else{
							$html .='<input type="email" class="form-control myemail" name="Emailb[]" id="b_email" autocomplete="off" placeholder="Enter Recipient Email" size="30" maxlength="80" value="" required>';
						}

					$html .='</div>
					<a href="#" class="addnewemail fs-13" onclick="addemail();">+Add another email</a>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="booking-checkbox">
						<input type="checkbox" id="price_show" name="price_show" value="1"';
							if(@$getdata->price_show_chk == '1' ){
						  		$html .='checked';
						  	}
						$html .='> <label class="fs-13" for="price_show">Don’t Show The Price</label>
						<p class="fs-13">If this is a gift, you can have the option not to show the price in the booking email.</p>
					</div>
				</div>
				<div class="col-lg-12 text-right">
					<button class="btn btn-red fs-13" type="submit" id="submit">Save</button>
				</div>
			</div>
    	</form>';

    	return $html;
    }


    public function getTerms(Request $request){
    	$termsDesc =BusinessTerms::where('id',$request->id)->pluck($request->termsType)->first();
    	$termsHeader = $request->termsHeader;
    	return view('cart.termsModel',compact('termsDesc','termsHeader'));
    }
}