<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\AnnouncementContactCustomerList;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        
       /* $signature = $request->header('X-Twilio-Email-Event-Webhook-Signature');

        if (!$this->isValidSignature($request->all(), $signature)) {
            Log::warning('Invalid signature', 403);
        }*/

        $data = json_decode($request->getContent(), true);

        if (is_array($data) && isset($data[0])) {
            foreach ($data as $event) {
                if (isset($event['event'])) {

                    $eventType = $event['event'];
                    $recipientEmail = $event['email'];
                    $timestamp = $event['timestamp'];

                    if(isset($event['announcementId'])){
                        $announcementId = $event['announcementId'];
                        $customerId = $event['customerId'];

                        $ann = AnnouncementContactCustomerList::where(['announcement_id' => $announcementId, 'customer_id' => $customerId])->first();

                        switch ($eventType) {
                            case 'open':
                        
                                if ($ann) {
                                    $ann->update(['is_opened_email' => 1]);
                                }
                                break;

                            case 'delivered':
                                if ($ann) {
                                    $ann->update(['is_delivered_email' => 1]);
                                }
                                break;

                            case 'unsubscribe':
                                if ($ann) {
                                    $ann->update(['is_unsubscribed_email' => 1]);
                                }
                                break;

                            default:
                                Log::warning('Unhandled event type', ['event' => $eventType]);
                        }
                    }
                } else {
                    Log::warning('Event does not have an "event" key', ['event' => $event]);
                }
            }
        } else {
            Log::warning('Unexpected webhook payload format', ['data' => $data]);
        }

        return response('Webhook received', 200);
    }

    private function isValidSignature($payload, $signature)
    {
        $secret = env('SENDGRID_WEBHOOK_SECRET'); // Set your webhook secret from SendGrid

        $computedSignature = hash_hmac('sha256', $payload, $secret);

        return hash_equals($signature, $computedSignature);
    }
}

?>