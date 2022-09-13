<?php

namespace App\Libraries\Stripes;



require_once 'vendor/autoload.php';

require_once 'vendor/Stripe/stripe-php/init.php';

use Stripe\Stripe;

use Stripe\Customer;

use Stripe\ApiOperations\Create;

use Stripe\Charge;

Class StripePay{

    

        private $apiKey;

    

        private $stripeService;

    

        public function __construct()

        {

            

            $this->apiKey = env('SECRET_KEY');

            $this->stripeService = new Stripe;

            $this->stripeService->setVerifySslCerts(false);

            $this->stripeService->setApiKey($this->apiKey);

        }

    

        public function addCustomer($customerDetailsAry)

        {

            

            $customer = new Customer;

            

            $customerDetails = $customer->create($customerDetailsAry);

            

            return $customerDetails;

        }

    

        public function chargeAmountFromCard($cardDetails)

        {

            $customerDetailsAry = array(

                'email' => $cardDetails['email'],

                'source' => $cardDetails['token']

            );

            $customerResult = $this->addCustomer($customerDetailsAry);

            $charge = new Charge;

            $cardDetailsAry = array(

                'customer' => $customerResult->id,

                'amount' => $cardDetails['amount']*100 ,

                'currency' => $cardDetails['currency_code'],

                'description' => $cardDetails['item_name'],

                'metadata' => array(

                    'order_id' => $cardDetails['nameofitems']

                )

            );

            $result = $charge->create($cardDetailsAry);

    

            return $result->jsonSerialize();

        }



        public function test(){

            return "aagaya";

        }

    }