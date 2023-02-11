<?php

namespace App\Services;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

class TwilioService
{
    /**
     * Twilio rest client
     *
     * @var Twilio\Rest\Client
     */
    private $_cart;

    /**
     * TwilioService constructor.
     *
     * @throws ConfigurationException
     */
    public function __construct()
    {
        $this->$_cart = $request->session()->get('cart_item', []);

    }

    // with tax + 
    public function total()
    {
        $this->tax_total() + $this->fitnesity_fee_total() + 
    }


    [
        {'activity_id': 1, 'price_detail_id': 1, }
    ]

    {'participating_details': {
        'adult': { 'quantity': 1, 'unit_price': 1, 'discount_precentage': 0.23, 'sub_total': 123 }
        'infant': { 'quantity': 1, 'unit_price': 1, 'discount_precentage': 0.23, 'sub_total': 123 }
        'child': { 'quantity': 1, 'unit_price': 1, 'discount_precentage': 0.23, 'sub_total': 123 }
    }}
}
