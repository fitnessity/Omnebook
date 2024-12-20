<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Davibennun\LaravelPushNotification\Facades\PushNotification;

class TestNotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function send_notification_ios(Request $request)
    {
        $apnsHost = 'gateway.push.apple.com';
        $apnsPort = 2195;

        $apnsCert = public_path().'/assets/push/texi_push_devlopment.pem';

        $streamContext = stream_context_create();

        stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);

        $apns = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);

        $payload['aps'] = "this is a new test message";

        $payload = json_encode($payload);

        $deviceToken = "c5bbab97e14ff34c339088cd9413b03a9f1adb953582032466788dde1c79d6a9";  // Hier das

        if ($apns)
        {
                $apnsMessage = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
                @fwrite($apns, $apnsMessage);
        }
        fclose($apns);
        echo $apnsMessage;

    }
}