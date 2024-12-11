<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Business\WebsiteIntegrationConroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/login_integration','Business\WebsiteIntegrationConroller@Loginindex')->name('login_integration'); 
Route::post('auth/user', 'Business\WebsiteIntegrationConroller@UserLogin')->name('auth.user');
Route::get('/loginuser/{uniquecode}','Business\WebsiteIntegrationConroller@Loginuser')->name('loginuser');//added_16_08
Route::get('/login/{uniquecode}','Business\WebsiteIntegrationConroller@Loginuserbook')->name('login');//added_16_08

// Route::get('/customer_dashboard', 'Business\WebsiteIntegrationConroller@customerdashboard')->middleware('jwt.auth')->name('customer_dashboard');
Route::get('/customer_dashboard', 'Business\WebsiteIntegrationConroller@customerdashboard')->name('customer_dashboard');
Route::get('/business_customer_create/{uniquecode}','Business\WebsiteIntegrationConroller@registerindex')->name('business_customer_create');
Route::post('/get_checkin_code', 'Business\WebsiteIntegrationConroller@getCheckinCode')->name('get_checkin_code');
Route::post('/customers/registration', 'Business\WebsiteIntegrationConroller@postRegistrationCustomer')->name('customers.registration.post');
Route::get('/getTermsn', 'Business\WebsiteIntegrationConroller@getTerms')->name('getTermsn');
Route::get('/get_data', 'Business\WebsiteIntegrationConroller@data')->name('get_data');
Route::get('booking_schedule/{uniquecode}','Business\WebsiteIntegrationConroller@next_8_hours')->name('booking_schedule');
Route::get('/logout_n/{uniquecode}', 'Business\WebsiteIntegrationConroller@logout')->name('logout_n');
Route::post('/membership','Business\WebsiteIntegrationConroller@membership')->name('membership');
Route::post('/getactivitydates', 'Business\WebsiteIntegrationConroller@getActivityDates')->name('getActivityDates');
Route::post('/fetch_act_detailfilterforcart', 'Business\WebsiteIntegrationConroller@act_detail_filter_for_cart')->name('fetch_act_detailfilterforcart');
Route::post('/get-participatedata', 'Business\WebsiteIntegrationConroller@getParticipateData')->name('get-participatedata');
// Route::post('/formparticipate', 'PaymentController@form_participate')->name('formparticipate');
Route::post('/formparticipate', 'Business\WebsiteIntegrationConroller@form_participate')->name('formparticipate');
Route::any('/addto_cart', 'Business\WebsiteIntegrationConroller@addToCart')->name('addto_cart');
Route::get('/getBookingsSummary', 'Business\WebsiteIntegrationConroller@getBookingSummary')->name('getBookingsSummary');
// getInstructureDataUrl
Route::get('/getInstructureDataUrl', 'ActivityController@getInsData')->name('getInstructureDataUrl');
Route::post('/get-membershippayment', 'Business\WebsiteIntegrationConroller@getMembershipPayment')->name('checkin.getMembership-Payment');
Route::post('/memberhsippay', 'Business\WebsiteIntegrationConroller@memberhsipPay')->name('checkin_memberhsip-Pay');
Route::post('/quickcheckin', 'Business\WebsiteIntegrationConroller@checkin')->name('quickcheckin');
// Route::resource('orders', 'Business\WebsiteIntegrationConroller')->only(['viewbooking']);
// web.php
Route::post('orders/viewbooking', 'Business\WebsiteIntegrationConroller@viewbooking')->name('orders.viewbooking');
Route::get('orders/viewbooking_get', 'Business\WebsiteIntegrationConroller@viewbooking')->name('orders.viewbooking_get');

// Route::get('business_activity_schedulers/{business_id}/', 'BusinessActivitySchedulerController@index')->name('business_activity_schedulers');
Route::post('/orders/search-activity', 'Business\WebsiteIntegrationConroller@searchActivity')->name('orders_searchActivity');
Route::get('businessactivityschedulers_api', 'Business\WebsiteIntegrationConroller@schedule')->name('businessactivityschedulers_api');
Route::post('/chkOrder_Available', 'Business\WebsiteIntegrationConroller@chkOrderAvailable')->name('chkOrder_Available');
// Route::resource('schedulers', 'SchedulerController')->only(['index','create','update','destroy','store']);  
Route::post('/schedulers_store_data', 'Business\WebsiteIntegrationConroller@SchedulersStore')->name('schedulers_store_data');  
Route::get('/edit_profile', 'Business\WebsiteIntegrationConroller@edit_profile')->name('edit_profile');
Route::post('/profileupdate\{profile}', 'Business\WebsiteIntegrationConroller@updateProfile')->name('profile_update');
Route::post('/customer_profile_update', 'Business\WebsiteIntegrationConroller@customerProfileUpdate')->name('customer_profile_update');

Route::post('/customersprofile', 'Business\WebsiteIntegrationConroller@customerprofile')->name('customersprofile');
// Route::post('/testers','Business\WebsiteIntegrationConroller@customerProfileUpdate')->name('testers');

Route::post('user_family_profile_update', 'Business\WebsiteIntegrationConroller@userFamilyProfileUpdate')->name('user_family_profile_update');

// scheduler_index
Route::get('business_activityschedulers/', 'Business\WebsiteIntegrationConroller@scheduler_index')->name('business_activityschedulers');

Route::get('/payment_history', 'Business\WebsiteIntegrationConroller@paymentHistory')->name('payment_history');
Route::get('/receipt_model/{orderId}/{customer}/{isfrom?}', 'Business\WebsiteIntegrationConroller@receipt_model_api')->name('receipt_model');
Route::get('sendreceiptfromcheckout_api', 'Business\WebsiteIntegrationConroller@sendreceiptfromcheckout_api')->name('sendreceiptfromcheckout_api');
Route::get('/creditcards', 'Business\WebsiteIntegrationConroller@creditCards')->name('creditcards');
Route::post('/cardsave', 'Business\WebsiteIntegrationConroller@cardsapiSave')->name('cardsave');
Route::post('/card-delete-api', 'Business\WebsiteIntegrationConroller@cardDelete')->name('cardDeleteApi');

Route::get('manage_account', 'Business\WebsiteIntegrationConroller@UsersFamilyIndex')->name('manage_account');
Route::get('family_create/{user_id}', 'Business\WebsiteIntegrationConroller@UsersFamilyCreate')->name('family_create');
Route::post('user_family_store/{user_id}', 'Business\WebsiteIntegrationConroller@UsersFamilyStore')->name('user_family_store');

Route::any('customers_refresh_payment_methods', 'Business\WebsiteIntegrationConroller@refresh_payment_methods')->name('customers_refresh_payment_methods');


Route::post('testn','Business\WebsiteIntegrationConroller@test')->name('testn');

Route::get('/personal_orders', 'Business\WebsiteIntegrationConroller@orders_get')->name('personal_orders');

Route::post('/check-token', function(Request $request) {
    try {
        // Check if the token is valid
        $user = JWTAuth::setToken($request->bearerToken())->authenticate();
        return response()->json(['valid' => true]);
    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        return response()->json(['valid' => false, 'message' => 'Token expired'], 401);
    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        return response()->json(['valid' => false, 'message' => 'Invalid token'], 401);
    } catch (\Exception $e) {
        return response()->json(['valid' => false, 'message' => $e->getMessage()], 500);
    }
});

// family_create

