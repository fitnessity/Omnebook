<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();
Route::any('logout', function (Request $request) {
    Auth::logout();
    return redirect('/');
  });
Route::get('/home', 'HomeController@index')->name('homemy');

Route::get('/profile/editCustomerProfile/{user_id}','ProfileController@familyProfileUpdate');
Route::post('/submit-family-form','ProfileController@submitFamilyForm');
Route::post('/submit-family-form-with-skip','ProfileController@submitFamilyFormWithSkip');
Route::get('/join/{id}/{user_id?}','ZoomController@index')->name('call');
Route::group(['middleware' => ['auth']], function()
{
    Route::get('profile/viewProfile', 'ProfileController@viewProfile');
    
Route::get('/createmeeting','ZoomController@createmeeting');
Route::get('/oncall/{mid}','ZoomController@oncall')->name('oncall');
Route::post('/store','ZoomController@store')->name('store');
Route::post('/invite','ZoomController@invite')->name('invite');

});

/* 09-june 2020 */

Route::get('/getactivitychoice/{userid}/{ser_id}','LessonController@getactivity')->name('activitychoice');
Route::get('/cart','LessonController@getcart');
Route::get('/deletecart/{id}/{bid}','LessonController@deletecart');
Route::get('/addnote/{b}/{n}','LessonController@addnote');
Route::get('/pay','LessonController@pay');
Route::get('/payment/{token}','LessonController@payment');
Route::get('/editcart/{bkid}/{cid}/{user_id}','LessonController@editcart');
Route::get('/savetime/{u}/{t}','LessonController@times');
Route::post('/savetimes','LessonController@savetime');
Route::post('/updatecart','LessonController@updatecart');


Route::post('/samfilter','LessonController@samfilter')->name('samfilter');
/* 09-june 2020 end */





Route::get('/p/{popup}', 'HomeController@index');
Route::get('/allSports', 'HomeController@allSports')->name('list-all-sports');
Route::get('home/jsModalChildSports/{id}', 'HomeController@jsModalChildSports');

Route::group(array('prefix' => 'admin'), function(){

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
    
    //cms
    Route::get('/cms', 'Admin\CmsController@listCmsModules');
    Route::get('/cms/edit/{id}', 'Admin\CmsController@viewCmsModule');  
    Route::post('/cms/edit/{id}', 'Admin\CmsController@postCmsModule');  
	
    //Manage Customers
    Route::get('/customers', 'Admin\AdminUserController@viewCustomers');
    Route::post('/customers', 'Admin\AdminUserController@postCustomers');
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
    Route::post('/sports/deactivate-sport', 'Admin\SportsController@deactivate')->name('deactivate-sport'
    );
    Route::post('/sports/activate-sport', 'Admin\SportsController@activate')->name('activate-sport'
    );
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

    /* Route::get('/logout', function(){
		return Redirect::to('/admin');
    }); */
    /* Help desk by sam */
    Route::get('/helpdesk','Admin\HelpController@index')->name('helpdesk');
    Route::get('/add_new_help','Admin\HelpController@create')->name('helpdesk-add');
    Route::post('/help_store','Admin\HelpController@store')->name('help_create');
    Route::post('/help_update','Admin\HelpController@update')->name('help_update');
    Route::get('/help_view/{id}','Admin\HelpController@view')->name('help_view');
    Route::get('/delete_help/{id}','Admin\HelpController@delete')->name('help_delete');
    /* Help desk by sam end*/
});


// Route::get('/', function () {
// 	echo "Please Loing Using In Admin";
// 	exit();
// });

// Task Routes
// Route::get('/tasks', 'TaskController@index');
// Route::post('/task', 'TaskController@store');
// Route::delete('/task/{task}', 'TaskController@destroy');
// Route::get('/testTwilio', 'TaskController@testTwilio');
// Route::post('/testTwilio', 'TaskController@testTwilio');



// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');

Route::get('verify/{confirmation_code}', 'Auth\AuthController@verifyUserAccount');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
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
    // your routes here
    Route::get('socialauth/socialLogin/{provider}', 'Auth\SocialAuthController@socialLogin');
    Route::get('socialauth/socialRegister/{provider}/{usertype}', 'Auth\SocialAuthController@socialRegister');
	Route::get('socialauth/handleProviderCallbackLogin/{provider}', 'Auth\SocialAuthController@handleProviderCallbackLogin');
});

// Password reset link request routes...
// Route::get('/password/email', 'Auth\PasswordController@getEmail');
Route::post('/password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('/password/reset', 'Auth\PasswordController@postReset');

Route::get('auth/jsModallogin', 'Auth\AuthController@jsModallogin');
Route::get('auth/jsModallogin/{sport_id}', 'Auth\AuthController@jsModallogin');

Route::get('auth/jsModalregister', 'Auth\AuthController@jsModalregister');
Route::get('auth/jsModalpassword', 'Auth\AuthController@jsModalpassword');

Route::post('newsletters/saveNewsletter','NewsletterController@saveNewsletter');

Route::get('unsubscribe', 'NewsletterController@getUnsubscribe');
Route::post('unsubscribe', 'NewsletterController@unsubscribe');

/*Route::get('socialauth/login', 'Auth\SocialAuthController@getLogin');
Route::get('socialauth/handleProviderCallbackLogin', 'Auth\SocialAuthController@handleProviderCallbackLogin');*/

//profile routes starts

Route::get('background-check-faq', 'ProfileController@getBackgroundCheckFAQ');

Route::get('vetted-business-faq', 'ProfileController@getVettedBussinessFAQ');


Route::get('profile/getQuestions', 'ProfileController@getQuestions');
// Route::get('profile/{userid}', 'ProfileController@index');
Route::get('profile/createProfile', 'ProfileController@createProfile');
Route::post('profile/saveProfileHistory', 'ProfileController@saveProfileHistory');

Route::get('profile/createProfileSecurity', 'ProfileController@createProfileSecurity');
Route::post('profile/saveProfileSecurity', 'ProfileController@saveProfileSecurity');

Route::get('profile/createProfileMembership', 'ProfileController@createProfileMembership');
Route::post('profile/saveProfileMembership', 'ProfileController@saveProfileMembership');

Route::post('profile/sendProfileToReview/{status}', 'ProfileController@sendProfileToReview');


Route::get('profile/change-password', 'ProfileController@viewChangePassword');
Route::post('change-password/reset', 'ProfileController@postChangePassword');


/////////made by me////////
Route::get('family-member-delete/{family_id}', 'ProfileController@deleteFamily');
Route::post('add-family-detail', 'ProfileController@addFamilyDetail');

Route::get('profile/customer/upgradeProfile/{code}','ProfileController@upgardeProfile');


Route::post('profile/editProfilePicture', 'ProfileController@editProfilePicture');
Route::post('profile/editBannerPicture', 'ProfileController@editBannerPicture');
Route::post('profile/editProfileDetail', 'ProfileController@editProfileDetail');
Route::get('profile/editProfileHistory', 'ProfileController@editProfileHistory');
Route::post('profile/saveEditedProfileHistory', 'ProfileController@saveEditedProfileHistory');
Route::get('profile/editProfileSecurity', 'ProfileController@editProfileSecurity');
Route::get('profile/editProfileMembership', 'ProfileController@editProfileMembership');

Route::post('editprofile/addeducationdetail', 'ProfileController@EducationValidator');
Route::post('editprofile/addcertificatedetail', 'ProfileController@CertificationValidator');
Route::post('editprofile/addhistorydetail', 'ProfileController@historyValidator');
Route::post('editprofile/addskillawarddetail', 'ProfileController@skillAwardValidator');
Route::post('deleteprofile/data', 'ProfileController@deleteData');

Route::post('service/editservicedetail', 'ProfileController@editservicedetail');


/* my popups routes */
Route::get('/evident', 'ProfileController@evident');
Route::post('/evidentdata', 'ProfileController@evidentdata');
Route::get('/get_serviceform', 'ProfileController@get_serviceform');
Route::get('/get_serviceform/{id}', 'ProfileController@get_serviceform');
Route::get('/getmyservices', 'ProfileController@getmyservices');
Route::post('/myemail', 'Auth\AuthController@myemail');


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
Route::get('/directhire/viewprofile/{user_id}', 'LessonController@directhireViewProfile');
Route::get('/directhire/bookprofile/{user_id}', 'LessonController@directhireBookProfile');
Route::get('/searchProfile/{selected_sport}', 'LessonController@postSearchProfile');
Route::post('/savedirecthirerequest', 'LessonController@postSaveDirecthireRequest');
Route::get('/direct-hire/getCompareProfessionalDetail/{id}', 'LessonController@getCompareProfessionalDetail');

//booking status and details
Route::get('/viewBooking/{booking_id}', 'LessonController@viewBooking');
Route::post('/book-professional', 'LessonController@postBookProfessional');
Route::post('/booking/confirmBooking', 'LessonController@confirmBooking');
Route::post('/booking/rejectBooking', 'LessonController@rejectBooking');

//address routes
// Route::get('/get-country-list','ProfileController@getCountryList');
Route::get('/get-state-list','ProfileController@getStateList');
Route::get('/get-city-list','ProfileController@getCityList');


//reviews
Route::get('/reviews', 'ReviewController@Index');
Route::get('/reviews/add', 'ReviewController@getAdd');
Route::post('/reviews/save', 'ReviewController@postSave');
Route::post('/reviews/update', 'ReviewController@reviewUpdate')->name('reviews.update-review');
Route::post('/reviews/delete-review', 'ReviewController@reviewDelete')->name('reviews.delete-review');

//feedback about fitnessity
Route::get('/feedback/jsModalfeedback', 'FeedbackController@jsModalfeedback');
Route::post('/feedback/saveFeedback', 'FeedbackController@saveFeedback');

//Terms & Condition Route
Route::get('terms-condition', 'PageController@GetTermsPage');
Route::get('privacy-policy', 'PageController@GetPrivacyPage');

//footer links
Route::get('/about-us', 'PageController@GetPageAboutUs');
Route::get('/how-it-works-customer', 'PageController@GetPageHowItWorksCustomer');
Route::get('/how-it-works-business', 'PageController@GetPageHowItWorksBusiness');

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

Route::get('/user/sport-alert', 'ProfileController@showSportAlertbox');
Route::post('/getlanguage', 'ProfileController@getlanguage');


// Route::filter('author_check', function () { 

// 	if ( !Session::has('user') || !Session::get('user')->id ) { 
// 		//return View::make('login');
// 		return Redirect::to('/auth/jsModallogin'); 
// 	}
// });

// home page banner search filter
Route::post('/filter', 'HomeController@getFilter');

//view netwrok user profile

// network routes
Route::group(['middleware' => 'auth'], function () {
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
    

});
