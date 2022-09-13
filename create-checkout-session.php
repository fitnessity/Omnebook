<?php
//echo "<pre>";print_r($_POST);die;
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51Jv2tzSGD8iOl68TozCzVzeMG0RSNVbVjjolItkzLnLZW8vnJ3c0yDOZbvJX4m908zQX8RtZbRLmddkA0seefy2K00VgDaeSsu');
//\Stripe\Stripe::setApiKey('sk_test_51Jz4E7Gx8oxmIYVRgISNkdcnIVBbBKwbgvjL1aTmL5zrZbPOfYLufX9wUA4Mny2xbcaCHbMYOusUM0aNMPfB1ack00Am8JcMHg');


header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://www.fitnessity.co/stripe';

$listItems = [];
if(isset($_POST)) {
    $itemcount = count($_POST['itemname']);
    
    for($i=0; $i < $itemcount; $i++) {
        
        if(isset($_POST['itemname'][$i])) {
            $product = \Stripe\Product::create([
              'name' => $_POST['itemname'][$i],
              'description' => $_POST['itemtype'][$i],
              'images' => [$_POST['itemimage'][$i]],
            ]);

            $price = \Stripe\Price::create([
              'product' => $product->id,
              'unit_amount' => $_POST['itemprice'][$i] / $_POST['itemqty'][$i],
              'currency' => 'usd',
            ]);

            $listItem['price'] = $price->id;
            $listItem['quantity'] = $_POST['itemqty'][$i];
            $listItems[] = $listItem;
        }
    }   
}

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    $listItems
  ],
  'payment_method_types' => [
    'card',
  ],
  'mode' => 'payment',
  'success_url' => 'http://www.fitnessity.co/instant-hire/confirm-payment',
  'cancel_url' => 'http://www.fitnessity.co/instant-hire/cart-payment',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
