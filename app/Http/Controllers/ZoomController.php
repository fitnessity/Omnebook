<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Zooms\Myzoom;
use App\Meeting;
use Auth;
use Redirect;
use App\User;
use Mail;
use Session;

class ZoomController extends Controller
{
    public function __construct( Request $r){
        $d = new Myzoom; 
       
        
        $this->check($r);

    }
    public function check(Request $r){
        $loggedinUser = Auth::user();
       
    }
  
    public function index(Request $r)
    {
        
        $loggedinUser = Auth::user();
        if(Auth::check()){
        $mtng = Meeting::where(['meeting_id'=>$r->id])->get();
        $id = $mtng[0]->meeting_id;
      $p = ($loggedinUser['id']==$mtng[0]['user_id'])?$mtng[0]->password:null;
        $role = ($loggedinUser['role']=='business' && $loggedinUser['id']==$mtng[0]['user_id'] )?1:0;
        $name = $loggedinUser['firstname'];
       return view('zoom.zoom2',compact('id','p','role','name'));
        }
        else{
            $user = User::where('id',$r->user_id)->first();
            $user->meeting_id = $r->id;
            $user->save();
            $popup = 'login';
            return redirect('/p/login')->with('popup');
        }
    }
    public function createmeeting(Request $r)
    {   $pageTitle = "Host A Meet Up";
        $dt= date('Y-m-d h:i:s', strtotime('-2 day'));
        $loggedinUser = Auth::user();
       $d = new Myzoom;
       $timezone = $d->timezone_options();
       $users = User::select('firstname','lastname','email')->where(['role'=>'customer'])->where('id','!=',$loggedinUser['id'])->get();
       $meetings = Meeting::where(['user_id'=>$loggedinUser['id']])->where('created_at','>=', $dt)->orderBy('id','desc')->get();
       return view('zoom.create',compact('timezone','meetings','users','pageTitle'));
    }

    public function store(Request $r){
        $d = new Myzoom;
        $loggedinUser = Auth::user();
        $data = $d->createAMeeting($r->input());
       $data = json_decode($data,true);
     $save = array(
        'user_id'=>$loggedinUser['id'],
        'uuid'=>$data['uuid'],
        'meeting_id'=>$data['id'],
        'host_id'=>$data['host_id'],
        'topic'=>$data['topic'],
        'type'=>$data['type'],
        'status'=>$data['status'],
        'start_time'=>$data['start_time'],
        'duration'=>$data['duration'],
        'mytimezone'=>$data['timezone'],
        'start_url'=>$data['start_url'],
        'join_url'=>$data['join_url'],
        'password'=>$data['password'],
        'encrypted_password'=>$data['encrypted_password'],
        'settings'=>json_encode($data['settings'])
     ); 
    
    if(Meeting::create($save)){
        $r->session()->flash('alert-success', 'Meeting is created.');
        return redirect('/createmeeting');
    }
    }

    public function oncall(Request $r)
    {
        $d = new Myzoom;
        return $d->get_auth($r->mid);
    }

    public function invite(Request $r){
        $loggedinUser = Auth::user();
        $emails = $r->user; 
        $loggedinUser['mid']=$r->meeting;
        $m =  Meeting::where('meeting_id',$r->meeting)->get();
       $loggedinUser['password'] = $m[0]['password'];
        $r= false;
        foreach($emails as $email){
            $user = User::where('email',$email)->first();
            $loggedinUser['user_id'] = $user->id;
                $rd =  Mail::send('zoom.invite', ['user' => $loggedinUser], function ($m) use ($email) {
                $m->from('_mainaccount@raursoft.org', 'Fitnessity Meeting');
                
                $m->to([$email], 'Fitnessity')->subject('Your New Meeting');
            });
            $rd= true;
        }
        if($rd){

                Session::flash('alert-success', "Invitation sent");
        return redirect('/createmeeting');
        }
       
    
      

    }

}