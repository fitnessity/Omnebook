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
    private $twilioRestClient;

    /**
     * TwilioService constructor.
     *
     * @throws ConfigurationException
     */
    public function __construct()
    {
        $this->twilioRestClient = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

    }

    /**
     * Make a voice call to a phone number providing an otp code from the application
     *
     * @param String $phoneNumber
     * @param $otpCode
     * @return \Twilio\Rest\Api\V2010\Account\CallInstance
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function makeOtpVoiceCall(String $phoneNumber, $otpCode)
    {
       // print_r( env('TWILIO_FROM_NUMBER'));die;
        // Url which points to our application route for generating the TWIML used in calling the user.
        $twimlUrl = env('APP_URL') . "generateMessage/" .$otpCode;

        $call = $this->twilioRestClient->calls->create($phoneNumber, env('TWILIO_NUMBER'), array("url" => $twimlUrl));

        //return $call->sid;
    }

    /**
     * Generate the TWIML needed for a voice call sending an OTP code to a user.
     *
     * @param $otpCode
     * @return VoiceResponse
     */
    public function generateTwiMLForVoiceCall($otpCode)
    {
        /**
         * We add spaces between each digit in the otpCode so Twilio pronounces each number instead of pronouncing the whole word.
         *
         * @See https://www.twilio.com/docs/voice/twiml/say#hints
         */
        $otpCode = implode(' ', str_split($otpCode));

        $voiceMessage = new VoiceResponse();
         $voiceMessage->say('Your one time password is '.$otpCode, ['voice' => 'woman', 'language' => 'en-IN']);
       // $voiceMessage->say('This is an automated call providing you your OTP from the test app.');
      //  $voiceMessage->say('Your one time password is ' . $otpCode);
      //  $voiceMessage->pause(['length' => 1]);
      //  $voiceMessage->say('Your one time password is ' . $otpCode);
      //  $voiceMessage->say('GoodBye');
       
    //   print_r($voiceMessage);die;

        return $voiceMessage;
    }
}
