<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserProfessionalDetail;
use App\UserEmploymentHistory;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Repositories\UserRepository;
use App\Repositories\CmsRepository;
use App\Miscellaneous;
use ReCaptcha\ReCaptcha;
use Image;
//use Illuminate\Support\Facades\Input;
use Hash;
use Redirect;
use Response;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Socialize;
use App\UserService;
use App\Sports;
use View;
use App\AddrStates;
use App\AddrCountries;
use App\AddrCities;
use App\Api;
use Session;
use App\UserEducation;
use App\UserCertification;
use App\UserSkillAward;
use Str;
use App\MailService;

use App\Repositories\ReviewRepository;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ThrottlesLogins;

    protected $loginPath = '/';

    protected $redirectTo = '/';

    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * review Repository
     *
     * @var review Object
     */
    protected $review;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users,ReviewRepository $review)
    {
        $this->middleware('guest', ['except' => ['getLogout', 'resendVerifyCode', 'verify','jsModalregister','updateStep','saveGender','saveaddress','savephoto','uploadProfile111']]);
        $this->users = $users;
        $this->review = $review;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
     
     public function uploadProfile111(Request $request)
     {
          // save profile pic
        $image = new Image();
        $request->profile_pic = '';
        if($request->hasFile('profile_pic')) {
            $file =  $request->file('profile_pic');

            //getting timestamp
            // $timestamp = date('YmdHis', strtotime(date('Y-M-d H:i:s')));

            // $name = $timestamp. '-' .$file->getClientOriginalName();

            // $image->filePath = $name;

            // $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR, $name);
            
            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('profile_pic'),$file_upload_path,1,$thumb_upload_path,'415','354');

            $request->profile_pic =$image_upload['filename'];

            //Store thumb
            if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {
                    mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);
            }
            $thumb_upload_path150 = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR;
            
            Image::make($request->file('profile_pic'))->resize(150, 150)->save($thumb_upload_path150 . $image_upload['filename']);
        }
        
        $user = User::where('id',Auth::user()->id)->first();
        $user->profile_pic = $request->profile_pic;
         $user->save();
         return response()->json(['status'=>200]);
     }
     
     public function updateStep(Request $request)
     {
         $user = User::where('id',Auth::user()->id)->first();
         $user->show_step=$request->show_step;
         $user->save();
         return response()->json(['status'=>200]);
     }
     
     public function saveGender(Request $request)
     {
         $user = User::where('id',Auth::user()->id)->first();
         $user->show_step=$request->show_step;
         $user->gender=$request->gender;
         
         $user->save();
         return response()->json(['status'=>200]);
     }
     
     public function saveaddress(Request $request)
     {
        /* $s = AddrStates::where('state_name',$request->state)->get();
        $c = AddrCities::where('city_name',$request->city)->get();
        $co =AddrCountries::where('country_name',$request->country_name)->get();*/
         $user = User::where('id',Auth::user()->id)->first();
         $user->show_step=$request->show_step;
         $user->address=$request->address;
         /*$user->country=@$co[0]->country_code;
         $user->city=@$c[0]->id;
         $user->state=@$s[0]->id;*/
         $user->country=$request->country;
         $user->city=$request->city;
         $user->state=$request->state;
         $user->zipcode=$request->zipcode;
         $user->latitude=$request->lat;
         $user->longitude=$request->lon;
         $user->save();
         $url = '/';
         return response()->json(['status'=>200,'redirecturl'=>$url]);
     }

     public function savephoto(Request $request)
     {   
         $user = User::where('id',Auth::user()->id)->first();
         if ($request->hasFile('file_upload_profile')) {
            $name = $request->file('file_upload_profile')->store('customer');
			$user->profile_pic =  $name; 
		 }
         $user->show_step = 6;
		 $user->save();
         return response()->json(['status'=>200]);
     }
     
     public function newRegister(){
         return view('auth.new-register');
     }
     
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected function businessValidator($data)
    {
        // $data['captcha'] =$this->users->captchaCheck($data['g-recaptcha-response']);
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret   = env('RE_CAP_SECRET');

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($data['g-recaptcha-response'], $remoteip);
        if ($resp->isSuccess()) {
            $data['captcha']= 1;
        } else {
            $data['captcha']= 0;
        }

        return Validator::make($data, [
            'profile_pic' => 'required|image|mimes:jpeg,jpg,png',
            'company_name' => 'required|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'gender' => 'required',
            'email' => 'required|email|max:255|unique:users,email',            
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
            'phone_number' => 'regex:/^\(?([1-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
            'address' => 'required|max:255',
            'city' => 'required|max:10',
            'state' => 'required|max:10',
            'zipcode' => 'required|integer',
            'ein_number' => 'required',
            'establishment_year' => 'required|integer',
            'g-recaptcha-response'  => 'required',
            'captcha'               => 'required|min:1',
            'terms_condition' => 'required'
        ],
        [
            'required' => 'The :attribute is required.',
            'terms_condition' => 'Please agree with terms & conditions',
            'integer' => 'The :attribute must be a number.',
            'phone_number' => 'Phone number format is invalid.',
            'g-recaptcha-response.required' => 'Captcha is required',
            'captcha.min' => 'Wrong captcha, please try again.'
        ]);
    }

    protected function professionalValidator($data)
    {
        // $data['captcha'] =$this->users->captchaCheck($data['g-recaptcha-response']);
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret   = env('RE_CAP_SECRET');

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($data['g-recaptcha-response'], $remoteip);
        if ($resp->isSuccess()) {
            $data['captcha']= 1;
        } else {
            $data['captcha']= 0;
        }

        return Validator::make($data, [
            'profile_pic' => 'required|image|mimes:jpeg,jpg,png',
            'company_name' => 'required|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'gender' => 'required',
            'email' => 'required|email|max:255|unique:users,email',            
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
            'phone_number' => 'regex:/^\(?([1-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
            'address' => 'required|max:255',
            'city' => 'required|max:10',
            'state' => 'required|max:10',
            'zipcode' => 'required|integer',
            'ein_number' => 'required_without:social_security_no',
            'social_security_no' => 'required_without:ein_number',
            'g-recaptcha-response'  => 'required',
            'captcha'               => 'required|min:1',
            'terms_condition' => 'required'
        ],
        [
            'required' => 'The :attribute is required.',
            'terms_condition' => 'Please agree with terms & conditions',
            'integer' => 'The :attribute must be a number.',
            'phone_number' => 'Phone number format is invalid.',
            'g-recaptcha-response.required' => 'Captcha is required',
            'captcha.min' => 'Wrong captcha, please try again.'
        ]);
    }

    public function jsModallogin($sport_id = null)
    {
        if(isset($sport_id) && $sport_id != null && $sport_id > 0) {
            session(['bookSportAfterLogin' => $sport_id]);
        }
        return view('auth.login');
    }

    public function jsModalregister()
    {
        //print_r("hgh");die;
        if(Auth::check()){
        $show_step=Auth::user()->show_step;
        }
        else{
        $show_step=1;
        }
        $customerId = '';
        return view('home.registration',compact('show_step'));
    }

    public function jsModalpassword()
    {
        return view('auth.password');
    }
    
    public function myemail(Request $r){
    
    if(!$this->users->validateUser($r->email))
            {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Email already exists. Please select different Email',
                );
                return Response::json($response);
            }else{
                $response = array(
                    'type' => 'true'
                    
                );
                return Response::json($response);
            }
           
}
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postLogin(Request $request){
        
        //$postArr = Input::all();
        $postArr = $request->all();

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        
        $validator = Validator::make($postArr,$rules);

        if($validator->fails()) {
          $errMsg = array();
            foreach($validator->messages()->getMessages() as $field_name => $messages) {
                
                $errMsg = $messages;
                
            }

                $response = array(
                        'type' => 'danger',
                        'msg' => $errMsg,
                    );

                    return Response::json($response);
        } else {
            $remember = false;
            if(!empty($postArr['remember'])){
                $remember = true;
            }
            if (Auth::attempt(['email' => $postArr['email'], 'password' => $postArr['password']],$remember)) {

                if(Auth::user()->is_deleted == "1") {
                    $response = array(
                        'type' => 'danger',
                        'msg' => 'Your profile is not active.',
                    );
                    Auth::logout(); 
                    return Response::json($response);
                    exit();
                }
                
                if(Auth::user()->confirmation_code && Auth::user()->confirmation_code != NULL && Auth::user()->activated == "0") {
                    $response = array(
                        'type' => 'danger',
                        'msg' => 'Your email address is not verified. Please check your inbox for email verification.',
                    );
                    Auth::logout(); 
                    return Response::json($response);
                    exit();
                }
                
                if(Auth::user()->is_firstlogin_after_approve) {
                    $request->session()->flash('alert-success', 'Congratulations....!!! Your profile is now active on Fitnessity.');
                    User::WHERE('id', Auth::user()->id)->update(['is_firstlogin_after_approve' => '0']);
                }else {
                    //$request->session()->flash('alert-success', 'Welcome '.$postArr['email']);
                }
                // The user is being remembered...
                // check if user category change

                $parent_sports = Sports::SELECT('sports.parent_sport_id')->LEFTJOIN('user_services', 'user_services.sport', '=', 'sports.parent_sport_id')->where('user_services.user_id',Auth::user()->id)->where('sports.is_deleted',0)->get();

                if(count($parent_sports) > 0 && !empty($parent_sports)){
                    
                    $response = array(
                        'type' => 'success',
                        'msg' => 'You are logged in successfully',
                        'redirecturl' => '/user/sport-alert'
                    );

                    return Response::json($response);
                    exit();
                }
                if(Auth::user()->is_upgrade == 1){
                     $user = User::where('id',Auth::user()->id)->first();
                     $user->role = 'customer';
                     $user->save();
                }
                if(Auth::user()->meeting_id == null){
                    $response = array(
                        'type' => 'success',
                        'msg' => 'You are logged in successfully',
                        'redirecturl' => '/'
                    );
                }
                else{
                    $response = array(
                        'type' => 'success',
                        'msg' => 'You are logged in successfully',
                        'redirecturl' => '/join/'.Auth::user()->meeting_id.'/'.Auth::user()->id
                    );
                    $user = User::where('id',Auth::user()->id)->first();
                    $user->meeting_id = null;
                   $user->save();
                }
                   return Response::json($response);
            }
            else {
                $response = array(
                        'type' => 'danger',
                        'msg' => 'Incorrect Email or Password',
                    );

                    return Response::json($response);
                    exit();
            }
        }
    }

    public function PostRegister(Request $request){

        //$postArr = Input::all();
        $postArr = $request->all();
        

        $rules = [
            'firstname'         => 'required',
            'lastname'         => 'required',
            // 'email'             => 'required|unique:users',
            'password'          => 'required',
            'confirm_password'  => 'required|same:password',
            'g-recaptcha-response'  => 'required',
            'captcha'               => 'required|min:1'
        ];

        $rulesMessage = [
            'g-recaptcha-response.required' => 'Captcha is required',
            'captcha.min' => 'Wrong captcha, please try again.'
        ];

        $postArr['captcha'] =$this->users->captchaCheck($postArr['g-recaptcha-response']);
        $validator = Validator::make($postArr,$rules,$rulesMessage);
        if($validator->fails()) {            
            $errMsg = array();
            foreach($validator->messages()->getMessages() as $field_name => $messages) {                
                $errMsg = $messages;                
            }
            $response = array(
                    'type' => 'danger',
                    'msg' => $errMsg,
            );
            return Response::json($response);
        } else {
            //check for unique email id
            if(!$this->users->validateUser($postArr['email']))
            {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Email already exists. Please select different Email',
                );
                return Response::json($response);
            };
            //check for unique user name
            if(!$this->users->validateUser($postArr['username']))
            {
                $response = array(
                     'type' => 'danger',
                     'msg' => 'User name already exists. Please select different Name',
                    );
                    return Response::json($response);
                    print_r("usefdhfidjhgidfhuighdfb");die;
            };

            if(count($postArr) > 0){

                $userObj = New User();
                $userObj->firstname = $postArr['firstname'];
                $userObj->lastname = ($postArr['lastname']) ? $postArr['lastname'] : '';
                $userObj->username = $postArr['username'];
                $userObj->password = Hash::make(str_replace(' ','',$postArr['password']));
                $userObj->email = $postArr['email'];
                $userObj->role = 'customer';
                $userObj->country = 'US';
                $userObj->activated = 0;
                $userObj->phone_number = $postArr['contact'];
                // $userObj->last_ip = '192.168.0.0';
                // $userObj->status = "email_activation_pending";
                $userObj->status = "approved";
                $userObj->buddy_key = $postArr['password'];

                //For signup confirmation 
                $userObj->confirmation_code = Str::random(25);
                $userObj->save();

                if($userObj){
                    //send notification email to user
                    // MailService::sendEmailReminder($userObj->id);
                    MailService::sendEmailSignupVerification($userObj->id);

                    $url = "/";
                    if(isset($userObj->confirmation_code) && !empty($userObj->confirmation_code)){
                        $url = '/register/confirm/'.$userObj->confirmation_code;
                    }

                    $response = array(
                        'type' => 'success',
                        'msg' => 'Thank you for registering with Fitnessity. Please verify your email address.',
                        'redirecturl' => $url,
                    );

                     return Response::json($response);
                }else {

                    $response = array(
                        'type' => 'danger',
                        'msg' => 'Some wrror occured while registering. Please try again later.',
                    );

                     return Response::json($response);
                }

            } else {

                 $response = array(
                        'type' => 'danger',
                        'msg' => 'Invalid email or password',
                    );

                return Response::json($response);
            }
        }
    }
    // sign up process for business

    public function getRegisterbusiness() {
        $cms = new CmsRepository;
        $pageContent = $cms->getPageContent('terms_condition');
        
        return view('auth.registerBussiness', [
            'countries' => $this->users->getCountriesList(),
            'terms_condition_content' => preg_replace('/(^[\"\']|[\"\']$)/', '', html_entity_decode(htmlentities(stripcslashes(@$pageContent->content)))),
            'terms_condition_title' => @$pageContent->content_title,
            'pageTitle' => "Business Sign up"
        ]);
    }

    public function postRegisterbusiness(Request $request) {
        
        /* $validator = $this->businessValidator($request->all());
       
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        } */

        //check for unique email id
        if(!$this->users->validateUser($request->email))
        {
            $response = array(
                'type' => 'danger',
                'msg' => 'Email already exists. Please select different Email',
            );
            return Response::json($response);
        }

        // save profile pic
        $image = new Image();
        $request->profile_pic = '';
        if($request->hasFile('profile_pic')) {
            $file =  $request->file('profile_pic');

            //getting timestamp
            // $timestamp = date('YmdHis', strtotime(date('Y-M-d H:i:s')));

            // $name = $timestamp. '-' .$file->getClientOriginalName();

            // $image->filePath = $name;

            // $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR, $name);
            
            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('profile_pic'),$file_upload_path,1,$thumb_upload_path,'415','354');

            $request->profile_pic =$image_upload['filename'];

            //Store thumb
            if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {
                    mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);
            }
            $thumb_upload_path150 = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR;
            
            Image::make($request->file('profile_pic'))->resize(150, 150)->save($thumb_upload_path150 . $image_upload['filename']);
        }
        $s = AddrStates::where('state_name',$request->state)->get();
        $c = AddrCities::where('city_name',$request->city)->get();
        $userObj = New User();
        $userObj->company_name = $request->company_name;
        $userObj->firstname = $request->firstname;
        $userObj->lastname = $request->lastname;
        $userObj->gender = $request->gender;
        $userObj->email = $request->email;
        $userObj->password = bcrypt($request->password);
        $userObj->role = 'business';
        $userObj->phone_number = $request->phone_number;
        $userObj->address = $request->address;
        $userObj->city = @$c[0]->id;
        $userObj->state = @$s[0]->id;
        $userObj->country = strtoupper($request->country);
        $userObj->zipcode = $request->zipcode;
        $userObj->ein_number = $request->b_EINnumber;
        $userObj->establishment_year = $request->b_Establishmentyear;
        $userObj->confirmation_code = Str::random(25);
        $userObj->activated = 0;
        $userObj->buddy_key = $request->password;

        // get lat long
        $latlongdata = Miscellaneous::getLatLong($request->zipcode);
        $userObj->latitude = $latlongdata['lat'];
        $userObj->longitude= $latlongdata['long'];

        $userObj->status  = 'draft';

        if(isset($request->profile_pic) && $request->profile_pic != '') {
            // save new profile pic
            $userObj->profile_pic = $request->profile_pic;
        }

        if(!$userObj->save()) {
            
            return response()->json(['type'=>'danger','msg'=>'Some error has occured while registering user!','redirecturl'=>'/auth/registerBusiness']);
            
           /*  $request->session()->flash('alert-danger', 'Some error has occured while registering user!');
            return redirect('/auth/registerBusiness'); */

        }else {
            //save blank entry into professional detail table
            $userProfileObj = New UserProfessionalDetail();
            $userProfileObj->user_id = $userObj->id;
            $userProfileObj->save();
            
            if($request->course != '' && $request->university != '' && $request->passing_year != '' ){
            $education = new UserEducation();
            $education->user_id = $userObj->id;
            $education->course = $request->course;
            $education->university = $request->university;
            $education->passing_year = $request->passing_year;
            $education->save();
            }
            if($request->organization != '' && $request->position != '' && $request->service_start != '' ){
            $education = new UserEmploymentHistory();
            $education->user_id = $userObj->id;
            $education->organization = $request->organization;
            $education->position = $request->position;
            $education->service_start = $request->service_start;
            if($request->is_present == ''){
                $education->is_present = 0;
                }
                else{
                     $education->is_present = $request->is_present;
                      $education->service_end = date('Y-m-d', strtotime($request->service_end)) ;
                }
            $education->save();
            }
            
            if($request->title != '' && $request->completion_date != '' ){
            $certificate = new UserCertification();
            $certificate->user_id = $userObj->id;
            $certificate->title = $request->title;
            $certificate->completion_date = $request->completion_date;
            $certificate->save();
            }
            
            if($request->type != '' && $request->skill_completion_date != '' ){
            $skil_award = new UserSkillAward();
            $skil_award->user_id = $userObj->id;
            $skil_award->type = $request->type;
            $skil_award->completion_date = $request->skill_completion_date;
            $skil_award->skill_detail = $request->skill_detail;
            $skil_award->save();
            }
            

            //send notification email to user
            // MailService::sendEmailReminder($userObj->id);
            MailService::sendEmailSignupVerification($userObj->id);
            //$request->session()->flash('alert-success', 'Thank you for registering with Fitnessity. Please verify your email address.');
            // Auth::loginUsingId($userObj->id);
            // return redirect('/profile/createProfile');
            // return redirect('/auth/registerBusiness');
            // return view::make('auth.verified_email')->with('user', $userObj);
            if(isset($userObj->confirmation_code) && !empty($userObj->confirmation_code)){
                return response()->json(['type'=>'success','msg'=>'Thank you for registering with Fitnessity. Please verify your email address.','redirecturl'=>'/register/confirm/'.$userObj->confirmation_code]);
                //return redirect('/register/confirm/'.$userObj->confirmation_code);
            } else {
                return response()->json(['type'=>'danger','msg'=>'Thank you for registering with Fitnessity. Please verify your email address.','redirecturl'=>'/']);
            }
        }       
        
    }    


    // sign up process for professional

    public function getRegisterprofessional() {
        $cms = new CmsRepository;
        $pageContent = $cms->getPageContent('terms_condition');
        
        return view('auth.registerProfessional', [
            'countries' => $this->users->getCountriesList(),
            'terms_condition_content' => preg_replace('/(^[\"\']|[\"\']$)/', '', html_entity_decode(htmlentities(stripcslashes(@$pageContent->content)))),
            'terms_condition_title' => @$pageContent->content_title,
            'pageTitle' => "Professional Sign up"
        ]);
    }

    public function postRegisterprofessional(Request $request) {
        
       /*  $validator = $this->professionalValidator($request->all());
       
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        } */

        //check for unique email id
        if(!$this->users->validateUser($request->email))
        {
/*             $validator->errors()->add('field', 'Email already exists. Please select different Email');
            $this->throwValidationException(
                $request, $validator
            ); */
            $response = array(
                'type' => 'danger',
                'msg' => 'Email already exists. Please select different Email',
            );
            return Response::json($response);
        }

        // save profile pic
        $image = new Image();
        $request->profile_pic = '';
        if($request->hasFile('profile_pic')) {
            $file =  $request->file('profile_pic');

            //getting timestamp
            // $timestamp = date('YmdHis', strtotime(date('Y-M-d H:i:s')));

            // $name = $timestamp. '-' .$file->getClientOriginalName();

            // $image->filePath = $name;

            // $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR, $name);
            
            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('profile_pic'),$file_upload_path,1,$thumb_upload_path,'415','354');

            $request->profile_pic =$image_upload['filename'];

            //Store thumb
            if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {
                    mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);
            }
            $thumb_upload_path150 = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR;
            
            Image::make($request->file('profile_pic'))->resize(150, 150)->save($thumb_upload_path150 . $image_upload['filename']);
        }

        $userObj = New User();
        $userObj->company_name = $request->company_name;
        $userObj->firstname = $request->firstname;
        $userObj->lastname = $request->lastname;
        $userObj->gender = $request->gender;
        $userObj->email = $request->email;
        $userObj->password = bcrypt($request->password);
        $userObj->role = 'professional';
        $userObj->phone_number = $request->phone_number;
        $userObj->address = $request->address;
        $userObj->city = $request->city;
        $userObj->state = $request->state;
        $userObj->country = $request->country;
        $userObj->zipcode = $request->zipcode;
        $userObj->ein_number = $request->ein_number;
        $userObj->social_security_no = $request->social_security_no;
        $userObj->confirmation_code = Str::random(25);
        $userObj->activated = 0;
        $userObj->buddy_key = $postArr['password'];
		$userObj->profile_pic = $request->profile_pic;

        // get lat long
        $latlongdata = Miscellaneous::getLatLong($request->zipcode);
        $userObj->latitude = $latlongdata['lat'];
        $userObj->longitude= $latlongdata['long'];

        $userObj->status  = 'draft';

        if(isset($request->profile_pic) && $request->profile_pic != '') {
            // save new profile pic
            $userObj->profile_pic = $request->profile_pic;
        }

        if(!$userObj->save()) {
            return response()->json(['type'=>'danger','msg'=>'Some error has occured while registering user!','redirecturl'=>'/auth/registerProfessional']);
            //return redirect('/auth/registerProfessional');
        }else {
            //save blank entry into professional detail table
            $userProfileObj = New UserProfessionalDetail();
            $userProfileObj->user_id = $userObj->id;
            $userProfileObj->save();

            //send notification email to user
            // MailService::sendEmailReminder($userObj->id);
            MailService::sendEmailSignupVerification($userObj->id);
            //$request->session()->flash('alert-success', 'Thank you for registering with Fitnessity. Please verify your email address.');
            // Auth::loginUsingId($userObj->id);
            // return redirect('/profile/createProfile');
            // return redirect('/auth/registerBusiness');
            // return view::make('auth.verified_email')->with('user', $userObj);
            if(isset($userObj->confirmation_code) && !empty($userObj->confirmation_code)){
                //return redirect('/register/confirm/'.$userObj->confirmation_code);
                return response()->json(['type'=>'success','msg'=>'Thank you for registering with Fitnessity. Please verify your email address.','redirecturl'=>'/register/confirm/'.$userObj->confirmation_code]);
            } else {
                return response()->json(['type'=>'success','msg'=>'Thank you for registering with Fitnessity. Please verify your email address.','redirecturl'=>'/']);
            }
        }       
        
    }    

    public function verifyUserAccount(Request $request)
    {
      /*echo $request->confirmation_code;
      exit;*/
        if($request->confirmation_code && $request->confirmation_code != '' && $request->confirmation_code != NULL){

            $user = User::whereConfirmationCode($request->confirmation_code)->first();
            $c = $request->confirmation_code;
            if(!empty($user) > 0 && $user->activated == 0){
                if($user->role == 'business'){
                $user->confirmation_code = NULL;
                }
                $user->activated = 1;
                
                if($user->save()){

                    //Email Verified Acknowledgement
                    MailService::sendEmailVerifiedAcknowledgement($user->id);
                    //Login
                    // Auth::loginUsingId($user->id);
                    // $request->session()->flash('alert-success', 'Your email has been successfully verified. Please login to access Fitnessity.');
                    $s= Api::create_users($user);
                    Auth::login($user);
                    
                    Auth::loginUsingId($user->id, true);

                    if($user->role == 'business'){
                        $request->session()->flash('alert-success', 'Your email has been successfully verified. Please update your profile to help the customers find you in our search options.');
                        $user->show_step = 2;
                        $user->save();
                             return redirect('/?showstep=1'); 
                      // return redirect('/profile/editProfileHistory');
                     //  return redirect('/profile/viewProfile');

                    } else {
                         $user->show_step = 2;
                         $user->save();
                         $request->session()->flash('alert-success', 'Your email has been successfully verified!');
                         return redirect('/?showstep=1'); 
                      //  return redirect('/profile/editCustomerProfile/'.$c);
                        //return redirect('/profile/viewProfile');
                    }

                } else {
                    $request->session()->flash('alert-danger', 'Email verification failed. Please contact administrator.');
                    return redirect('/');
                }

            } else if($user->activated == 1 && $user->confirmation_code === "") {
                $request->session()->flash('alert-danger', 'Your email already verified. Please login to access Fitnessity.');
                return redirect('/?success=true');      
            } else {
                $request->session()->flash('alert-danger', 'Invalid verification code.');
                return redirect('/');
            }

        } else {
            $request->session()->flash('alert-danger', 'Invalid verification code.');
            return redirect('/');    
        }    
    }


    public function resendVerifyCode(Request $request)
    {
        $input = $request->all();

        if(isset($input) && !empty($input['user_id'])){
            $user = User::findOrFail($input['user_id']);
            
            if(!empty($user) ){
                
                if($user->confirmation_code && !empty($user->confirmation_code)){
                    MailService::resendEmailVerificationCode($user);
                    $response = array(
                        'type' => 'success',
                        'verified' => 'false',
                        'msg' => 'We have re-send verification email on your email address!',
                    );
                    return Response::json($response); exit();
                } else if($user->activated == 1 && empty($user->confirmation_code)) {
                    $response = array(
                        'type' => 'success',
                        'verified' => 'true',
                        'msg' => 'Your email already verified. Please login to access Fitnessity.',
                    );
                    return Response::json($response); exit();
                } else {
                    $response = array(
                        'type' => 'danger',
                        'verified' => 'false',
                        'msg' => 'Some error occure while resend email! Please try later.',
                    );
                    return Response::json($response); exit();
                }

            } else {
                    $response = array(
                        'type' => 'danger',
                        'verified' => 'false',
                        'msg' => 'Some error occure while resend email! Please try later.',
                    );
                    return Response::json($response); exit();
            }
        } else {
            $response = array(
                'type' => 'danger',
                'verified' => 'false',
                'msg' => 'Some error occure while resend email! Please try later.',
            );
            return Response::json($response); exit();
        }
    }

    public function getResendEmail($code){

        if(isset($code) && !empty($code)){

            $user = User::SELECT('id', 'email', 'activated')->where('confirmation_code', $code)->first();

            if(@count($user) > 0 && $user->activated == 1) {
                return redirect('/')->with('alert-success', 'Your account is already verified');
            } else if(@count($user) > 0 && $user->activated == 0){
                return view::make('auth.verified_email')->with('user', $user->toArray());
            }else{
                return redirect('/')->with('alert-danger', 'Confirmation code expired.');    
            }
        } else {
            return redirect('/')->with('alert-danger', 'Confirmation code expired.');
        }
    }

    public function test(){
        
    }
}