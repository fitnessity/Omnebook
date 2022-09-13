<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CmsRepository;
use App\User;
use App\Cms;
use Auth;
use Redirect;
use Response;
use DB;
use Validator;
use Image;
use File;

class CmsController extends Controller
{   
    protected $cms;

    public function __construct(CmsRepository $cms)
    {
        $this->middleware('admin');
        $this->cms = $cms;    
    }

    public function listCmsModules()
    {   

        $loggedinAdmin = Auth::user();

        if($loggedinAdmin->role == "admin"){
            
            $cmsModulesList = Cms::where('status','1')->get();

            return view('admin.cms.index', [
                'cms_modules_list_title' => 'Manage CMS',
                'cms_modules_list' => $cmsModulesList,
                'pageTitle' => "Manage CMS"
            ]);

        } else {
             return Redirect::to('/admin');
        }
    }

    public function viewCmsModule($id)
    {

        $loggedinAdmin =Auth::user();
        
        if($loggedinAdmin->role == "admin"){
            
            $module_details = Cms::where('id',$id)->get();
            
            return view('admin.cms.edit', [
                'id' => $id,
                'module_details' => $module_details,
                //'module_details' => @$module_details->content?json_decode($module_details->content):'',
                //'module_title' => @$module_details->content_title?$module_details->content_title:'',
                //'banner_image' => @$module_details->banner_image?$module_details->banner_image:'',
                'pageTitle' => "Edit CMS"
            ]);

        } else {
             return Redirect::to('/admin');
        }
    }

    public function postCmsModule(Request $request,$id)
    {   
        $loggedinAdmin =Auth::user();
        
        if($loggedinAdmin->role == "admin"){
            $input = $request->all();
            $validator = $this->cmsValidator($input);
        } else {
            $response = array('danger' => 'Unauthorized access.');
            return redirect('/admin/cms/edit/'.$input['id'])->with('status', $response);
        }

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        // if($validator->fails()) {
        //   $errMsg = array();
        //     foreach($validator->messages()->getMessages() as $field_name => $messages) {
        //         $errMsg = end($messages);
        //     }
        //     $response = array(
        //             'danger' =>  $errMsg,
        //     );
        //     return redirect('/admin/cms/edit/'.$input['id'])->with('status', $response);
        // }
        
        //$content = $input['edit_content']?$input['edit_content']:'';
        $content = $request->edit_content;
        $title = $input['edit_title']?trim($input['edit_title']):'';

        // Image 
        $image = new Image();
        $banner_image = '';
        if($request->file('banner_image')) {
            $file = $request->file('banner_image');

            //getting timestamp
            $timestamp = date('YmdHis', strtotime(date('Y-M-d H:i:s')));
            $name = $timestamp. '-' .$file->getClientOriginalName();

            $image->filePath = $name;
            $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'cms'.DIRECTORY_SEPARATOR, $name);
            $banner_image = $image->filePath;
        }
        // End Image
            $filepath='';
            if($request->file('video'))
            {
                $video = $request->file('video');

                if($request->file('video') != null)
                {
                    if(file_exists(public_path().'/'.$video)){
                        unlink(public_path().'/'.$video);
                    }
                }

                $basename = basename($request->file('video')->getClientOriginalName(), '.'.$request->file('video')->getClientOriginalExtension());
                $file_ext = $request->file('video')->getClientOriginalExtension();
                $fileName = md5($basename.time()).'.'.$file_ext;
                $filepath ='uploads/cms/videos/'.$fileName;
                $request->file('video')->move(public_path('uploads/cms/videos'), $fileName);
            }
            else{
                $video = $request->file('video');
                $filepath = $video;
            }
            /*echo $filepath;
            exit;*/

        //End Video
        if($request->file('video') == ''){
            $filepath = $input['video-name'];
        }
		$address=''; $email='';
		if($request->address != ''){ $address = $request->address; }
		if($request->email != ''){ $email = $request->email; }
        $store = $this->cms->storeCmsModule($input['id'],$content,$title,$banner_image,$filepath,$address,$email);

        if($store){
            $response = array(
                'success' => 'Page Updated successfully!',
            );
        } else {
            $response = array(
                'danger' => 'Error while updating.',
            );  
        }

        return redirect('/admin/cms/edit/'.$input['id'])->with('status', $response);
        
    }

    protected function cmsValidator($data)
    {
        return Validator::make($data, [            
            'edit_title' => 'required|max:255',
            'edit_content' => 'required',
            'banner_image' => 'image|mimes:jpeg,jpg,bmp,png|max:1024',
            'Video' => 'video|mimes:mp4|max:1024',
        ],
        [
            'edit_title.required' => 'Provide a content title',
            'edit_content.required' => 'Provide a content',
        ]);
    }
}

