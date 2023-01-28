<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\CompanyInformation;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Customers_Auth\HomeController;


Route::name('business.')->prefix('/business/{business_id}')->namespace('Business')->middleware('auth', 'business_scope')->group(function () {

    // Scheduler
    Route::get('schedulers/delete_modal', 'SchedulerController@delete_modal')->name('schedulers.delete_modal');
    Route::resource('schedulers', 'SchedulerController')->only(['index', 'destroy']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('/business/{business_id}')->group(function () {
        Route::get('/customers','CustomerController@index')->name('business_customer_index');
        Route::delete('/customers/{id}','CustomerController@delete')->name('business_customer_delete');
        Route::get('/customers/{id}','CustomerController@show')->name('business_customer_show');
        Route::get('/customers/{id}/activity_visits','CustomerController@activity_visits')->name('business_customer_activity_visits');

        // Services
        Route::get('/services', 'UserProfileController@manageService')->name('manageService');

        // BookingPostorders
        Route::post('/booking_postorders','BookingPostorderController@create')->name('business_booking_postorders_create');
        Route::delete('/booking_postorders/{booking_postorder_id}','BookingPostorderController@delete')->name('business_booking_postorders_delete');

        // Booking Checkin Details
        Route::get('/scheduler/{business_activity_scheduler_id}/checkin_details', 'SchedulerController@checkin_details')->name('booking_checkin_details_index');

        Route::get('/createStaff','StaffController@createmanageStaff')->name('createStaff');
        Route::get('/staff-scheduled-activities','StaffController@staff_scheduled_activities')->name('staff-scheduled-activities');
    });
});





Route::get('/addcheckoutsession','HomeController@addcheckoutsession')->name('addcheckoutsession');
Route::get('/senddummymail','HomeController@senddummymail')->name('senddummymail');


Route::get('pricedetails','UserProfileController@pricedetails')->name('pricedetails');
Route::get('/set-unset-session-business-welcome/{check?}','HomeController@set_unset_session_business_welcome');
Route::get('/set-session-for-claim/{cid?}/{status?}','HomeController@set_session_for_claim');
Route::get('/set-session-for-managecompany','HomeController@set_session');

Route::get('spotify','UserProfileController@spotify')->name('spotify');
Route::get('about','UserProfileController@about')->name('about');

Route::get('sendmail','UserProfileController@sendmail')->name('sendmail');

/*Route::get('{user_name}','UserProfileController@profileDetailPage');*/
Route::get('profileDetail/{user_id}','UserProfileController@profileDetail')->name('profileDetail');
Route::post('profileView','UserProfileController@profileView')->name('profileView');
Route::get('userprofile/{user_name}','UserProfileController@viewuserpersonalprofile')->name('userprofile');

Route::get('signupVerification','UserProfileController@signupVerification')->name('signupVerification');
Route::get('createNewBusinessProfile/{cid?}','UserProfileController@createNewBusinessProfile')->name('createNewBusinessProfile');
Route::get('businesspricedetails/{catid?}','UserProfileController@businesspricedetails')->name('businesspricedetails');
Route::post('editBusinessProfile','UserProfileController@editBusinessProfile')->name('editBusinessProfile');
Route::post('editBusinessService','UserProfileController@editBusinessService')->name('editBusinessService');
/*Route::get('business/welcome','UserProfileController@welcomeBusinessProfile')->name('welcomeBusinessProfile');*/ //nnn its showing database connection error


Route::get('business-welcome','UserProfileController@welcomeBusinessProfile')->name('business-welcome');

Route::get('business/company','UserProfileController@companyBusinessProfile')->name('companyBusinessProfile');
Route::get('business/experience','UserProfileController@experienceBusinessProfile')->name('experienceBusinessProfile');
Route::get('business/specification','UserProfileController@specificationBusinessProfile')->name('specificationBusinessProfile');
Route::get('business/terms','UserProfileController@termsBusinessProfile')->name('termsBusinessProfile');
Route::get('business/verified','UserProfileController@verifiedBusinessProfile')->name('verifiedBusinessProfile');
Route::get('business/services','UserProfileController@servicesBusinessProfile')->name('servicesBusinessProfile');
Route::get('business/booking','UserProfileController@bookingBusinessProfile')->name('bookingBusinessProfile');

Route::get('businessjumps/{bstep?}/{cid?}','UserProfileController@businessJumps')->name('businessjumps');
Route::post('addbstep','UserProfileController@addbstep')->name('addbstep');

Route::post('addbusinesscompanydetail','UserProfileController@addbusinesscompanydetail')->name('addbusinesscompanydetail');
Route::match(['get','post'],'addbusinessexperience','UserProfileController@addbusinessexperience')->name('addbusinessexperience');
Route::post('addbusinessspecification','UserProfileController@addbusinessspecification')->name('addbusinessspecification');
Route::post('addbusinessterms','UserProfileController@addbusinessterms')->name('addbusinessterms');
Route::post('addbusinessverification','UserProfileController@addbusinessverification')->name('addbusinessverification');
Route::post('addbusinessservices','UserProfileController@addbusinessservices')->name('addbusinessservices');
Route::post('addbusinessschedule','UserProfileController@addbusinessschedule')->name('addbusinessschedule');
Route::post('addbusinessbooking','UserProfileController@addbusinessbooking')->name('addbusinessbooking');
Route::get('send-sms-twillio','UserProfileController@sendCustomMessage');
Route::get('send-call-twillio','UserProfileController@makeCall');
Route::post('generateMessage/{otpCode}', 'UserProfileController@generateVoiceMessage')->name('generateMessage');
Route::post('modelboxsuccess', 'UserProfileController@modelboxsuccess')->name('modelboxsuccess');
Route::post('delimageactivity', 'UserProfileController@delimageactivity')->name('delimageactivity');
Route::get('editactivityimg', 'UserProfileController@editactivityimg')->name('editactivityimg');
Route::post('activityimgupdate', 'UserProfileController@activityimgupdate')->name('activityimgupdate');

Route::get('make-new-logout',function(){
    if(Auth::check()){
        Auth::logout();
    }
    return 1;
});

Route::get('/blade-check1',function(){
    return view('home.mycheck');
});

Route::get('/claim/reminder/{cname?}/{cid?}','UserProfileController@claim_reminder');

Route::get('/unset-session-for-claim','UserProfileController@unset_session_for_claim');

Route::any('/varify-code-to-claim-business','UserProfileController@varify_code_to_claim_business')->name('varify_code_to_claim_business');

Route::any('/varify-email-for-claim-business','UserProfileController@varify_email_for_claim_business')->name('varify_email_for_claim_business');

Route::any('/business-claim-varification/{cid}','UserProfileController@business_claim_varification')->name('business_claim_varification');

Route::any('/blade-check/{company_id}','UserProfileController@getBladeDetail1')->name('companypage');
Route::any('/already-claim-business','HomeController@already_claim_business')->name('already_claim_business');

Route::get('/blade-new-check/{company_id}','UserProfileController@getBladeDetail');
Route::post('ckeditor/upload', 'Admin\HelpController@upload')->name('ckeditor.upload');
Route::get('get-my-location/{myloc}','UserProfileController@getBusinessClaim');
Route::get('get-business-detail/{valueid}','UserProfileController@getBusinessClaimDetaill');
Route::get('get-my-location-business','UserProfileController@getLocationBusinessClaimDetaill');
Route::get('claim-your-business','UserProfileController@businessClaim')->name('businessClaim');
Route::get('claim-your-business-detail/{cid}','UserProfileController@showbusinessClaimDetail');
Route::post('make-verify-busiess-link','UserProfileController@SendVerificationlink');
Route::post('make-verify-busiess-link-via-phone-msg','UserProfileController@SendVerificationlinkMsg');
Route::post('make-otp-busiess-link-via-sms','UserProfileController@makeOTPMsg');
Route::post('addinstantHire','UserProfileController@addinstantHire')->name('addinstantHire');
Route::post('make-verify-busiess-link-via-phone-call','UserProfileController@SendVerificationlinkCall');
Route::get('verify-my-business/reset','UserProfileController@VerifySendVerificationlink');
Route::get('delete-image-company','UserProfileController@deleteImageCompany');
Route::get('delete-image-user','UserProfileController@deleteImageCompany1');
Route::get('delete-image-gallery','UserProfileController@deleteImageGallery');
Route::get('set-cover-photo','UserProfileController@setCoverPhoto');
Route::get('unset-cover-photo','UserProfileController@unsetCoverPhoto');
Route::get('search-result-location','UserProfileController@searchResultLocation');
Route::get('search-result-location1','UserProfileController@searchResultLocation1');

Route::get('/filter', 'HomeController@getFilter');
Route::get('/new-fun', 'UserProfileController@newFUn');

View::composer(['*'],function($view){
    if(Auth::check()){
        $count = CompanyInformation::where('user_id',Auth::user()->id)->count();
        $view->with('company_count',$count);
    }	
});


Route::get('/check',function(){
   $show_step = 1;
   return view('home.registration',compact('show_step'));
});


Route::post('/auth/postRegistration_as_guest', 'ActivityController@postRegistration_as_guest')->name('auth/postRegistration_as_guest');
Route::get('/', 'Frontend\HomeController@index')->name('homepage');
Route::get('/home', 'Frontend\HomeController@index')->name('homemy');
Route::get('/testleft', 'Frontend\HomeController@testleft')->name('testleft');
Route::get('/leftpanel', 'Frontend\HomeController@leftpanel')->name('leftpanel');
Route::get('/new-register', 'Auth\AuthController@newRegister');
Route::post('/auth/uploadProfile', 'Auth\AuthController@uploadProfile111');
Route::get('/all-trainings', 'Frontend\HomeController@all_trainings');
Route::get('/all-sports', 'Frontend\HomeController@all_sports');
Route::get('/registration', 'Frontend\HomeController@registration')->name('registration');
Route::get('emailvalidation', 'Frontend\HomeController@emailvalidation')->name('emailvalidation');

Route::post('/auth/registration', 'Frontend\HomeController@postRegistration')->name('auth/registration');
Route::post('/user/resendverify', 'Frontend\HomeController@VerifyCodeResend');
Route::get('registration/confirm/{confirmation_code}', 'Frontend\HomeController@ResendEmail');
Route::get('verifyuser/{confirmation_code}', 'Frontend\HomeController@UserAccountVerify');
Route::get('/userlogin', 'Frontend\LoginController@index')->name('userlogin');
Route::post('auth/userlogin', 'Frontend\LoginController@postLogin')->name('auth/userlogin');
Route::get('/userlogout', 'Frontend\LoginController@logout');

// Auth::routes();
Route::any('logout', function (Request $request) {
    Auth::logout();
    return redirect('/');
});


Route::post('searchbussinessaction','HomeController@searchbussinessaction');
Route::post('searchaction','HomeController@searchaction');
Route::post('searchactioncity','HomeController@searchactioncity');
Route::post('searchactionlocation','HomeController@searchactionlocation');
Route::post('searchactionactivity','HomeController@searchactionactivity');
Route::get('/profile/editCustomerProfile/{user_id}','UserProfileController@familyProfileUpdate');
Route::post('/submit-family-form','UserProfileController@submitFamilyForm');
Route::post('/submit-family-form1','UserProfileController@submitFamilyForm1');
Route::post('/skip-family-form1','UserProfileController@skipFamilyForm1');
Route::post('/submit-family-form-with-skip','UserProfileController@submitFamilyFormWithSkip');
Route::get('/join/{id}/{user_id?}','ZoomController@index')->name('call');
Route::group(['middleware' => ['auth']], function()
{
	Route::get('/createmeeting','ZoomController@createmeeting');
	Route::get('/oncall/{mid}','ZoomController@oncall')->name('oncall');
	Route::post('/store','ZoomController@store')->name('store');
	Route::post('/invite','ZoomController@invite')->name('invite');
    Route::any('/addcustomerbusiness', 'BusinessController@addbusinesscustomer')->name('addbusinesscustomer');
    Route::post('/add_business_customer', 'BusinessController@add_business_customer')->name('add_business_customer');
});


// Activitys
Route::get('/activities/get_started/personal_trainer','ActivityController@personal_trainer')->name('get_started_personal_trainer');
Route::get('/activities/get_started/ways_to_workout','ActivityController@ways_to_workout')->name('get_started_ways_to_workout');
Route::get('/activities/get_started/experiences','ActivityController@experiences')->name('get_started_activities_experiences');
Route::get('/activities/get_started/events','ActivityController@events')->name('get_started_activities_events');
Route::get('/activities/classes','ActivityController@classes')->name('activities_classes');
Route::get('/activities/next_8_hours','ActivityController@next_8_hours')->name('activities_next_8_hours');
Route::any('/activities/{filtervalue?}','ActivityController@index')->name('activities_index');

Route::any('/activity-details/{serviceid}', 'ActivityController@show')->name('activities_show');


Route::post('pricecategory', 'ActivityController@pricecategory')->name('pricecategory');
Route::post('pricemember', 'ActivityController@pricemember')->name('pricemember');
Route::get('/getCompareProfessionalDetails/{id}', 'ActivityController@getCompareProfessionalDetailInstant');
Route::post('/act_detail_filter', 'ActivityController@act_detail_filter')->name('act_detail_filter');
Route::post('/act_detail_filter_for_cart', 'ActivityController@act_detail_filter_for_cart')->name('act_detail_filter_for_cart');
Route::post('/getmodelbody', 'ActivityController@getmodelbody')->name('getmodelbody');
Route::post('/load-data', 'ActivityController@loadMoreData')->name('load-data');

/* 09-june 2020 */
Route::get('/getactivitychoice/{userid}/{ser_id}','LessonController@getactivity')->name('activitychoice');
Route::get('/cart','LessonController@getcart');
Route::get('/deletecart/{id}/{bid}','LessonController@deletecart');
Route::get('/addnote/{b}/{n}','LessonController@addnote');
Route::get('/pay','LessonController@pay');
Route::get('/payment/{token}','LessonController@payment');
Route::get('/editcart/{bkid}/{cid}/{user_id}','LessonController@editcart');
Route::get('/savetime/{u}/{t}','LessonController@times');
Route::get('/get-booking-service-data','LessonController@getBookingServiceData');
Route::post('/savetimes','LessonController@savetime');
Route::post('/updatecart','LessonController@updatecart');
Route::post('/samfilter','LessonController@samfilter')->name('samfilter');

/* 09-june 2020 end */
Route::get('/allSports', 'HomeController@allSports')->name('list-all-sports');
Route::get('home/jsModalChildSports/{id}', 'HomeController@jsModalChildSports');
Route::group(array('prefix' => 'admin'), function(){

    // Inquiry Box

    Route::get('/inquiry', 'Admin\AdminUserController@inquiry')->name('inquiry');
    Route::get('/inquirydelete/{id}', 'Admin\AdminUserController@inquirydelete')->name('inquirydelete');
    Route::get('/contact-us', 'Admin\AdminUserController@contactus')->name('contact-us');
    Route::get('/contactdelete/{id}', 'Admin\AdminUserController@contactdelete')->name('contactdelete');
    
    Route::get('/', 'Admin\AdminAuthController@index');
    Route::post('/login', 'Admin\AdminAuthController@PostLogin');
    Route::get('/register', 'Admin\AdminAuthController@GetRegister');
    Route::post('/register', 'Admin\AdminAuthController@PostRegister');	
    Route::get('/background_check_faq','Admin\CheckFaqController@index')->name('background_check_faq');
    Route::get('/add_new_background_check_faq','Admin\CheckFaqController@create')->name('background_check_faq-add');
    Route::post('/background_check_faq_store','Admin\CheckFaqController@store')->name('background_check_faq_create');
    Route::post('/background_check_faq_update','Admin\CheckFaqController@update')->name('background_check_faq_update');
    Route::get('/background_check_faq_view/{id}','Admin\CheckFaqController@view')->name('background_check_faq_view');
    Route::get('/delete_background_check_faq/{id}','Admin\CheckFaqController@delete')->name('background_check_faq_delete');
    Route::get('/vatted_business_faq','Admin\BusinessFaqController@index')->name('vatted_business_faq');
    Route::get('/add_new_vatted_business_faq','Admin\BusinessFaqController@create')->name('vatted_business_faq-add');
    Route::post('/vatted_business_faq_store','Admin\BusinessFaqController@store')->name('vatted_business_faq_create');
    Route::post('/vatted_business_faq_update','Admin\BusinessFaqController@update')->name('vatted_business_faq_update');
    Route::get('/vatted_business_faq_view/{id}','Admin\BusinessFaqController@view')->name('vatted_business_faq_view');
    Route::get('/delete_vatted_business_faq/{id}','Admin\BusinessFaqController@delete')->name('vatted_business_faq_delete');


    //forgot password routes
    Route::get('/forgotpassword', 'Admin\AdminAuthController@GetForgotpassword');  
    Route::get('/dashboard', 'Admin\AdminUserController@index');
    Route::get('/profile/editprofiledetail', 'Admin\AdminProfileController@viewProfile');
    Route::post('/profile/editprofiledetail', 'Admin\AdminProfileController@editProfileDetail');
    Route::post('/profile/editProfilePicture', 'Admin\AdminProfileController@editProfilePicture');

    //Home tracker
    Route::get('/hometracker', 'Admin\HomeTrackerController@index')->name('hometracker');
    Route::post('/update-hometracker', 'Admin\HomeTrackerController@update')->name('update-hometracker');


    //cms
    Route::get('/cms', 'Admin\CmsController@listCmsModules');
    Route::get('/cms/edit/{id}', 'Admin\CmsController@viewCmsModule');  
    Route::post('/cms/edit/{id}', 'Admin\CmsController@postCmsModule');  

    //Manage Customers
    Route::get('/customers', 'Admin\AdminUserController@viewCustomers');
    Route::post('/customers', 'Admin\AdminUserController@postCustomers');
    Route::get('/customers/{id}/login_as', 'Admin\AdminUserController@login_as')->name('admin_user_login_as');
    Route::get('/customers/edit/{id}', 'Admin\AdminUserController@getCustomerDetails');
    Route::get('/customers/view/{id}', 'Admin\AdminUserController@viewCustomerDetails');
    Route::post('/customers/edit/{id}', 'Admin\AdminUserController@postCustomerDetails');
    Route::get('/customers/delete/{id}', 'Admin\AdminUserController@deleteCustomer');
    Route::get('/customers/deactivate/{id}', 'Admin\AdminUserController@deactivateCustomer');

    //reportedfeeds
    Route::get('/reportedfeeds', 'Admin\ReportedFeedsController@index')->name('reportedfeed-list');
    Route::get('/reportedfeeds/view/{id}', 'Admin\ReportedFeedsController@view');
    Route::post('/reportedfeeds/delete-reportedfeed', 'Admin\ReportedFeedsController@delete')->name('delete-reportedfeed');  
    Route::post('/reportedfeeds/deleteAll', 'Admin\ReportedFeedsController@deleteAll')->name('delete-reportedfeeds');
    Route::post('/reportedfeeds/allow-reportedfeed', 'Admin\ReportedFeedsController@allowFeed')->name('allow-reportedfeed');

    // add services

    Route::post('/add_services','Admin\PlansController@add_services')->name('add_services'); 

    //unclaim edit and manual add and add activity, list activity

    Route::get('/add_activity/{id}','Admin\PlansController@add_activity')->name('add_activity'); 
    Route::get('/edit_services/{sid}/{cid}','Admin\PlansController@edit_services')->name('edit_services'); 
    Route::post('/update_services','Admin\PlansController@update_services')->name('update_services'); 

    Route::get('/manage/service/{id}','Admin\PlansController@list_activity')->name('list_activity'); 
    Route::post('/editBusinessServiceadmin','Admin\PlansController@editBusinessServiceadmin')->name('editBusinessServiceadmin'); 
    Route::post('add_manual', 'Admin\PlansController@add_manual')->name('add_manual'); 
    Route::get('/manual_add_unclaim_business', 'Admin\PlansController@manual_add_unclaim_business')->name('manual_add_unclaim_business');

    Route::get('/edit_unclaim/{id}', 'Admin\PlansController@edit_unclaim')->name('edit_unclaim');

    Route::post('/unclaim/edit', 'Admin\PlansController@update_unclaim')->name('update_unclaim'); 
    Route::get('businesspricedetails/{catid?}','Admin\PlansController@admin_businesspricedetails')->name('admin_businesspricedetails');
    Route::post('adminaddbusinessschedule','Admin\PlansController@adminaddbusinessschedule')->name('adminaddbusinessschedule');

    //plans
    Route::get('/plans/membership-plan', 'Admin\PlansController@index')->name('plan-list');
    Route::get('/plans/create', 'Admin\PlansController@create')->name('create-new-membership-plan');  
    Route::get('/plans/edit/{id}', 'Admin\PlansController@edit');  
    Route::post('/plans/update/{id}', 'Admin\PlansController@update')->name('update-plan');   
    Route::post('/plans/store', 'Admin\PlansController@store')->name('create-plan');  
    Route::DELETE('/plans/delete-plan', 'Admin\PlansController@delete')->name('delete-plan');  
    Route::post('/plans/deactivate-plan', 'Admin\PlansController@deactivate')->name('deactivate-plan'); 
    Route::post('/plans/activate-plan', 'Admin\PlansController@activate')->name('activate-plan'); 
    Route::post('/plans/deleteAll', 'Admin\PlansController@deleteAll')->name('delete-plans');

	//fees
	Route::get('/fees', 'Admin\FeesController@index')->name('fees');
	Route::post('/update-fees', 'Admin\FeesController@update')->name('update-fees');

    // Slider
    Route::get('/slider', 'Frontend\SliderController@index')->name('slider');
    Route::get('/slider/create', 'Frontend\SliderController@create')->name('create-new-slider'); 
    Route::post('/slider/store', 'Frontend\SliderController@store')->name('create-slider');
    Route::DELETE('/slider/delete-slider', 'Frontend\SliderController@delete')->name('delete-slider');
    Route::get('/slider/edit/{id}', 'Frontend\SliderController@edit');
    Route::post('/slider/update/{id}', 'Frontend\SliderController@update')->name('update-slider'); 
    Route::get('/slider/delete/{id}', 'Frontend\SliderController@delete');

	

    // Post
    Route::get('/post', 'Frontend\PostController@index')->name('admin/post');

    //Trainer
    Route::get('/trainer', 'Frontend\TrainerController@index')->name('trainer');
    Route::get('/trainer/create', 'Frontend\TrainerController@create')->name('create-new-trainer');
    Route::post('/trainer/store', 'Frontend\TrainerController@store')->name('create-trainer'); 
    Route::DELETE('/trainer/delete-trainer', 'Frontend\TrainerController@delete')->name('delete-trainers');
    Route::get('/trainer/edit/{id}', 'Frontend\TrainerController@edit');
    Route::post('/trainer/update/{id}', 'Frontend\TrainerController@update')->name('update-trainer'); 
    Route::get('/trainer/delete/{id}', 'Frontend\TrainerController@delete');

    // Online classes and activities
    Route::get('/online', 'Frontend\OnlineController@index')->name('online');
    Route::get('/online/create', 'Frontend\OnlineController@create')->name('create-new-online'); 
    Route::post('/online/store', 'Frontend\OnlineController@store')->name('create-online');
    Route::DELETE('/online/delete-online', 'Frontend\OnlineController@delete')->name('delete-online');
    Route::get('/online/edit/{id}', 'Frontend\OnlineController@edit');
    Route::post('/online/update/{id}', 'Frontend\OnlineController@update')->name('update-online'); 
    Route::get('/online/delete/{id}', 'Frontend\OnlineController@delete');

    // Person classes and activities
    Route::get('/person', 'Frontend\PersonController@index')->name('person');
    Route::get('/person/create', 'Frontend\PersonController@create')->name('create-new-person'); 
    Route::post('/person/store', 'Frontend\PersonController@store')->name('create-person');
    Route::DELETE('/person/delete-person', 'Frontend\PersonController@delete')->name('delete-person');
    Route::get('/person/edit/{id}', 'Frontend\PersonController@edit');
    Route::post('/person/update/{id}', 'Frontend\PersonController@update')->name('update-person'); 
    Route::get('/person/delete/{id}', 'Frontend\PersonController@delete');

    //Trainer
    Route::get('/discover', 'Frontend\DiscoverController@index')->name('discover');
    Route::get('/discover/create', 'Frontend\DiscoverController@create')->name('create-new-discover');
    Route::post('/discover/store', 'Frontend\DiscoverController@store')->name('create-discover'); 
    Route::DELETE('/discover/delete-trainer', 'Frontend\DiscoverController@delete')->name('delete-discovers');
    Route::get('/discover/edit/{id}', 'Frontend\DiscoverController@edit');
    Route::post('/discover/update/{id}', 'Frontend\DiscoverController@update')->name('update-discover'); 
    Route::get('/discover/delete/{id}', 'Frontend\DiscoverController@delete');

    Route::get('/unclaimbusiness', 'Admin\PlansController@businessUnclaim')->name('businessUnclaim');
    Route::get('/claimbusiness', 'Admin\PlansController@businessClaim')->name('adminbusinessClaim');
    Route::get('/delete_claim/{id}','Admin\PlansController@deleteClaim')->name('claim_delete');
    Route::post('/import-claimbusiness', 'Admin\PlansController@addBusinessClaim');
    Route::post('/ignore-replace-claimbusiness', 'Admin\PlansController@ignoreReplaceBusinessClaim');
	Route::get('/business_delete/{id}','Admin\PlansController@business_delete')->name('business_delete');
    Route::get('/sendemail/{cid?}','Admin\PlansController@sendemail')->name('sendemail');

    //Feedbacks
    Route::get('/feedbacks', 'Admin\FeedbackController@index');
    Route::get('/feedbacks/view/{id}', 'Admin\FeedbackController@viewFeedback');

    //Booking
    Route::get('/bookings', 'Admin\BookingController@index');
    Route::get('/bookings/directHireDetails/{id}', 'Admin\BookingController@directHireDetails');
    Route::get('/bookings/quickHireDetails/{id}', 'Admin\BookingController@quickHireDetails');

    //Professionals Controller
    Route::get('/professionals', 'Admin\AdminProfessionalsController@index')->name('professionals-list');
    Route::post('/professionals', 'Admin\AdminProfessionalsController@postProfessionals');
    Route::get('/professionals/view/{id}', 'Admin\AdminProfessionalsController@view')->name('professionals-view');
    Route::post('/professionals/deleteAll', 'Admin\AdminProfessionalsController@deleteAll')->name('delete-professionals');
    Route::post('/professionals/approve-professional', 'Admin\AdminProfessionalsController@Approve')->name('approve-professional');

    // Business user

    //Professionals Controller
    Route::get('/businessusers', 'Admin\AdminBusinessController@index')->name('professionals-list');
    Route::post('/businessusers', 'Admin\AdminBusinessController@postProfessionals');
    Route::get('/businessusers/view/{id}', 'Admin\AdminBusinessController@view')->name('professionals-view');
    Route::post('/businessusers/deleteAll', 'Admin\AdminBusinessController@deleteAll')->name('delete-professionals');
    Route::post('/businessusers/approve-professional', 'Admin\AdminBusinessController@Approve')->name('approve-professional');

    // Professional Reject with Reason
    Route::post('/professionals/reject-professional', 'Admin\AdminProfessionalsController@rejectProfessional')->name('reject-professional'); 

    // Business user Reject with Reason
    Route::post('/businessusers/reject-professional', 'Admin\AdminBusinessController@rejectProfessional')->name('reject-professional');   

    //Sports
    Route::get('/sports', 'Admin\SportsController@index')->name('sports-list');
    Route::get('/sports/create', 'Admin\SportsController@create')->name('create-new-sport');  
    Route::post('/sports/store', 'Admin\SportsController@store')->name('store-new-sport'); 
    Route::post('/sports/deactivate-sport', 'Admin\SportsController@deactivate')->name('deactivate-sport');
    Route::post('/sports/activate-sport', 'Admin\SportsController@activate')->name('activate-sport');
    Route::get('/sports/edit/{id}', 'Admin\SportsController@getEdit')->name('get-edit-sport');
    Route::post('/sports/edit/{id}', 'Admin\SportsController@postEdit')->name('post-edit-sport');  
    Route::post('/sports/sports-ajax-get-list', 'Admin\SportsController@getAjaxSportListFromCat')->name('sports-ajax-get-list');
    Route::post('/happening/happening-now-ajax-get-list', 'Admin\SportsController@getAjaxHappeningNow')->name('happening-now-ajax-get-list');

    // Newsletters
    Route::get('/newsletters', 'Admin\NewsletterController@index')->name('newsletters-list');
    Route::post('/newsletters', 'Admin\NewsletterController@postNewsletter');
    Route::get('/newsletters/delete/{id}', 'Admin\NewsletterController@delete');
    Route::get('/newsletters/create', 'Admin\NewsletterController@create')->name('send-newsletter-email');
    Route::post('/newsletters/send-email', 'Admin\NewsletterController@store')->name('send-newsletter');

    Route::get('/logout', function(){
        return Redirect::to('/admin');
    });

    /* Help desk by sam */
    Route::get('/helpdesk','Admin\HelpController@index')->name('helpdesk');
    Route::get('/add_new_help','Admin\HelpController@create')->name('helpdesk-add');
    Route::post('/help_store','Admin\HelpController@store')->name('help_create');
    Route::post('/help_update','Admin\HelpController@update')->name('help_update');
    Route::get('/help_view/{id}','Admin\HelpController@view')->name('help_view');
    Route::get('/delete_help/{id}','Admin\HelpController@delete')->name('help_delete');
    /* Help desk by sam end*/


    /*Advertisment start */
        /*** book an activity start ****/
        Route::get('/bookactivity', 'Admin\BookactivityController@index')->name('bookactivity');
        Route::get('/bookactivity/create', 'Admin\BookactivityController@create')->name('create-new-bookactivity'); 
        Route::post('/bookactivity/store', 'Admin\BookactivityController@store')->name('create-bookactivity');
        Route::DELETE('/bookactivity/delete-bookactivity', 'Admin\BookactivityController@delete')->name('delete-bookactivity');
        Route::get('/book/edit/{id}', 'Admin\BookactivityController@edit');
        Route::post('/bookactivity/update/{id}', 'Admin\BookactivityController@update')->name('update-bookactivity'); 
        Route::get('/book/delete/{id}', 'Admin\BookactivityController@delete');
        /*** book an activity end ****/
        /*** get strated start ****/
        Route::get('/getstarted', 'Admin\GetstartedController@index')->name('getstarted');
        Route::get('/getstarted/create', 'Admin\GetstartedController@create')->name('create-new-getstarted'); 
        Route::post('/getstarted/store', 'Admin\GetstartedController@store')->name('create-getstarted');
        Route::DELETE('/getstarted/delete-getstarted', 'Admin\GetstartedController@delete')->name('delete-getstarted');
        Route::get('/getstarted/edit/{id}', 'Admin\GetstartedController@edit');
        Route::post('/getstarted/update/{id}', 'Admin\GetstartedController@update')->name('update-getstarted'); 
        Route::get('/getstarted/delete/{id}', 'Admin\GetstartedController@delete');
        Route::get('/activity-get-started-fast', 'Admin\activityGetStartedFastController@index')->name('activityGetStartedFast');
        Route::get('/activity-get-started-fast/edit/{id}', 'Admin\activityGetStartedFastController@edit');
        Route::post('/activity-get-started-fast/update/{id}', 'Admin\activityGetStartedFastController@update')->name('update-activitygetstartedfast');

        /*** book an activity end ****/
    /*Advertisment end */
});

// Task Routes
// Route::get('/tasks', 'TaskController@index');
// Route::post('/task', 'TaskController@store');
// Route::delete('/task/{task}', 'TaskController@destroy');
// Route::get('/testTwilio', 'TaskController@testTwilio');
// Route::post('/testTwilio', 'TaskController@testTwilio');

Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::post('auth/updateStep', 'Auth\AuthController@updateStep');
Route::post('auth/savegender', 'Auth\AuthController@saveGender');
Route::post('auth/saveaddress', 'Auth\AuthController@saveaddress');
Route::post('auth/savephoto', 'Auth\AuthController@savephoto');
Route::get('verify/{confirmation_code}', 'Auth\AuthController@verifyUserAccount');

// Registration Routes...
Route::post('auth/register', 'Auth\AuthController@postRegister')->name('reg');
Route::post('auth/resendverify', 'Auth\AuthController@resendVerifyCode');
Route::get('register/confirm/{confirmation_code}', 'Auth\AuthController@getResendEmail');
Route::get('auth/registerBusiness', 'Auth\AuthController@getRegisterbusiness');
Route::post('auth/registerBusiness', 'Auth\AuthController@postRegisterbusiness');
Route::get('/mytest', 'Auth\AuthController@test');

// new user type addition 17-05-2019 -- myzeal
Route::get('auth/registerProfessional', 'Auth\AuthController@getRegisterprofessional');
Route::post('auth/registerProfessional', 'Auth\AuthController@postRegisterprofessional');

//login with social media
Route::group(['middleware'], function () {
    Route::get('socialauth/socialLogin/{provider}', 'Auth\SocialAuthController@socialLogin');
    Route::get('socialauth/socialRegister/{provider}/{usertype}', 'Auth\SocialAuthController@socialRegister');
    Route::get('socialauth/handleProviderCallbackLogin/{provider}', 'Auth\SocialAuthController@handleProviderCallbackLogin');
});

// Facebook login
Route::get('login/facebook', 'LoginController@redirectToFacebook')->name('login.facebook');
Route::get('login/facebook/callback', 'LoginController@handleFacebookCallback');

// Google login
Route::get('login/google', 'LoginController@redirectToGoogle')->name('login.google');
Route::get('login/google/callback', 'LoginController@handleGoogleCallback');

// Password reset link request routes...
// Route::post('/password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::get('/password/reset', 'Auth\PasswordController@getReset');
Route::post('/password/reset', 'Auth\PasswordController@postReset')->name('password.reset');
Route::get('auth/jsModallogin', 'Auth\AuthController@jsModallogin');
Route::get('auth/jsModallogin/{sport_id}', 'Auth\AuthController@jsModallogin');
Route::get('auth/jsModalregister', 'Auth\AuthController@jsModalregister');
Route::get('auth/jsModalpassword', 'Auth\AuthController@jsModalpassword');
Route::post('newsletters/saveNewsletter','NewsletterController@saveNewsletter');
Route::get('unsubscribe', 'NewsletterController@getUnsubscribe');
Route::post('unsubscribe', 'NewsletterController@unsubscribe');
Route::post('addnewsletter', 'NewsletterController@addnewsletter')->name('addnewsletter');
/*Route::get('socialauth/login', 'Auth\SocialAuthController@getLogin');
Route::get('socialauth/handleProviderCallbackLogin', 'Auth\SocialAuthController@handleProviderCallbackLogin');*/

//profile routes starts
Route::get('background-check-faq', 'UserProfileController@getBackgroundCheckFAQ');
Route::post('update-picture', 'UserProfileController@uploadPic');
Route::get('vetted-business-faq', 'UserProfileController@getVettedBussinessFAQ');
Route::get('profile/getQuestions', 'UserProfileController@getQuestions');
Route::post('/profile/inquirySubmit', 'UserProfileController@inquirySubmit');

// Route::get('profile/{userid}', 'UserProfileController@index');
Route::get('profile/createProfile', 'UserProfileController@createProfile');
Route::post('profile/saveProfileHistory', 'UserProfileController@saveProfileHistory');
Route::post('/upgarde/businessProfile', 'UserProfileController@upgradeBusinessProfile');
Route::post('/upgarde/createBusiness', 'UserProfileController@createBusinessProfile');
Route::post('/profile/switchaccount', 'UserProfileController@switchAccount');
Route::get('/company/{company_name}/{type?}', 'UserProfileController@companyDetail');
Route::get('profile/createProfileSecurity', 'UserProfileController@createProfileSecurity');
Route::post('profile/saveProfileSecurity', 'UserProfileController@saveProfileSecurity');
Route::get('profile/createProfileMembership', 'UserProfileController@createProfileMembership');
Route::post('profile/saveProfileMembership', 'UserProfileController@saveProfileMembership');
Route::post('profile/sendProfileToReview/{status}', 'UserProfileController@sendProfileToReview');
Route::get('profile/viewProfile', 'UserProfileController@viewProfile')->name('profile-viewProfile');
Route::get('profile/viewbusinessProfile/{page_id}', 'UserProfileController@viewbusinessProfile')->name('profile-viewbusinessProfile');
Route::post('profile/savemyprofilepic', 'UserProfileController@savemyprofilepic')->name('savemyprofilepic');
Route::get('profile/viewProfile1', 'UserProfileController@viewProfile1');
Route::get('business-detail-delete/{business_id}', 'UserProfileController@businessDelete');
Route::get('profile/change-password', 'UserProfileController@viewChangePassword');
Route::post('change-password/reset', 'UserProfileController@postChangePassword');
Route::post('editUsername', 'UserProfileController@editUsername');

Route::post('profilePost', 'UserProfileController@profilePost')->name('profilePost');
Route::get('delPost/{id}', 'UserProfileController@delPost')->name('delPost');
/*Route::get('savePost/{pid}/{uid}', 'UserProfileController@savePost')->name('savePost');*/
Route::post('profilesavePost', 'UserProfileController@profilesavePost')->name('profilesavePost');
Route::get('RemovesavePost/{pid}/{uid}', 'UserProfileController@RemovesavePost')->name('RemovesavePost');
Route::get('editpost', 'UserProfileController@editpost')->name('editpost');
Route::post('profilePostupdate', 'UserProfileController@profilePostupdate')->name('profilePostupdate');
Route::get('delete-image-post/{id}', 'UserProfileController@deleteimagepost');
Route::post('like-post/{id}', 'UserProfileController@likepost')->name('like-post');
Route::post('reportPost/{id}', 'UserProfileController@reportPost');
Route::post('postcomment/{id}', 'UserProfileController@postcomment');
Route::post('like-comment/{id}', 'UserProfileController@likecomment')->name('like-comment');
Route::get('showcomments/{id}', 'UserProfileController@showcomments');

//Route::get('postDetail/{id}', 'UserProfileController@postDetail')->name('postDetail');
Route::get('postDetail/', 'UserProfileController@postDetail')->name('postDetail');

Route::get('loadmorepost', 'UserProfileController@loadmorepost');
Route::post('updateprofilepostviewcount', 'UserProfileController@updateprofilepostviewcount');
Route::get('loadmoreposts', 'Frontend\PostController@loadmoreposts');
/////////made by me////////
Route::get('family-member-delete/{family_id}', 'UserProfileController@deleteFamily');
Route::post('add-family-detail', 'UserProfileController@addFamilyDetail');
Route::post('/profile/create/company', 'UserProfileController@createCompany');
Route::post('/profile/create/newService', 'UserProfileController@createNewService');
Route::get('/profile/delete-service', 'UserProfileController@deleteNewService');
Route::post('/mybusinessusertag', 'UserProfileController@mybusinessusertag');
Route::get('/manage/company', 'UserProfileController@manageCompany')->name('manageCompany');
Route::post('/changecompanystatus', 'UserProfileController@changecompanystatus')->name('changecompanystatus');
Route::get('/pcompany/delete/{company_id}', 'UserProfileController@deleteCompany');
Route::get('/pcompany/edit/{company_id}', 'UserProfileController@editCompany');
Route::get('/pcompany/view/{company_id}', 'UserProfileController@viewPCompany');
Route::get('/newtest', 'UserProfileController@newtest');
Route::post('/favourite', 'UserProfileController@Pfavourite')->name('favourite');
Route::post('/follow_company', 'UserProfileController@Pfollow')->name('follow_company');
Route::post('/follow_profile', 'UserProfileController@follow_profile')->name('follow_profile');
Route::post('/fav_profile', 'UserProfileController@fav_profile')->name('fav_profile');

Route::post('/remove_follower', 'UserProfileController@removefollower')->name('remove_follower');
Route::post('/unfollow_company', 'UserProfileController@Punfollow_company')->name('unfollow_company');
Route::post('/follow_back', 'UserProfileController@Pfollow_back')->name('follow_back');
Route::post('/follower_company', 'UserProfileController@Pfollower')->name('follower_company');
Route::post('/unfollower_company', 'UserProfileController@Punfollower')->name('unfollower_company');
Route::post('/company-image-upload', 'UserProfileController@companyImageUpload');
Route::post('/user-multi-image-upload', 'UserProfileController@userImageUpload');
Route::get('personal-profile/add-family', 'UserProfileController@addFamily');
Route::post('/gallery-upload', 'UserProfileController@galleryUpload')->name('file-upload');
Route::get('gallery-picture/{user_id}', 'UserProfileController@galleryList')->name('file-list');
Route::post('profile/editProfilePicture', 'UserProfileController@editProfilePicture');
Route::post('profile/editCompanyPicture', 'UserProfileController@editCompanyPicture');
Route::post('profile/editBannerPicture', 'UserProfileController@editBannerPicture');
Route::post('profile/editProfileDetail', 'UserProfileController@editProfileDetail');
Route::get('profile/editProfileHistory', 'UserProfileController@editProfileHistory');
Route::post('profile/saveEditedProfileHistory', 'UserProfileController@saveEditedProfileHistory');
Route::get('profile/editProfileSecurity', 'UserProfileController@editProfileSecurity');
Route::get('profile/editProfileMembership', 'UserProfileController@editProfileMembership');
Route::post('editprofile/addeducationdetail', 'UserProfileController@EducationValidator');
Route::post('editprofile/addcertificatedetail', 'UserProfileController@CertificationValidator');
Route::post('editprofile/addhistorydetail', 'UserProfileController@historyValidator');
Route::post('editprofile/addskillawarddetail', 'UserProfileController@skillAwardValidator');
Route::post('deleteprofile/data', 'UserProfileController@deleteData');
Route::post('service/editservicedetail', 'UserProfileController@editservicedetail');

/* my popups routes */
Route::get('/evident', 'UserProfileController@evident');
Route::post('/evidentdata', 'UserProfileController@evidentdata');
Route::get('/get_serviceform', 'UserProfileController@get_serviceform');
Route::get('/get_serviceform1', 'UserProfileController@get_serviceform1');
Route::get('/get_serviceform2/{id}', 'UserProfileController@get_serviceform2');
Route::get('/getMyService', 'UserProfileController@getMyService1');
Route::get('/get_createcompanyform', 'UserProfileController@get_createcompanyform');
Route::get('/get_serviceform/{id}', 'UserProfileController@get_serviceform');
Route::get('/getmyservices', 'UserProfileController@getmyservices');
Route::post('/myemail', 'Auth\AuthController@myemail');



//Scheduler Controller


//profile routes ends
Route::group(['middleware' => ['auth']], function()
{
    //favourite routes
    Route::post('/isfavourite','UsersFavouriteController@isFavourite');
    Route::get('favourite/index', 'UsersFavouriteController@index');
    // timline route starts
    Route::get('timeline', 'TimelineController@index');
    // Timeline Feed - Like Route
    Route::post('timeline-ajax-feed-like', 'TimelineController@addLikeFeed')->name('timeline.feed-like');
    Route::post('timeline-ajax-feed-comments', 'TimelineController@showAllComments')->name('timeline.feed-comments');
    Route::post('timeline-ajax-remove-media-item', 'TimelineController@removeMediaItemGallery')->name('timeline.ajax-remove-media-item-gallery');
    Route::post('timeline-get-single-ajax-feed', 'TimelineController@getSingleProfileFeedPostById')->name('timeline.get-ajax-single-profile-feed');
    Route::post('timeline-get-single-ajax-personal-feed', 'TimelineController@getSinglePersonalProfileFeedPostById')->name('timeline.get-ajax-single-personal-feed');
    Route::post('timeline-ajax-edit-gallery-feed-title', 'TimelineController@updateFeedGalleryTitle')->name('timeline.edit-gallery-feed-title');
    Route::post('timeline-ajax-edit-feed-video-file', 'TimelineController@updateFeedVideoFile')->name('timeline.edit-feed-video-file');
    Route::post('timeline-delete-feed', 'TimelineController@deleteFeedById')->name('timeline.delete-feed-post');
    Route::post('timeline-get-ajax-feed', 'TimelineController@getFeedByFeedId')->name('timeline.get-ajax-feed');
    Route::post('timeline-get-ajax-personal-feed', 'TimelineController@getPersonalFeedByFeedId')->name('timeline.get-ajax-personal-feed');
    Route::post('timeline-ajax-feed-post-comment', 'TimelineController@postComment')->name('timeline.post-comment');
    Route::post('timeline-ajax-feed-delete-comment', 'TimelineController@deleteComment')->name('timeline.delete-comment');
    Route::post('timeline-ajax-feed-post-edit-comment', 'TimelineController@postEditComment')->name('timeline.edit-post-comment');
    Route::post('timeline-ajax-feed-unlike', 'TimelineController@removeLikeFeed')->name('timeline.feed-unlike');
    Route::any('timeline-ajax-add-feed-content', 'TimelineController@addFeedContent')->name('timeline.add-feed-content');
    Route::post('timeline-ajax-share-timeline-feed', 'TimelineController@shareTimeLineFeed')->name('timeline.share-time-line-feed');
    Route::post('timeline-ajax-upload-video-feed', 'TimelineController@uploadVideoFeed')->name('timeline.upload-video-feed');
    Route::post('timeline-ajax-upload-gallery-feed', 'TimelineController@uploadGalleryFeed')->name('timeline.upload-gallery-feed');
    Route::post('timeline-ajax-edit-upload-gallery-feed', 'TimelineController@editUploadGalleryFeed')->name('timeline.edit-upload-gallery-feed');
    Route::post('timeline-ajax-report-feed', 'TimelineController@reportFeed')->name('timeline.report-feed');
    Route::post('timeline-ajax-feed-post-reply-comment', 'TimelineController@postReplyComment')->name('timeline.post-reply-comment');
    Route::post('timeline-ajax-feed-delete-reply-comment', 'TimelineController@deleteReplyComment')->name('timeline.delete-reply-comment');
    Route::post('timeline-ajax-feed-post-edit-reply-comment', 'TimelineController@postEditReplyComment')->name('timeline.edit-post-reply-comment');
    Route::post('timeline-ajax-feed-replies', 'TimelineController@showAllReplies')->name('timeline.feed-replies');

    //All routes you'd like to handle that way
    Route::get('/mytimeline', 'TimelineController@getMytimeline');
    Route::get('/ourprogram', 'TimelineController@getOurprogram');
    Route::get('/mytimelineimages', 'TimelineController@getMyTimelineImages');
    Route::get('/mytimelinevideos', 'TimelineController@getMyTimelineVideos');
    Route::any('timeline-ajax-view-more-media', 'TimelineController@viewMoreMedia')->name('timeline.view-more-media');
    Route::post('timeline-get-all-feed', 'TimelineController@getUserFeeds')->name('timeline.get-all-feed');
    Route::post('timeline-get-my-feed', 'TimelineController@getMyFeeds')->name('timeline.get-my-feed');
    Route::post('timeline-ajax-add-favorite-media', 'TimelineController@addToFavoriteUserMedia')->name('timeline.ajax-add-favorite-media');
    Route::post('timeline-ajax-remove-favorite-media', 'TimelineController@removeToFavoriteUserMedia')->name('timeline.ajax-remove-favorite-media');
    // timline route ends
});

Route::get('/timeline/feed/{feed_id}', 'TimelineController@getFeed');
// Quick Hire Lesson Route
Route::get('auth/lesson', 'Auth\AuthController@jsModalBookLesson');
Route::get('auth/quickhire1', 'Auth\AuthController@jsModalQuickHire1');
Route::get('auth/quickhire2', 'Auth\AuthController@jsModalQuickHire2');
Route::get('auth/quickhire3', 'Auth\AuthController@jsModalQuickHire3');
Route::get('auth/quickhire4', 'Auth\AuthController@jsModalQuickHire4');
Route::get('auth/quickhire5', 'Auth\AuthController@jsModalQuickHire5');
Route::get('auth/quickhire6', 'Auth\AuthController@jsModalQuickHire6');
Route::get('auth/quickhire7', 'Auth\AuthController@jsModalQuickHire7');
Route::get('auth/quickhire8', 'Auth\AuthController@jsModalQuickHire8');
Route::get('auth/quickhire9', 'Auth\AuthController@jsModalQuickHire9');

Route::post('apicall/testIosNotification', 'TestNotificationController@send_notification_ios');
Route::get('apicall/testIosNotification', 'TestNotificationController@send_notification_ios');
Route::get('lesson/jsModallesson/{modalname}', 'LessonController@jsModallesson');
Route::get('lesson/jsModallesson/{modalname}/{sportId}', 'LessonController@jsModallesson');
Route::post('lesson/getquotes', 'LessonController@PostQuotes');

//Route::get('/mypostedjobs', 'LessonController@Getmypostedjobs');
//Route::get('/mybooking', 'LessonController@GetProfessionalBookingList');
//Route::get('/mybooking/{status}', 'LessonController@GetProfessionalBookingList');

Route::get('/mybooking', 'LessonController@GetBookingList');
Route::get('/mybooking/{status}', 'LessonController@GetBookingList');
Route::get('/jobmatchingskill', 'LessonController@Getjobmatchingskill');
Route::get('/jobs/{id}', 'LessonController@Getjobs');
Route::get('/jobs/submit/{id}', 'LessonController@GetjobsSubmit');
Route::get('/booking/postquote/{booking_id}', 'LessonController@PostQuote');
Route::post('/booking/savepostquote', 'LessonController@SavePostQuote');
Route::get('/booking/myquote', 'LessonController@GetUserQuoteList');
Route::post('/booking/deletepostquote', 'LessonController@DeletePostQuote');
Route::get('/viewbusinessprofile/{user_id}', 'LessonController@viewbusinessprofile');
Route::any('/direct-hire', 'LessonController@getDirecthire');

//Route::middleware(['basicAuth'])->group(function () {
Route::any('/instant_hire_search_filter', 'LessonController@instant_hire_search_filter')->name('instant_hire_search_filter');
Route::any('/instant-hire1', 'LessonController@getInstanthire')->name('instant-hire');
//});
Route::get('/instant-hire-search', 'LessonController@getInstanthireSearch');
Route::get('/directhire/viewprofile/{user_id}', 'LessonController@directhireViewProfile');
Route::get('/directhire/bookprofile/{user_id}', 'LessonController@directhireBookProfile');
Route::get('/searchProfile/{selected_sport}', 'LessonController@postSearchProfile');
Route::post('/savedirecthirerequest', 'LessonController@postSaveDirecthireRequest');
Route::any('/direct-hire/cart-payment', 'LessonController@cartpayment');
Route::any('/direct-hire/confirm-payment', 'LessonController@confirmpayment');
Route::get('/direct-hire/getCompareProfessionalDetail/{id}', 'LessonController@getCompareProfessionalDetail');
/*Route::any('/payments/card', 'LessonController@cartpaymentinstant')->name('payments_card');*/
Route::get('/carts', 'CartController@index')->name('carts_index');
Route::post('/addfamilyfromcart', 'CartController@addfamilyfromcart')->name('addfamilyfromcart');
Route::post('/addactivitygift/{priceid?}', 'CartController@addactivitygift')->name('addactivitygift');



Route::post('/form_participate', 'PaymentController@form_participate')->name('form_participate');
Route::any('/instant-hire/confirm-payment', 'PaymentController@confirmpaymentinstant');
Route::post('create-checkout-session','PaymentController@createCheckoutSession')->name('create-checkout-session');
Route::any('/addtocart', 'LessonController@addToCart')->name('addtocart');
Route::any('/success-cart/{priceid}', 'LessonController@successcart')->name('successcart');
Route::any('/removetocart', 'LessonController@removeToCart')->name('removetocart');
Route::any('/emptycart', 'LessonController@emptyCart');

//booking status and details
Route::get('/viewBooking/{booking_id}', 'LessonController@viewBooking');
Route::post('/book-professional', 'LessonController@postBookProfessional');
Route::post('/booking/confirmBooking', 'LessonController@confirmBooking');
Route::post('/booking/rejectBooking', 'LessonController@rejectBooking');

//address routes
// Route::get('/get-country-list','UserProfileController@getCountryList');
Route::get('/get-state-list','UserProfileController@getStateList');
Route::get('/get-city-list','UserProfileController@getCityList');

//reviews
Route::get('/reviews', 'ReviewController@Index');
Route::get('/reviews/add', 'ReviewController@getAdd');
Route::post('/reviews/save', 'ReviewController@postSave');
Route::post('/reviews/update', 'ReviewController@reviewUpdate')->name('reviews.update-review');
Route::post('/reviews/delete-review', 'ReviewController@reviewDelete')->name('reviews.delete-review');

//feedback about fitnessity
Route::get('/feedback/jsModalfeedback', 'FeedbackController@jsModalfeedback');
Route::post('/feedback/saveFeedback', 'FeedbackController@saveFeedback');
Route::get('feedback', 'FeedbackController@feedback')->name('feedback');

//Terms & Condition Route
Route::get('terms-condition', 'PageController@GetTermsPage');
Route::get('privacy-policy', 'PageController@GetPrivacyPage');

//footer links
Route::get('/about-us', 'PageController@GetPageAboutUs');
Route::get('/how-it-works-customer', 'PageController@GetPageHowItWorksCustomer');
Route::get('/how-it-works-business', 'PageController@GetPageHowItWorksBusiness');
Route::get('/discover', 'PageController@GetPageDiscover');
Route::get('/be-a-part', 'PageController@GetPageBeaPart');
Route::get('/hire-trainer', 'PageController@GetPageHireTrainer');
Route::get('/store', 'PageController@GetPageStore');
Route::get('/jobs', 'PageController@GetPageJobs');
Route::get('/contact-us', 'PageController@GetPageContactUs');
Route::get('/help', 'PageController@get_qa')->name('q');
Route::post('/getans', 'PageController@getans')->name('qanw');
Route::get('/customer-support', 'PageController@CustomerSupport')->name('customer');
Route::get('/business-support', 'PageController@BusinessSupport')->name('business');
Route::get('/help-center', 'PageController@HelpCenter')->name('help');
Route::get('/help-dask/{id}', 'PageController@helpans')->name('qap');
Route::post('/contact-us', 'PageController@PostPageContactUs');
Route::get('/network', 'PageController@GetPageNetwork');
Route::get('/userevents', 'PageController@GetPageUserEvents');
Route::get('/popularsearch', 'PageController@GetPagePopularSearch');
Route::get('/forum', 'PageController@GetPageForum');
Route::get('/news', 'PageController@GetPageNews');
Route::get('/testmail', 'LessonController@test');
Route::get('/user/sport-alert', 'UserProfileController@showSportAlertbox');
Route::post('/getlanguage', 'UserProfileController@getlanguage');

// Route::filter('author_check', function () { 
// 	if ( !Session::has('user') || !Session::get('user')->id ) { 
// 		//return View::make('login');
// 		return Redirect::to('/auth/jsModallogin'); 
// 	}
// });

// home page banner search filter
//view netwrok user profile
// network routes

Route::group(['middleware' => 'auth'], function () {
    Route::any('/payments/card', 'LessonController@cartpaymentinstant')->name('payments_card');
    Route::post('savereviews', 'UserProfileController@savereviews')->name('savereviews');

    // Route::resource('network', 'NetworkController');
    Route::any('/network/getcontacts', 'NetworkController@GetContacts');
    Route::post('/network/sendemailinvitation', 'NetworkController@sendEmailInvitation');
    Route::post('/network/sendinvitation', 'NetworkController@sendInvitation');    
    Route::post('/network/sendfriendrequest', 'NetworkController@sendFriendRequest');
    Route::post('/network/filterregisteredcontacts', 'NetworkController@filterRegisteredContacts');
    Route::get('/network/mynetwork', 'NetworkController@getMyNetwork');
    Route::get('/network/removeNetwork', 'NetworkController@removeNetwork');
    Route::get('/network/acceptNetwork', 'NetworkController@acceptNetwork');
    Route::get('/network/getMyNetwork', 'NetworkController@getMyNetworkAjax');
    Route::get('/network/getNetworkRequestReceived', 'NetworkController@getNetworkRequestReceivedAjax');
    Route::get('/network/getNetworkRequestSent', 'NetworkController@getNetworkRequestSentAjax');
    Route::get('/network/pendingNetworkInvitation', 'NetworkController@pendingNetworkInvitation');
    Route::get('/network/viewprofile/{user_id}', 'NetworkController@networkViewProfile');
    Route::post('/network/user/follow', 'NetworkController@userFollow');
    Route::post('/network/user/unfollow', 'NetworkController@userUnfollow');
    Route::get('/network/follow', 'NetworkController@Followers');
    Route::get('/network/followers', 'NetworkController@usereFollowers');
    Route::get('/network/followings', 'NetworkController@usereFolloweings');
    // Route::get('/outlookSignin', 'NetworkController@outlookSignin');
    // Route::get('/authorize', 'NetworkController@getOutlooktoken');
    Route::post('/add_instructor', 'UserProfileController@add_instructor')->name('add_instructor');

    Route::get('/sendemailofreceipt', 'BookingController@sendemailofreceipt')->name('sendemailofreceipt');
    Route::get('/getreceiptmodel', 'BookingController@getreceiptmodel')->name('getreceiptmodel');
    Route::get('/personal-profile/booking-info/{tabval?}', 'BookingController@bookinginfo')->name('bookinginfo');
    Route::get('/personal-profile/gym-studio-info/{tabval?}', 'BookingController@gym_studio_page')->name('gym_studio_page');
    Route::get('/personal-profile/experience-info/{tabval?}', 'BookingController@experience_page')->name('experience_page');
    Route::get('/personal-profile/events-info/{tabval?}', 'BookingController@events_page')->name('events_page');
    Route::post('/datefilterdata', 'BookingController@datefilterdata')->name('datefilterdata');
    Route::post('/searchfilterdata', 'BookingController@searchfilterdata')->name('searchfilterdata');
    Route::get('/cancelbooking', 'BookingController@cancelbooking')->name('cancelbooking');
    Route::get('/getbookingmodeldata', 'BookingController@getbookingmodeldata')->name('getbookingmodeldata');

});




Route::post('/fullcalenderAjax', 'UserProfileController@cajax')->name('fullcalenderAjax');
Route::get('/personal-profile/favorite', 'UserProfileController@favorite');
Route::get('/personal-profile/followers', 'UserProfileController@followers');
Route::get('/personal-profile/following', 'UserProfileController@following');
Route::get('/personal-profile/payment-info', 'UserProfileController@paymentinfo');
Route::post('/personal-profile/payment-save', 'UserProfileController@paymentsave')->name('paymentsave');
Route::post('/personal-profile/payment-delete', 'UserProfileController@paymentdelete')->name('paymentdelete');
Route::get('/personal-profile/review', 'UserProfileController@review');
Route::get('/personal-profile/user-profile', 'UserProfileController@userprofile')->name('user-profile');
Route::post('updateuserprofile', 'UserProfileController@updateuserprofile')->name('updateuserprofile');
Route::post('savemycoverphoto', 'UserProfileController@savemycoverphoto')->name('savemycoverphoto');
Route::post('removeusercoverphoto', 'UserProfileController@removeusercoverphoto')->name('removeusercoverphoto');
Route::post('updatechangepassword', 'UserProfileController@updatechangepassword')->name('updatechangepassword');
Route::post('addFamilyMember', 'UserProfileController@addFamilyMember')->name('addFamilyMember');
Route::post('removefamily', 'UserProfileController@removefamily')->name('removefamily');


Route::post('/followProfile', 'UserProfileController@followProfile')->name('followProfile');
Route::post('/service_fav', 'LessonController@service_fav')->name('service_fav');
Route::post('/viewActreview', 'LessonController@viewActreview')->name('viewActreview');
Route::get('submitreview','LessonController@submitreview')->name('submitreview');
Route::post('/act_detail_filter_business_pages', 'LessonController@act_detail_filter_business_pages')->name('act_detail_filter_business_pages');
Route::post('getServiceData', 'UserProfileController@getServiceData')->name('getServiceData');
Route::post('NewService', 'UserProfileController@NewService')->name('NewService');

//Route::post('autocomplete','UserProfileController@autocomplete'->name('autocomplete');

// Page

Route::post('updatebusinesspostviewcount', 'BusinessController@updatebusinesspostviewcount');
Route::get('businessprofile/{user_name}/{id}','BusinessController@viewbusinessprofileofOther')->name('show_businessprofile');
Route::get('businessprofile/timeline/{user_name}/{id}','BusinessController@viewbprofiletimelineofOther')->name('businessprofile');
Route::post('pagePost', 'BusinessController@pagePost')->name('pagePost');
Route::post('pagePostcomment/{id}', 'BusinessController@pagePostcomment');
Route::get('pageshowcomments/{id}', 'BusinessController@pageshowcomments');
Route::post('commentLike/{id}', 'BusinessController@commentLike')->name('commentLike');
Route::post('like-pagepost/{id}', 'BusinessController@likepost')->name('like-pagepost');
Route::post('savePost', 'BusinessController@savePost')->name('savePost');
Route::post('DelPost', 'BusinessController@DelPost')->name('DelPost');
Route::post('savepagecoverphoto', 'BusinessController@savepagecoverphoto')->name('savepagecoverphoto');
Route::post('savegallarypics', 'BusinessController@savegallarypics')->name('savegallarypics');
Route::post('profile/editPageProPic', 'BusinessController@editPageProPic');
Route::get('editpagepost', 'BusinessController@editpagepost')->name('editpagepost');
Route::post('pagePostupdate', 'BusinessController@pagePostupdate')->name('pagePostupdate');
Route::get('loadmorepagepostview', 'BusinessController@loadmorepagepostview');
Route::post('/followPage', 'BusinessController@followPage')->name('followPage');
Route::post('/Businessact_detail_filter', 'BusinessController@Businessact_detail_filter')->name('Businessact_detail_filter');
Route::post('save_business_reviews','BusinessController@save_business_reviews')->name('save_business_reviews');

Route::post('save_business_service_reviews','LessonController@save_business_service_reviews')->name('save_business_service_reviews');

Route::get('manageproduct','UserProfileController@manageproduct')->name('manageproduct');
Route::get('addproduct','UserProfileController@addproduct')->name('addproduct');
Route::get('manage-activity','UserProfileController@manage_activity')->name('manage-activity'); 

Route::get('view-customer','UserProfileController@view_customer')->name('view-customer');
Route::get('financial-dashboard','UserProfileController@financial_dashboard')->name('financial-dashboard');
Route::get('stripe-dashboard','StripeController@dashboard')->name('stripe-dashboard');
Route::get('show-all-list','LessonController@showalllist')->name('show-all-list');


//  Customers for business

Route::namespace('Customers_Auth')->group(function(){
    Route::get('emailvalidation_customer', 'RegistrationController@emailvalidation_customer')->name('emailvalidation_customer');
    Route::post('/customers/registration', 'RegistrationController@postRegistrationCustomer')->name('customers.registration.post');
    Route::post('/customers/savegender', 'RegistrationController@saveGenderCustomer')->name('customers-savegender');
    Route::post('/customers/saveaddress', 'RegistrationController@saveaddressCustomer')->name('customers-saveaddress');
    Route::post('/customers/savephoto', 'RegistrationController@savephotoCustomer')->name('customers-savephoto');
    Route::post('/submitfamilyCustomer','RegistrationController@submitFamilyCustomer');

    /*Route::group(['prefix'  =>  'customers','middleware' => ['auth:customers']], function () {
    });*/
});

Route::group(['middleware' => ['auth']], function()
{
    
    Route::get('/exportcustomer/{chk?}/{id?}','CustomerController@export')->name('export');
    Route::get('/sendemailtocutomer','CustomerController@sendemailtocutomer')->name('sendemailtocutomer');
    Route::post('/import-customer','CustomerController@importcustomer')->name('importcustomer');
    Route::post('savenotes','CustomerController@savenotes')->name('savenotes');
    Route::post('update_customer','CustomerController@update_customer')->name('update_customer');
    Route::get('addcustomerfamily/{id}','CustomerController@addcustomerfamily')->name('addcustomerfamily');
    Route::post('addFamilyMemberCustomer','CustomerController@addFamilyMemberCustomer')->name('addFamilyMemberCustomer');
    Route::post('removefamilyCustomer','CustomerController@removefamilyCustomer')->name('removefamilyCustomer');

    Route::post('/payment-delete', 'CustomerController@paymentdeletecustomer')->name('paymentdeletecustomer');
    
});


//  Scheduler 

Route::group(['middleware' => ['auth']], function()
{
    Route::get('booking-request', 'SchedulerController@booking_request')->name('booking_request');
    Route::any('activity_purchase/{book_id?}/{cus_id?}', 'SchedulerController@activity_purchase')->name('activity_purchase');
    Route::post('searchcustomerbooking', 'SchedulerController@searchcustomerbooking')->name('searchcustomerbooking');
    
    Route::any('activity_schedule/{odid?}', 'SchedulerController@activity_schedule')->name('activity_schedule');
    Route::any('all_activity_schedule', 'SchedulerController@all_activity_schedule')->name('all_activity_schedule');
    Route::get('getdropdowndata', 'SchedulerController@getdropdowndata')->name('getdropdowndata');
    Route::post('checkout_register', 'SchedulerController@checkout_register')->name('checkout_register');
    Route::post('booking_activity_cancel', 'SchedulerController@booking_activity_cancel')->name('booking_activity_cancel');
    Route::post('getbookingcancelmodel', 'SchedulerController@getbookingcancelmodel')->name('getbookingcancelmodel');
    Route::post('check_in_activity', 'SchedulerController@check_in_activity')->name('check_in_activity');
    Route::post('editcartmodel', 'SchedulerController@editcartmodel')->name('editcartmodel');
    Route::post('updateorderdetails', 'SchedulerController@updateorderdetails')->name('updateorderdetails');
    Route::get('sendreceiptfromcheckout', 'SchedulerController@sendreceiptfromcheckout')->name('sendreceiptfromcheckout');
});

Route::group(['middleware' => ['auth']], function()
{
    Route::get('/personal-profile/calendar', 'CalendarController@calendar')->name('calendar');
    Route::post('eventmodelboxdata', 'CalendarController@eventmodelboxdata')->name('eventmodelboxdata');
    Route::get('/provider/calendar', 'CalendarController@provider_calendar')->name('provider_calendar');
});


?>