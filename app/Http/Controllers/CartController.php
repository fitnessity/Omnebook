<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\UserFamilyDetail;

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

	    $savedEvents = $stripe->customers->allSources(
	        $user->stripe_customer_id,
	        ['object' => 'card' ,'limit' => 30]
	    );

	    $savedEvents  = json_decode( json_encode( $savedEvents),true);

	    
	    $cardInfo = $savedEvents['data'];
	    $cart = [];
	    $cartdata  =  $request->session()->get('cart_item', []);
	    if(!empty($cartdata )){
		    foreach($cartdata['cart_item'] as $key=>$dt){
		    	if($dt['chk'] != 'activity_purchase'){
		    		$cart['cart_item'] [$key]= $dt;
		    	}
		    }
		}

    	return view('cart.index',[
	        'cart' => $cart,
	        'cardInfo' => $cardInfo,
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
}