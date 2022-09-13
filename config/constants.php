<?php

return [

    'URL' => 'http://development.fitnessity.co/',

    // 'URL' => 'http://'.$_SERVER["HTTP_HOST"],

    //'ADMIN_URL' => 'http://'.$_SERVER["HTTP_HOST"].'/public/admin/',

    'SITE_URL'  => config('constants.URL'),



    'system_title'   => 'Fitnessity',

    'copyright_text' => '&copy;'.date("Y").'Fitnessity',
     


    'FRONT_IMAGE' => config('constants.URL').'/public/images/',

    'FRONT_JS'    => config('constants.URL').'/public/js/',

    'FRONT_CSS'	  => config('constants.URL').'/public/css/',
	
	'FRONT_NEW_CSS'	  => config('constants.URL').'/public/css/front/',
	'FRONT_NEW_JS'    => config('constants.URL').'/public/js/front/',

    

    'USER_IMAGE' => config('constants.URL').'/public/uploads/profile_pic/',

    'USER_BANNER_IMAGE_THUMB' => config('constants.URL').'/public/uploads/banner_image/thumb/',



    //'ADMIN' => Config::get('constants.URL').'asset/admin/',

    'ADMIN_BCSS' => config('constants.URL').'/public/admin/bootstrap/css/',

    'ADMIN_BJS'  => config('constants.URL').'/public/admin/bootstrap/js/',

    'ADMIN_DCSS'  => config('constants.URL').'/public/admin/dist/css/',

    'ADMIN_DJS'  => config('constants.URL').'/public/admin/dist/js/',

    'ADMIN_DIMG'  => config('constants.URL').'/public/admin/dist/img/',

    'ADMIN_PLUGIN'  => config('constants.URL').'/public/admin/plugins/',



    'USER_IMAGE_THUMB'  => config('constants.URL').'/public/uploads/profile_pic/thumb/',

    'USER_IMAGE_THUMB150'  => config('constants.URL').'/public/uploads/profile_pic/thumb150/',

    'MAP_KEY' => env('MAP_KEY'),
    
    'EVIDENT_VERIFICATION_API' => env('EVIDENT_VERIFICATION_API'),
    
    'STRIPE_KEY' => env('STRIPE_KEY'),
    
    'STRIPE_SUCCESS_URL' => env('STRIPE_SUCCESS_URL'),
    
    'STRIPE_CANCEL_URL' => env('STRIPE_CANCEL_URL'),

    'SMALLWIDTH' => env('SMALLWIDTH'),

    'SMALLHEIGHT' => env('SMALLHEIGHT'),



    'MEDIUMWIDTH' => env('MEDIUMWIDTH'),

    'MEDIUMHEIGHT' => env('MEDIUMHEIGHT'),



    'LARGEWIDTH' => env('LARGEWIDTH'),

    'LARGEHEIGHT' => env('LARGEHEIGHT'),



    'SPORTS_IMAGE' => config('constants.URL').'/public/uploads/sports/',

    'SPORTS_IMAGE_THUMB' => config('constants.URL').'/public/uploads/sports/thumb/',



    'POST_IMAGE' => config('constants.URL').'/public/uploads/post-gallery/',



    'MESSAGE_ATTACHMENT' => config('constants.URL').'/public/uploads/message/',



    'SERVICE_IMAGE_THUMB'  => config('constants.URL').'/public/uploads/service_profile_pic/thumb/',

    // 'SERVICE_IMAGE_THUMB150'  => config('constants.URL').'/public/uploads/service_profile_pic/thumb150/',



    /*'URL' => 'http://fit.lara',

    //'ADMIN_URL' => 'http://'.$_SERVER["HTTP_HOST"].'/public/admin/',

    'SITE_URL'  => 'php artisan key:generate',



    'system_title'   => 'Fintessity',

    'copyright_text' => '&copy; 2016 Fitnessity',



    'FRONT_IMAGE' => asset(DIRECTORY_SEPARATOR.'images').DIRECTORY_SEPARATOR,

    'FRONT_JS'    => asset(DIRECTORY_SEPARATOR.'js').DIRECTORY_SEPARATOR,

    'FRONT_CSS'   => asset(DIRECTORY_SEPARATOR.'css').DIRECTORY_SEPARATOR,

    

    //'ADMIN' => Config::get('constants.URL').'asset/admin/',

    'USER_IMAGE' => asset(DIRECTORY_SEPARATOR.'uploads'.'profile_pic').DIRECTORY_SEPARATOR,



    'ADMIN_BCSS' => asset(DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'css').DIRECTORY_SEPARATOR,

    'ADMIN_BJS'  => asset(DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'js').DIRECTORY_SEPARATOR,

    'ADMIN_DCSS'  => asset(DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'css').DIRECTORY_SEPARATOR,

    'ADMIN_DJS'  => asset(DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'js').DIRECTORY_SEPARATOR,

    'ADMIN_DIMG'  => asset(DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'img').DIRECTORY_SEPARATOR,

    'ADMIN_PLUGIN'  => asset(DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'plugins').DIRECTORY_SEPARATOR,



    //'ADMIN' => Config::get('constants.URL').'asset/admin/',

    'USER_IMAGE_THUMB'  => asset(DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb').DIRECTORY_SEPARATOR,

    */



];