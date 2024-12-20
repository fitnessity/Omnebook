<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CmsRepository;
use App\{User,Admin};
use App\Cms;
use Auth;
use Redirect;
use Response;
use DB;
use Validator;
use Image;
use File;
use Illuminate\Http\Exceptions\HttpResponseException;

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

        $loggedinAdmin = auth()->guard('admin')->user();

        if($loggedinAdmin){
            
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

        $loggedinAdmin =auth()->guard('admin')->user();
        
        if($loggedinAdmin){
            
            $module_details = Cms::where('id',$id)->get();
            
            return view('admin.cms.edit', [
                'id' => $id,
                'module_details' => $module_details,
                'pageTitle' => "Edit CMS"
            ]);

        } else {
             return Redirect::to('/admin');
        }
    }

    public function postCmsModule(Request $request,$id)
    {   
        $loggedinAdmin = auth()->guard('admin')->user();
        
        if($loggedinAdmin){
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
        
        $content = $request->edit_content;
        $title = $input['edit_title']?trim($input['edit_title']):'';

        $image = new Image();
        $banner_image = '';
        if($request->file('banner_image')) {
            $file = $request->file('banner_image');

            $timestamp = date('YmdHis', strtotime(date('Y-M-d H:i:s')));
            $name = $timestamp. '-' .$file->getClientOriginalName();

            $image->filePath = $name;
            $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'cms'.DIRECTORY_SEPARATOR, $name);
            $banner_image = $image->filePath;
        }
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
        ],
        [
            'edit_title.required' => 'Provide a content title',
            'edit_content.required' => 'Provide a content',
        ]);
    }

    protected function throwValidationException(Request $request, $validator)
    {
        throw new HttpResponseException(response()->json(['error' => $validator->errors()], 422));
    }
}

