<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Miscellaneous;
use App\User;
use App\Discover;
use Auth;
use Redirect;
use Response;
use DB;
use Validator;
use Image;
use Excel;
use App\Slider;
use App\Trainer;
use App\Imports\ClaimImport;
use Maatwebsite\Excel\HeadingRowImport;


class DiscoverController extends Controller
{   

    public function index()
    {
        $discovers = Discover::get();

        return view('admin.discover.index', [
            'discovers' => $discovers,
            'pageTitle' => 'Manage Discover Activities'
        ]);
    }
    

    public function create()
    {
        return view('admin.discover.create', [            
            'pageTitle' => 'Add New Trainer'
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->saveValidator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $arr = $request->all();

        $title = $arr['title'];
        $description = $arr['description'];
       
        if(@$arr['image']){
     
            if($request->hasFile('image')) {

                if (!file_exists(public_path('uploads/discover/thumb'))) {
                    mkdir(public_path('uploads/discover/thumb'), 0755, true);
                }

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'discover'.DIRECTORY_SEPARATOR;


                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'discover'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'715','714');

                if(@$image_upload['success'] && @$image_upload['success'] != ''){
                    $arr['image'] = @$image_upload['filename'];
                } else {
                    return redirect()->route('create-new-discover')->with('status', $image_upload);
                }                
            }
        }
        
       $status = Discover::create($arr);

        if($status)
        {
            session(['key' => 'success']);
            session(['msg' => 'Discover Activities Created Succesfully !']);    
        }

        return redirect()->route('discover');
    }

    protected function saveValidator($data)
    {
        return Validator::make($data, [  
            'image' => 'required',          
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            
        ],
        [
            'image.required' => 'Provide a Image',
            'title.required' => 'Provide a Title',
            'description.required' => 'Provide a Description',
            
        ]);
    }

    protected function updateValidator($data,$id)
    {
        return Validator::make($data, [            
            'image' => 'required',          
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            
        ],
        [
            'image.required' => 'Provide a Image',
            'title.required' => 'Provide a Title',
            'description.required' => 'Provide a Description',
           
        ]);
    }

    public function edit($id)
    {
        $discover = Discover::where('id',$id)->get();

        if($discover)
        {
            return view('admin.discover.edit', [
                'pageTitle' => 'Edit Discover Activities',
                'discover' => $discover,
                'id' => $id
            ]);
        }

        return redirect()->route('plan-list');   
    }

    public function update($id, Request $request)
    {
        $id = $id;
       
        $discover = Discover::where('id',$id)->first();
         
       $input = $request->all();

        $image = '';
        if($request->hasFile('image')) {

            if (!file_exists(public_path('uploads/discover/thumb'))) {
                mkdir(public_path('uploads/discover/thumb'), 0755, true);
            }

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'discover'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'discover'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'715','714');

            if(@$image_upload['success'] && @$image_upload['success'] != ''){
                $input['image'] = @$image_upload['filename'];
            } else {
                return redirect('/admin/discover/edit/'.$input['id'])->with('status', $image_upload);
            }    
        }
       
        $discover = DB::table('discover')->where('id', $input['id'])->update($input);

        if($discover)
        {
            session(['key' => 'success']);
            session(['msg' => 'Discover  Activities Updated Succesfully !']);    
        }

        return redirect()->route('discover');
    }

    public function delete($id)
    {
       $data = Discover::where('id',$id)->first();
        $data->delete();
        return redirect()->route('discover');
    }

    
    /**
     * Delete Multiple Plans
     * 
     * @param Request $request
     * @return array
     */
    public function deleteAll(Request $request){
        $input = $request->all();

        if(isset($request->planIds) && count($request->planIds) > 0) {

            $update = Plan::whereIn('id', $input['planIds'])
                     ->update([
                        'is_deleted' => 1
                    ]);

            if(!$update) {
                $response = array(
                        'danger' => 'Some error while deactivating plans.',
                );
            } else {
                $response = array(
                    'success' =>  'Plans Deactivated Successfully.',
                ); 
            }

        } else {
            $response = array(
                    'danger' =>  'Please select at least one plan.',
            );
        }
        return Redirect::to('/admin/plans/membership-plan')->with('status',$response);
    }
}