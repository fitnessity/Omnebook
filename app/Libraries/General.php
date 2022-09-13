<?php namespace App\Libraries;

use Illuminate\Contracts\Routing\ResponseFactory;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\User;
use App\UserPayment;
use Input;
use File;
use Config;
use Mail;
use URL;
use DB;
use Image;
use Illuminate\Support\Facades\Storage;
use Log;
use App\AppDownloads;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class General {

    /**
     *
     * @uses display file type on product add/edit
     *
     * @return string
     */
    public static function getFileType()
    {
        $filetypes = array('3d max','Autocad','DXF','JPEG','PDF','Photoshop','Revit','3d sketchup');
        
       return $filetypes;
    }
    /**
     *
     * @uses  validate routes for data operator
     *
     * @return string
     */
     public static function authRoutes()
    {
        $authRoutes = array('/admin/login','/','/admin','/admin/category/add','/admin/projects','/admin/projects/add','/admin/projects','/admin/blogs','/admin/blogs/add','/admin/change_password');
        
       return $authRoutes;
    }
    /**
     *
     * @uses get image Url Path
     *
     * @return string
     */
    public static function imageUrlPath($type, $image='', $company_domain='', $http_url=0, $image_size="160X160")
     {

        if(!empty($image)){
            if($image_size) {
                $imageUrl = $type.'/'.$image_size.'/'.$image;
            } else {
                $imageUrl = $type.'/'.$image;
            }
        } else{
            if($image_size) {
                $imageUrl = $type.'/'.$image_size.'/';
            } else {
                $imageUrl = $type.'/';
            }
        }

        $checkFile = file_exists('uploads/'.$imageUrl);

        if($checkFile) {
            if($http_url==2 && $image == "") {
                return '';
            } else if($http_url==1 || $http_url==2) {
                $baseUrl = URL::to('/').'/uploads/';
                return $baseUrl.$imageUrl;
            } else {
                return $imageUrl;
            }
        } else{
            return '';
        }
    }
     /**
     *
     * @uses Generate VerifyCode for forgot password
     *
     * @return string
     */
     public static function GenerateVerifyCode($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    // public static function GenerateRCode($user_id) {
    //     if($user_id){
    //         $rendomString = date('YmdHis').$user_id;
    //         $charactersLength = strlen($rendomString);
    //         $randomString = '';

    //         for ($i = 0; $i < 6; $i++) {
    //             $randomString .= $rendomString[rand(0, $charactersLength - 1)];
    //         }

    //         if(User::where('reference_code', $randomString)->count() > 0) {
    //             self::GenerateRCode($user_id);
    //         } else {
    //             return $randomString;
    //         }
    //     }
    // }


    /**
    *
    * @uses File upload common funtion for project inmages, zip and bolgs images
    *
    * @return Array() status 
    */

    public static function saveFile($type, $filename_prefix, $file, $oldfile = null, $zip,  $oldzip = null, $file_path = null, $is_edit = false) {

        set_time_limit(18000); // in seconds
        ini_set('memory_limit', '-1');
        date_default_timezone_set('Asia/Kolkata');

        if(!empty($type) && $type === 'project'){
            return self::saveProjectFile($type, $filename_prefix, $file, $oldfile, $zip,  $oldzip, $file_path, $is_edit);
        }
        elseif(!empty($type) && $type === 'blog')
        {
            return self::saveBlogFile($type, $filename_prefix, $file, $oldfile, $file_path, $is_edit);
        }
    }

    /**
    * @author Rk < rakesh.webpatriot@gmail.com >
    *
    * @uses File upload common funtion for project images and zip files
    *
    * @param project type('project','blog'), image name, file object, old file name, zip object, old zipfile name, file path if store, edit records true/false 
    *
    * @return Array() status 
    */
    public static function saveProjectFile($type, $filename_prefix, $file, $oldfile = null, $zip,  $oldzip = null, $file_path = null, $is_edit = false)
    {
        $curent_time = date("dmYhis");
        $zip_file = $image_file = $file_name = $image_name =  $zipExtension = $imgExtension = "";
        $zipErr = $imageErr = false;

           
            // get the image file extension
            if(isset($file) && !empty($file)){
                $imgExtension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            }
            
            // get the zip file extension
            if(isset($zip) && !empty($zip)){
                $zipExtension = pathinfo($zip->getClientOriginalName(), PATHINFO_EXTENSION);
            }

                // check uploaded zip file is valid
                if($zipExtension === 'zip' || $zipExtension === 'rar' || $zipExtension === 'tar')
                {
                    // create zip name with timestamp
                    $zip_file = str_replace(' ', '_', strtolower($filename_prefix.'_'.$curent_time.'.'.$zipExtension));

                    // get the zip file path array
                    $zip_upload_path = self::getFilePath('zip', $zip_file, $file_path);

                    // create the current folder path
                    $file_path = $zip_upload_path['file_path'];

                    // create full aws bucket path
                    $zip_upload_path = $zip_upload_path['fullpath'];

                    if(!Storage::disk('s3')->exists($zip_upload_path))
                    {
                        try
                        {   
                            // If file dose not exist upload the zip file
                            Storage::disk('s3')->put($zip_upload_path, file_get_contents($zip));
                            $zipErr = false;

                        } catch (S3Exception $e)
                        {
                            // return false if error found while upload
                            $zipErr = true;
                            Log::info(print_r($e->getMessage()));
                            return array('success'=> false , 'message'=> "Unable to upload zip file", 'product' => null);
                        }
                    }
                }

                // If image file exist than get the image extemsion
                if($imgExtension !== "")
                {   
                    // create new image namw with timestamp
                    $image_file = str_replace(' ', '_', strtolower($filename_prefix.'_'.$curent_time.'.'.$imgExtension));

                    // get the current image path array
                    $image_upload_path = self::getFilePath('project', $image_file, $file_path);

                    // get the current folder path 
                    $img_path = $image_upload_path['path'];

                    // get the aws bucket full path
                    $file_path = $image_upload_path['file_path'];

                    // resize the image in 870xauto and 480x480
                    $img_850 = Image::make($file)->resize(870, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->stream();
                    $img_480 = Image::make($file)->resize(480, 480)->stream();

                    // if image is resized in 850 than uploaded in bucket
                    if(isset($img_850))
                    {   
                        if(!Storage::disk('s3')->exists($image_upload_path['medium']))
                        {
                            $img_850 = $img_850->__toString();
                            try
                            {
                                Storage::disk('s3')->put($image_upload_path['medium'], $img_850);
                                $imageErr = false;
                            }
                            catch (S3Exception $e)
                            {
                                $imageErr = true;
                                Log::info(print_r($e->getMessage()));
                                
                            }
                        }
                    }
                    
                    // if image is resized in 480 than uploaded in bucket
                    if(isset($img_480))
                    {
                        if(!Storage::disk('s3')->exists($image_upload_path['small']))
                        {
                            $img_480 = $img_480->__toString();
                            try
                            {
                                Storage::disk('s3')->put($image_upload_path['small'], $img_480);
                                $imageErr = false;

                            }
                            catch (S3Exception $e)
                            {
                                $imageErr = true;
                                Log::info(print_r($e->getMessage()));
                            }
                        }
                    }
                }

                // If error found while upload remove all uploaded files and return false
                if($imageErr == true || $zipErr == true){
                    
                    try
                    {
                        if(isset($zip_upload_path) && Storage::disk('s3')->exists($zip_upload_path))
                        {
                            Storage::disk('s3')->delete($zip_upload_path);
                        }

                        if(isset($image_upload_path['medium']) && Storage::disk('s3')->exists($image_upload_path['medium']))
                        {
                            Storage::disk('s3')->delete($image_upload_path['medium']);
                        }

                        if(isset($image_upload_path['small']) && Storage::disk('s3')->exists($image_upload_path['small']))
                        {
                            Storage::disk('s3')->delete($image_upload_path['small']);
                        }

                    }
                    catch (S3Exception $e)
                    {
                        Log::info(print_r($e->getMessage()));
                        return array(
                            'success'=> false, 
                            'message'=> "Unable to upload files on server"
                        );
                    }

                    return array(
                        'success'=> false, 
                        'message'=> "Unable to upload files"
                    );

                } else {

                    try
                    {   
                        // if file uploaded success fully and is_edit true than remove old images

                        if( $is_edit == true && isset($oldzip) ){
                            if(Storage::disk('s3')->exists(Config::get("app.AWS_BUCKET_ZIP").$file_path.$oldzip)){
                                Storage::disk('s3')->delete(Config::get("app.AWS_BUCKET_ZIP").$file_path.$oldzip);
                            }
                        }

                        if( $is_edit == true && isset($oldfile) ){
                            
                            if(Storage::disk('s3')->exists(Config::get("app.AWS_BUCKET_MEDIUM").$file_path.$oldfile)){
                                Storage::disk('s3')->delete(Config::get("app.AWS_BUCKET_MEDIUM").$file_path.$oldfile);
                            }

                            if(Storage::disk('s3')->exists(Config::get("app.AWS_BUCKET_SMALL").$file_path.$oldfile)){
                                Storage::disk('s3')->delete(Config::get("app.AWS_BUCKET_SMALL").$file_path.$oldfile);
                            }
                        }

                    }  catch (S3Exception $e) {
                        return array(
                            'success'=> false, 
                            'message'=> "Unable to delete old files"
                        );
                    }

                    // if file uploaded successfully than return true with new images
                    return array(
                        'success'=> true,
                        'file_path' => $file_path,
                        'uploaded_zip_name' => $zip_file,
                        'uploaded_img_name' => $image_file,
                        'message'=> "Upload files successfully"
                    );
                }
        
        
    }

    /**
    * @author Rk < rakesh.webpatriot@gmail.com >
    *
    * @uses File upload common funtion for bolgs images
    *
    * @param project type('project','blog'), image name, file object, old file name, file path if store, edit records true/false 
    *
    * @return Array() status 
    */
    public static function saveBlogFile($type, $filename_prefix, $file, $oldfile, $file_path, $is_edit)
    {
        $curent_time = date("dmYhis");
        $image_file = $file_name = $image_name  = $imgExtension = "";
        $imageErr = false;

            // If image is set than get the file extension
            if(isset($file) && !empty($file)){
                $imgExtension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            }
                
            if($imgExtension !== "")
            {   
                // create new image name with file name prefix
                $image_file = str_replace(' ', '_', strtolower($filename_prefix.'_'.$curent_time.'.'.$imgExtension));

                // return array of blog image upload path
                $image_upload_path = self::getFilePath('blog', $image_file, $file_path);

                // get the /YYYY/MM path
                $img_path = $image_upload_path['path'];

                // get the full aws bucket path
                $file_path = $image_upload_path['file_path'];

                // resize images in 850x850 and 480x480 
                $img_850 = Image::make($file)->resize(850, 850)->stream();
                $img_480 = Image::make($file)->resize(480, 480)->stream();

                // if image reset in 850x850 than upload on aws bucket
                if(isset($img_850))
                {   
                    if(!Storage::disk('s3')->exists($image_upload_path['medium']))
                    {
                        $img_850 = $img_850->__toString();
                        try
                        {
                            Storage::disk('s3')->put($image_upload_path['medium'], $img_850);
                            $imageErr = false;
                        }
                        catch (S3Exception $e)
                        {
                            $imageErr = true;
                            
                        }
                    }
                }
                
                // if image reset in 480x480 than upload on aws bucket
                if(isset($img_480))
                {
                    if(!Storage::disk('s3')->exists($image_upload_path['small']))
                    {
                        $img_480 = $img_480->__toString();
                        try
                        {
                            Storage::disk('s3')->put($image_upload_path['small'], $img_480);
                            $imageErr = false;

                        }
                        catch (S3Exception $e)
                        {
                            $imageErr = true;
                        }
                    }
                }
            }

            // in error found in uploaded images it deleted all uploaded file and return false
            if($imageErr == true){
                try
                {
                    if(isset($image_upload_path['medium']) && Storage::disk('s3')->exists($image_upload_path['medium']))
                    {
                        Storage::disk('s3')->delete($image_upload_path['medium']);
                    }

                    if(isset($image_upload_path['small']) && Storage::disk('s3')->exists($image_upload_path['small']))
                    {
                        Storage::disk('s3')->delete($image_upload_path['small']);
                    }

                }
                catch (S3Exception $e)
                {
                    
                    return array(
                        'success'=> false, 
                        'message'=> "Unable to upload files on server"
                    );
                }

                return array(
                    'success'=> false, 
                    'message'=> "Unable to upload files"
                );

            } else {

                try
                {
                    // If images uploaded and is_edit param true than unlink old images form folder
                    if( $is_edit == true && isset($oldfile) ){
                        
                        if(Storage::disk('s3')->exists(Config::get("app.AWS_BUCKET_MEDIUM_BLOG").$file_path.$oldfile)){
                            Storage::disk('s3')->delete(Config::get("app.AWS_BUCKET_MEDIUM_BLOG").$file_path.$oldfile);
                        }

                        if(Storage::disk('s3')->exists(Config::get("app.AWS_BUCKET_SMALL_BLOG").$file_path.$oldfile)){
                            Storage::disk('s3')->delete(Config::get("app.AWS_BUCKET_SMALL_BLOG").$file_path.$oldfile);
                        }
                    }

                }  catch (S3Exception $e) {
                    return array(
                        'success'=> false, 
                        'message'=> "Unable to delete old files"
                    );
                }

                return array(
                    'success'=> true,
                    'file_path' => $file_path,
                    'uploaded_zip_name' => "",
                    'uploaded_img_name' => $image_file,
                    'message'=> "Upload files successfully"
                );
            }
    }

     /**
    * @author Rk < rakesh.webpatriot@gmail.com >
    *
    * @uses Delete files from aws server
    *
    * @param project type, file name, file path
    *
    * @return boolen
    */

    public static function deleteFromServerFile($type, $file_path, $file_name, $zip_name= null)
    {   
        // check required param is set ( file type, file path, file name)
        if(empty($type) || empty($file_path) || empty($file_name))
        {
            return array('success' => 'false', 'message' => 'parameters missing');
        }

        // If type is project return zip and image path else blog image path
        if($type === 'project'){

            $zipPath = self::getFilePath('zip', $zip_name, $file_path);
            $imgPath = self::getFilePath('project', $file_name, $file_path);

            $zipfullpath = $zipPath['fullpath'];

        } else if($type === 'blog') {
            $imgPath = self::getFilePath('blog', $file_name, $file_path);
        }


        $smallImgPath = $imgPath['small'];
        $mediumImgPath = $imgPath['medium'];

        // check image or zip file exist on server if true than delete image or zip
        try {

            if($type === 'project'){
                if(Storage::disk('s3')->exists($zipfullpath)){
                    Storage::disk('s3')->delete($zipfullpath);
                }
            }

            if(Storage::disk('s3')->exists($smallImgPath)){
                Storage::disk('s3')->delete($smallImgPath);
            }


            if(Storage::disk('s3')->exists($mediumImgPath)){
                Storage::disk('s3')->delete($mediumImgPath);
            }

            return array('success' => 'true', 'message' => 'file deleted successfully');

        } catch (S3Exception $e) {

            return array('success' => 'false', 'some error occure while deleteing files');
        }
    }



    /**
    * @author Rk < rakesh.webpatriot@gmail.com >
    *
    * @uses Generate file upload path
    *
    * @return Array
    */
    public static function getFilePath($type, $filename, $file_path){

        $path = date('Y').'/'.date('m').'/';

        if(isset($file_path) && !empty($file_path)){
            $path = $file_path;
        }

        if($type === 'zip' && !empty($filename)){

            return [
                'path' => $path.$filename,
                'file_path' => $path,
                'fullpath' => Config::get("app.AWS_BUCKET_ZIP").$path.$filename,
            ];
        }

        if($type === 'project' && !empty($filename)){
            return [
               'path' => $path.$filename,
               'file_path' => $path,
               'small' => Config::get("app.AWS_BUCKET_SMALL").$path.$filename,
               'medium' => Config::get("app.AWS_BUCKET_MEDIUM").$path.$filename
            ];
        }

        if($type === 'blog' && !empty($filename)){
            return [
               'path' => $path.$filename,
               'file_path' => $path,
               'small' => Config::get("app.AWS_BUCKET_SMALL_BLOG").$path.$filename,
               'medium' => Config::get("app.AWS_BUCKET_MEDIUM_BLOG").$path.$filename
            ];
        }

        if($type === 'editor' && !empty($filename)){
            return [
               'fullpath' => Config::get("app.AWS_BUCKET_BLOG_EDITOR").$filename,
            ];
        }
    }
    /**
    *
    * @uses Send Email
    *
    */

    public static function sendMail($subject, $data, $template, $to, $from) {

        $send = Mail::send( $template, $data, function ($m) use ($data, $to, $from, $subject) {
            $m->from($from);
            $m->to($to, 'Admin')->subject($subject);
        });

        return $send;
    }

    /**
    *
    * @uses get DateFormat
    *
    */
 
    public static function getDateFormat($date)
    {
        $dateFormat = date_format(date_create($date ),"M d, Y");
        return $dateFormat;
    }


    public static function sendPushNotification($title, $description, $dataArr=array()){

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);


       // $notificationBuilder = new PayloadNotificationBuilder($title);
        //$notificationBuilder->setBody($description);
	$notificationBuilder = new PayloadNotificationBuilder();
	$dataArr = array('title'=>$title, 'description' => $description);

        $dataBuilder = new PayloadDataBuilder();
        // $dataBuilder->addData(['a_data' => 'my_data']);
        $dataBuilder->addData($dataArr);

        $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        //$devices = AppDownloads::pluck('device_id')->toArray();
       $devices = AppDownloads::whereNull('deleted_at')->pluck('device_id')->toArray();

        if(count($devices) > 0){
            $downstreamResponse = FCM::sendTo($devices, $option, $notification, $data);
            
            if($downstreamResponse->numberSuccess()){
                return true;
            }else if($downstreamResponse->numberFailure()){
                return false;
            }else{
                return false;
            }   
        } else {
            return false;
        }

    }
}
?>
