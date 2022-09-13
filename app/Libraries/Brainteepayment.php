<?php 

include(app_path() . '/Libraries/vendor/autoload.php');


function getBraintreeToken() {
  
	$gateway = getCredentials();
	
	$token = $gateway->clientToken()->generate();

	return $token;
}

function getCredentials()
{
	return $gateway = new Braintree_Gateway([
	  'environment' => 'sandbox',
	  'merchantId' => '2jvk489r42n6h3kv',
	  'publicKey' => 'x2gx7fyxgy5p3f2t',
	  'privateKey' => 'eb89a6bf81a868248ce665336b7ecb28'
	]);
}

function setpayment($amount, $payment_id, $firstName, $lastName, $email){
	$gateway = getCredentials();

	$result = $gateway->transaction()->sale([
		'amount' => $amount,
		'paymentMethodNonce' => $payment_id,
		'customer' => [
		    'firstName' => $firstName,
		    'lastName' => $lastName,
		    'email' => $email
		  ],
		'options' => [
		'submitForSettlement' => True
		]
	]);

	return $result;
}
