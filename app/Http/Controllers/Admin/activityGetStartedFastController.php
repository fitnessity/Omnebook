<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\FeedbackRepository;
use App\User;
use Auth;
use Redirect;
use Response;
use DB;
use Input;
use App\ActivtyGetStartedFast;
use App\Miscellaneous;
use Validator;

class activityGetStartedFastController extends Controller
{   
	public function index()
    { 
        $getstarted = ActivtyGetStartedFast::get();

        return view('admin.activity_Get_Started_Fast.index', [
            'getstarted' => $getstarted,
            'pageTitle' => 'Manage Activity Get Started Fast'
        ]);
    }
    public function create()
    {
        return view('admin.getstarted.create', [            
            'pageTitle' => 'Add New Get Started'
        ]);
    }
    
  
    public function edit($id)
    {
        $getstarted = ActivtyGetStartedFast::where('id',$id)->get();

        //echo "<pre>"; print_r($getstarted); exit;

        if($getstarted)
        {
            return view('admin.activity_Get_Started_Fast.edit', [
                'pageTitle' => 'Edit Activity Get Started Fast',
                'getstarted' => $getstarted,
                'id' => $id
            ]);
        }

        return redirect()->route('activityGetStartedFast');   
    }
    public function update($id, Request $request)
    {
        $id = $id;
       
        $getstarted = ActivtyGetStartedFast::where('id',$id)->first();
         
        $input = $request->all();
        /*print_r($request->all());exit();*/
        /* File Upload Start */
        $image = '';
        if($request->hasFile('image')) {

            if (!file_exists(public_path('uploads/discover/thumb'))) {
                mkdir(public_path('uploads/discover/thumb'), 0755, true);
            }

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'discover'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'discover'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'668','667');

            if(@$image_upload['success'] && @$image_upload['success'] != ''){
                $input['image'] = @$image_upload['filename'];
            } else {
                return redirect('/admin/activity-get-started-fast/edit/'.$input['id'])->with('status', $image_upload);
            }    
        }
        /* File Upload End */
       
       // update:where()($input['id'],$input);
       
        $getstarted = DB::table('activity_Get_Started_Fast')->where('id', $input['id'])->update($input);

        if($getstarted)
        {
            session(['key' => 'success']);
            session(['msg' => 'Get Started Updated Succesfully !']);    
        }

        return redirect()->route('activityGetStartedFast');
    }
}