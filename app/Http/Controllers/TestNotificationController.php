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
        /*$deviceToken = 'c5bbab97e14ff34c339088cd9413b03a9f1adb953582032466788dde1c79d6a9';
        $result = PushNotification::app('appNameIOS')
                ->to($deviceToken)
                ->send('Hello World, i`m a push message');
echo json_encode($result);

//iOS app
$devices = PushNotification::DeviceCollection(array(
    PushNotification::Device($deviceToken, array('badge' => 5)),
));
$message = PushNotification::Message('Message Text',array(
    'badge' => 1,
    'sound' => 'default',

    'actionLocKey' => 'Action button title!',

    'custom' => array('custom data' => array(
        'we' => 'want', 'send to app'
    ))
));

$collection = PushNotification::app('appNameIOS')
    ->to($devices)
    ->send($message);

// get response for each device push
foreach ($collection->pushManager as $push) {
    $response = $push->getAdapter()->getResponse();
}

// access to adapter for advanced settings
$push = PushNotification::app('appNameAndroid');
$push->adapter->setAdapterParameters(['sslverifypeer' => false]);

echo json_encode($result);
//        echo app_path().'/texi_push_devlopment.pem';
        return json_encode('hi');die;
//        return view('tasks.index', [
//            'tasks' => $this->tasks->forUser($request->user()),
//        ]);*/
    }
}