<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

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
	    foreach($cartdata['cart_item'] as $key=>$dt){
	    	if($dt['chk'] != 'activity_purchase'){
	    		$cart['cart_item'] [$key]= $dt;
	    	}
	    }

    	return view('cart.index',[
	        'cart' => $cart,
	        'cardInfo' => $cardInfo,
    	]);
    }

    
}