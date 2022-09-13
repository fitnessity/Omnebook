<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

// use App\User;
// use App\MailService;
// use Mail;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
//        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }

    // public function testmail()
    // {
    //     $user = User::findOrFail();
    //     Mail::send('emails.welcome', ['user' => $user], function ($m) use ($user) {
    //         $m->from('contact@fitnessity.net', 'Fitnessity');

    //         $m->to($user->email, $user->name)->subject('Welcome!');
    //     });
    // }

    public function testTwilio(Request $request)
    {
        require asset('/twilio/sdk/Services/Twilio.php');
//        require asset('/css/material-charts.css');die;
          // Create an authenticated client for the Twilio API
          $client = new Services_Twilio($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);

          // Use the Twilio REST API client to send a text message
          $m = $client->account->messages->sendMessage(
                $_ENV['TWILIO_NUMBER'], // the text will be sent from your Twilio number
                $number, // the phone number the text will be sent to
                $message // the body of the text message
          );

          // Return the message object to the browser as JSON
          return $m;
    }
}
