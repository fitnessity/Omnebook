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
use App\Getstarted;
use App\Miscellaneous;
use Validator;

class GetstartedController extends Controller
{   
	public function index()
    { 
        $getstarted = Getstarted::get();

        return view('admin.getstarted.index', [
            'getstarted' => $getstarted,
            'pageTitle' => 'Manage Get Started'
        ]);
    }
    public function create()
    {
        return view('admin.getstarted.create', [            
            'pageTitle' => 'Add New Get Started'
        ]);
    }
    public function store(Request $request)
    {
    	//echo "<pre>"; print_r($request->all()); exit;
    	$validator = $this->saveValidator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        $arr = $request->all();

        $title = $arr['title'];
        
        if(@$arr['image']){
     
            if($request->hasFile('image')) {

                if (!file_exists(public_path('uploads/getstarted/thumb'))) {
                    mkdir(public_path('uploads/getstarted/thumb'), 0755, true);
                }

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'getstarted'.DIRECTORY_SEPARATOR;


                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'getstarted'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'668','667');

                if(@$image_upload['success'] && @$image_upload['success'] != ''){
                    $arr['image'] = @$image_upload['filename'];
                } else {
                    return redirect()->route('create-new-getstarted')->with('status', $image_upload);
                }                
            }
        }
        
       $status = Getstarted::create($arr);

        if($status)
        {
            session(['key' => 'success']);
            session(['msg' => 'Get Started Created Succesfully !']);    
        }

        return redirect()->route('getstarted');
    }

    protected function saveValidator($data)
    {
        return Validator::make($data, [  
            'image' => 'required',          
            'title' => 'required|max:255'        
        ],
        [
            'image.required' => 'Provide a Image',
            'title.required' => 'Provide a Title'
        ]);
    }
    protected function updateValidator($data,$id)
    {
        return Validator::make($data, [            
            'image' => 'required',          
            'title' => 'required|max:255'
        ],
        [
            'image.required' => 'Provide a Image',
            'title.required' => 'Provide a Title'
        ]);
    }
    public function edit($id)
    {
        $getstarted = Getstarted::where('id',$id)->get();

        //echo "<pre>"; print_r($getstarted); exit;

        if($getstarted)
        {
            return view('admin.getstarted.edit', [
                'pageTitle' => 'Edit Get Started',
                'getstarted' => $getstarted,
                'id' => $id
            ]);
        }

        return redirect()->route('plan-list');   
    }
    public function update($id, Request $request)
    {
        $id = $id;
       
        $getstarted = Getstarted::where('id',$id)->first();
         
       $input = $request->all();

        /* File Upload Start */
        $image = '';
        if($request->hasFile('image')) {

            if (!file_exists(public_path('uploads/getstarted/thumb'))) {
                mkdir(public_path('uploads/getstarted/thumb'), 0755, true);
            }

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'getstarted'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'getstarted'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'668','667');

            if(@$image_upload['success'] && @$image_upload['success'] != ''){
                $input['image'] = @$image_upload['filename'];
            } else {
                return redirect('/admin/getstarted/edit/'.$input['id'])->with('status', $image_upload);
            }    
        }
        /* File Upload End */
       
       // update:where()($input['id'],$input);
       
        $getstarted = DB::table('getstarted')->where('id', $input['id'])->update($input);

        if($getstarted)
        {
            session(['key' => 'success']);
            session(['msg' => 'Get Started Updated Succesfully !']);    
        }

        return redirect()->route('getstarted');
    }
    public function delete($id)
    {
       $data = Getstarted::where('id',$id)->first();
        $data->delete();
        return redirect()->route('getstarted');
    }
}