<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\PlanRepository;
use App\Miscellaneous;
use App\Plan;
use App\BusinessClaim;
use App\CompanyInformation;
use App\UserService;
use App\Sports;
use App\User;
use Auth;
use Redirect;
use Response;
use DB;
use Validator;
use Image;
use Excel;
use App\Slider;
use App\Online;
use App\Imports\ClaimImport;
use Maatwebsite\Excel\HeadingRowImport;


class OnlineController extends Controller
{   

    public function index()
    {
        $onlines = Online::get();

        return view('admin.online.index', [
            'onlines' => $onlines,
            'pageTitle' => 'Manage Online Classes & Activities'
        ]);
    }
    

    public function create()
    {
        return view('admin.online.create', [            
            'pageTitle' => 'Add New Online Classes & Activities'
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
        $heading = $arr['heading'];
        $duration = $arr['duration'];
        $level = $arr['level'];
        $timings = $arr['timings'];
        $price = $arr['price'];
        

        if(@$arr['image']){
     
            if($request->hasFile('image')) {

                if (!file_exists(public_path('uploads/online/thumb'))) {
                    mkdir(public_path('uploads/online/thumb'), 0755, true);
                }

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'online'.DIRECTORY_SEPARATOR;


                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'online'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'668','667');

                if(@$image_upload['success'] && @$image_upload['success'] != ''){
                    $arr['image'] = @$image_upload['filename'];
                } else {
                    return redirect()->route('create-new-online')->with('status', $image_upload);
                }                
            }
        }
        
       $status = Online::create($arr);

        if($status)
        {
            session(['key' => 'success']);
            session(['msg' => 'Online Classes & Activities Created Succesfully !']);    
        }

        return redirect()->route('online');
    }

    protected function saveValidator($data)
    {
        return Validator::make($data, [  
            'image' => 'required',          
            'title' => 'required|max:255',
            'heading' => 'required|max:255',
            'duration' => 'required|max:255',
            'level' => 'required|max:255',
            'timings' => 'required|max:255',
            'price' => 'required|integer'
        ],
        [
            'image.required' => 'Provide a Image',
            'title.required' => 'Provide a Title',
            'heading.required' => 'Provide a Heading',
            'duration.required' => 'Provide a Duration',
            'level.required' => 'Provide a Level',
            'timings.required' => 'Provide a Timings',
            'price.required' => 'Provide a Price per month',
        ]);
    }

    protected function updateValidator($data,$id)
    {
        return Validator::make($data, [            
            'image' => 'required',          
            'title' => 'required|max:255',
            'heading' => 'required|max:255',
            'duration' => 'required|max:255',
            'level' => 'required|max:255',
            'timings' => 'required|max:255',
            'price' => 'required|integer'
        ],
        [
            'image.required' => 'Provide a Image',
            'title.required' => 'Provide a Title',
            'heading.required' => 'Provide a Heading',
            'duration.required' => 'Provide a Duration',
            'level.required' => 'Provide a Level',
            'timings.required' => 'Provide a Timings',
            'price.required' => 'Provide a Price per month',
        ]);
    }

    public function edit($id)
    {
        $online = Online::where('id',$id)->get();

        if($online)
        {
            return view('admin.online.edit', [
                'pageTitle' => 'Edit Online Classes & Activities',
                'online' => $online,
                'id' => $id
            ]);
        }

        return redirect()->route('plan-list');   
    }

    public function update($id, Request $request)
    {
        $id = $id;
       
        $online = Online::where('id',$id)->first();
         
       $input = $request->all();

        $image = '';
        if($request->hasFile('image')) {

            if (!file_exists(public_path('uploads/online/thumb'))) {
                mkdir(public_path('uploads/online/thumb'), 0755, true);
            }

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'online'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'online'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'668','667');

            if(@$image_upload['success'] && @$image_upload['success'] != ''){
                $input['image'] = @$image_upload['filename'];
            } else {
                return redirect('/admin/online/edit/'.$input['id'])->with('status', $image_upload);
            }    
        }
              
        $online = DB::table('online')->where('id', $input['id'])->update($input);

        if($online)
        {
            session(['key' => 'success']);
            session(['msg' => 'Online Classes & Activities Updated Succesfully !']);    
        }

        return redirect()->route('online');
    }

    public function delete($id)
    {
       $data = Online::where('id',$id)->first();
        $data->delete();
        return redirect()->route('online');
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