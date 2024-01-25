<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use ReCaptcha\ReCaptcha;
use Image;
//use Illuminate\Support\Facades\Input;
use Hash;
use Redirect;
use Response;
use Str;
use DB;
use App\Repositories\{UserRepository,ReviewRepository,SportsCategoriesRepository,SportsRepository,ProfessionalRepository};
use App\{Slider,SportsCategories,Cms,Sports,Trainer,Online,BusinessClaim,UserBookingDetail,Person,Discover,Miscellaneous,Languages,Api,MailService,User,BusinessServices,CompanyInformation,BusinessPriceDetails,BusinessService,BusinessCompanyDetail,BusinessActivityScheduler,HomeTracker,SGMailService,Customer};
use View;
use DateTime;

use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller {
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;
    public function __construct(UserRepository $users) {
        $this->users = $users;
    }
    public function index(Request $request) {
        $companyData = $servicePrice = $businessSpec = [];
        $serviceData = BusinessServices::where('instant_booking', 1)->get();
        if (isset($serviceData)) {
            foreach ($serviceData as $service) {
                $company = CompanyInformation::where('id', $service['cid'])->get();
                $company = isset($company[0]) ? $company[0] : [];
                if(!empty($company)) {
                	$companyData[$company['id']][] = $company;
                }
                
                $price = BusinessPriceDetails::where('cid', $service['cid'])->get();
                $price = isset($price[0]) ? $price[0] : [];
                if(!empty($company)) {
                	$servicePrice[$company['id']][] = $price;
                }
                
                $business_spec = BusinessService::where('cid', $service['cid'])->get();
                $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
                if(!empty($company)) {
                	$businessSpec[$company['id']][] = $business_spec;
                }
            }
        }
        $all_categories = SportsCategories::where('is_deleted', "0")->get();
        $most_searched_sports = Sports::orderBy('id','DESC')->get();
        $fitnessity_data = Cms::where('status', '1')
                        ->where('content_alias', 'fitnessity')->get();

        $bepart_data = Cms::where('status', '1')
                        ->where('content_alias', 'be_a_part')->first();
						
		$whyFitnessity = Cms::where('status', '1')
                        ->where('content_alias', 'about_us')->first();
		
        $sliders = Slider::get();
        $trainers = Trainer::limit(5)->get();
        $onlines = Online::limit(9)->get();
        $persons = Person::limit(9)->get();
        $discovers = Discover::limit(6)->get();
        $nxtact = BusinessServices::where('business_services.is_active', 1)->get();
        $current_date = new DateTime();
        $bookschedulers = BusinessActivityScheduler::next_8_hours($current_date)->whereIn('serviceid', $nxtact->pluck('id'))->limit(3)->get();
        return view('home.index1', [
            'serviceData' => $serviceData,
            'companyData' => $companyData,
            'servicePrice' => $servicePrice,
            'businessSpec' => $businessSpec,
            'sports_categories' => $all_categories,
            'sliders' => $sliders,
            'most_searched_sports' => $most_searched_sports,
            'fitnessity_data' => $fitnessity_data,
            'trainers' => $trainers,
            'onlines' => $onlines,
            'persons' => $persons,
            'discovers' => $discovers,
            'bepart_data' => $bepart_data,
			'whyFitnessity' => $whyFitnessity,
            'bookschedulers'=>$bookschedulers,
            'current_date' => $current_date,
        ]);
    }
    public function leftpanel() 
    {
        return view('profiles.leftPanel');

    }
	public function testleft (){
		return view('profiles.leftPanel');
	}
    public function all_trainings() {
        /* $all_categories = $this->sports_cat->getAllSportsCategories();

          $most_searched_sports = Sports::get();

          $fitnessity_data = Cms::where('status','1')
          ->where('content_alias','fitnessity')->get();

          $sliders = Slider::get();

          $trainers = Trainer::limit(5)->get();
          $onlines = Online::limit(9)->get();
          $persons = Person::limit(9)->get();
          $discovers = Discover::limit(3)->get();

          $count_trainer = Trainer::count();
          $count_online = Online::count();
          $count_business = BusinessClaim::count();
          $count_userbooking = UserBookingDetail::count(); */

        return view('home.allTrainings');
    }
    public function all_sports() {
        /* $all_categories = $this->sports_cat->getAllSportsCategories();

          $most_searched_sports = Sports::get();

          $fitnessity_data = Cms::where('status','1')
          ->where('content_alias','fitnessity')->get();

          $sliders = Slider::get();

          $trainers = Trainer::limit(5)->get();
          $onlines = Online::limit(9)->get();
          $persons = Person::limit(9)->get();
          $discovers = Discover::limit(3)->get();

          $count_trainer = Trainer::count();
          $count_online = Online::count();
          $count_business = BusinessClaim::count();
          $count_userbooking = UserBookingDetail::count(); */

        return view('home.allSports');
    }

    public function registration(Request $request,$id = null) {
        $intent = null;
        if (Auth::check()) {
            $show_step = Auth::user()->show_step;
            $user =Auth::user();
            if($request->showstep == 7){
                $user->show_step = 7;
                $user->save();
            }
            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            if($user->stripe_customer_id != ''){
                $intent = $stripe->setupIntents->create([
                    'payment_method_types' => ['card'],
                    'customer' => $user->stripe_customer_id,
                ]);
            }
        } else {
            $show_step = 1;
        }
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        if($id != '' && $id != '7'){
            $id = Crypt::decryptString($id);
        }
        return view('home.registration', [
            'show_step' => $show_step,
            'cart' => $cart,
            'customerId'=>$id,
            'intent'=>$intent
        ]);
    }
    public function emailvalidation(Request $request) {
        $postArr = $request->all();

         $rules = [
            'email' => 'required|unique:users',
        ];

         $validator = Validator::make($postArr, $rules);
        if ($validator->fails()) {
            $errMsg = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            return Response::json($response);
        }

    }

    public function userNamevalidation(Request $request) {
        $postArr = $request->all();
        $business = CompanyInformation::where('business_user_tag' ,$request->userName)->first();
        if($business){
            $response = array(
                'type' => 'danger',
                'msg' => 'User name is already taken by another provider.',
            );
            return Response::json($response);
        }
    }

    public function postRegistration(Request $request) {
        $postArr = $request->all();
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'username' => 'unique:users'
        ];

        $validator = Validator::make($postArr, $rules);
        if ($validator->fails()) {
            $errMsg = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            return Response::json($response);
        } else {
            //check for unique email id
            if (!$this->users->validateUser($postArr['email'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Email already exists. Please select different Email',
                );
                return Response::json($response);
            };
            //check for unique user name
            if (!$this->users->validateUser($postArr['username'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'User name already exists. Please select different Name',
                );
                return Response::json($response);
                //print_r("usefdhfidjhgidfhuighdfb");die;
            };

            if (count($postArr) > 0) {

                \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

                $last_name = ($postArr['lastname']) ? $postArr['lastname'] : '';
                $cus_name = $postArr['firstname'].' '.$last_name;
                $customer = \Stripe\Customer::create(
                    [
                        'name' => $cus_name,
                        'email'=> $postArr['email'],
                    ]);
                $stripe_customer_id = $customer->id;
                $userObj = New User();
                $userObj->firstname = $postArr['firstname'];
                $userObj->lastname = ($postArr['lastname']) ? $postArr['lastname'] : '';
                $userObj->username = $postArr['username'];
                $userObj->password = Hash::make(str_replace(' ', '', $postArr['password']));
                $userObj->primary_account = $postArr['primary_account'] ?? 0;
                $userObj->email = $postArr['email'];
                $userObj->stripe_customer_id = $stripe_customer_id;
                $userObj->role = 'customer';
                $userObj->country = 'US';
                $userObj->activated = 0;
                $userObj->phone_number = $postArr['contact'];
                $userObj->birthdate = date("Y-m-d", strtotime($postArr['dob']));
                // $userObj->last_ip = '192.168.0.0';
                // $userObj->status = "email_activation_pending";
                $userObj->status = "approved";
                $userObj->buddy_key = $postArr['password'];
                $userObj->isguestuser = 0;

                //For signup confirmation 
                $userObj->confirmation_code = Str::random(25);
                $userObj->save();

                if($request->customerId != ''){
                    Customer::where('id',$request->customerId)->update(['user_id'=>$userObj->id]);
                }

                if ($userObj) {                    
                    //send notification email to user
                    // MailService::sendEmailReminder($userObj->id);
                    MailService::sendEmailSignupVerification($userObj->id);

                    $url = "/";
                    if (isset($userObj->confirmation_code) && !empty($userObj->confirmation_code)) {
                        $url = '/register/confirm/' . $userObj->confirmation_code;
                    }

                    $response = array(
                        'type' => 'success',
                        'msg' => 'Thank you for registering with Fitnessity. Please verify your email address.',
                        'redirecturl' => $url,
                    );

                    return Response::json($response);
                } else {

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

    public function ResendEmail($code) {

        if (isset($code) && !empty($code)) {

            $user = User::SELECT('id', 'email', 'activated')->where('confirmation_code', $code)->first();
            if (@count($user) > 0 && $user->activated == 1) {
                return redirect('/')->with('alert-success', 'Your account is already verified');
            } else if (@count($user) > 0 && $user->activated == 0) {
                return view::make('home.verified_email')->with('user', $user->toArray());
            } else {
                return redirect('/')->with('alert-danger', 'Confirmation code expired.');
            }
        } else {
            return redirect('/')->with('alert-danger', 'Confirmation code expired.');
        }
    }

    public function UserAccountVerify(Request $request) {
        if ($request->confirmation_code && $request->confirmation_code != '' && $request->confirmation_code != NULL) {
            $user = User::whereConfirmationCode($request->confirmation_code)->first();
            if (!empty($user) > 0 && $user->activated == 0) {
                $user->activated = 1;
                $user->show_step = 2;
                if ($user->save()) {
                    // MailService::sendEmailVerifiedAcknowledgement($user->id);
                    SGMailService::sendWelcomeMail($user->email);
                    Auth::login($user);
                    Auth::loginUsingId($user->id, true);
                    $request->session()->flash('alert-success', 'Your email has been successfully verified!');
                    return redirect('auth/jsModalregister');
                } else {
                    $request->session()->flash('alert-danger', 'Email verification failed. Please contact administrator.');
                    return redirect('/registration');
                }
            } elseif ($user->activated == 1) {
                $request->session()->flash('alert-danger', 'Your email already verified. Please login to access Fitnessity.');
                return redirect('/?success=true');
            } else {
                $request->session()->flash('alert-danger', 'Invalid verification code.');
                return redirect('/registration');
            }
        } else {
            $request->session()->flash('alert-danger', 'Invalid verification code.');
            return redirect('/registration');
        }
    }

    public function VerifyCodeResend(Request $request) {
        $input = $request->all();
        if (isset($input) && !empty($input['user_id'])) {
            $user = User::findOrFail($input['user_id']);

            if (!empty($user)) {
                if ($user->confirmation_code && !empty($user->confirmation_code)) {
                    MailService::resendEmailVerificationCode($user);
                    $response = array(
                        'type' => 'success',
                        'verified' => 'false',
                        'msg' => 'We have re-send verification email on your email address!',
                    );
                    return Response::json($response);
                    exit();
                } else if ($user->activated == 1 && empty($user->confirmation_code)) {
                    $response = array(
                        'type' => 'success',
                        'verified' => 'true',
                        'msg' => 'Your email already verified. Please login to access Fitnessity.',
                    );
                    return Response::json($response);
                    exit();
                } else {
                    $response = array(
                        'type' => 'danger',
                        'verified' => 'false',
                        'msg' => 'Some error occure while resend email! Please try later.',
                    );
                    return Response::json($response);
                    exit();
                }
            } else {
                $response = array(
                    'type' => 'danger',
                    'verified' => 'false',
                    'msg' => 'Some error occure while resend email! Please try later.',
                );
                return Response::json($response);
                exit();
            }
        } else {
            $response = array(
                'type' => 'danger',
                'verified' => 'false',
                'msg' => 'Some error occure while resend email! Please try later.',
            );
            return Response::json($response);
            exit();
        }
    }
}
