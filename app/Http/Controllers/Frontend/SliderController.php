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
use App\Imports\ClaimImport;
use Maatwebsite\Excel\HeadingRowImport;


class SliderController extends Controller
{   
    public function index()
    {
        $sliders = Slider::get();

        return view('admin.slider.index', [
            'sliders' => $sliders,
            'pageTitle' => 'Manage Sliders'
        ]);
    }
    

    public function create()
    {
        return view('admin.slider.create', [            
            'pageTitle' => 'Add New Slider'
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
        $stext = $arr['stext'];
        $link = $arr['link'];
        

        if(@$arr['image']){
     
            if($request->hasFile('image')) {

                if (!file_exists(public_path('uploads/slider/thumb'))) {
                    mkdir(public_path('uploads/slider/thumb'), 0755, true);
                }

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'slider'.DIRECTORY_SEPARATOR;


                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'slider'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'1348','2537');

                if(@$image_upload['success'] && @$image_upload['success'] != ''){
                    $arr['image'] = @$image_upload['filename'];
                } else {
                    return redirect()->route('create-new-slider')->with('status', $image_upload);
                }                
            }
        }
        
       $status = Slider::create($arr);

        if($status)
        {
            session(['key' => 'success']);
            session(['msg' => 'Slider Created Succesfully !']);    
        }

        return redirect()->route('slider');
    }

    protected function saveValidator($data)
    {
        return Validator::make($data, [  
            'image' => 'required'         
            
        ],
        [
            'image.required' => 'Provide a Image'
          
        ]);
    }

    protected function updateValidator($data,$id)
    {
        return Validator::make($data, [            
            'image' => 'required'         
            
        ],
        [
            'image.required' => 'Provide a Image'
            
        ]);
    }

    public function edit($id)
    {
        $slider = Slider::where('id',$id)->get();

        if($slider)
        {
            return view('admin.slider.edit', [
                'pageTitle' => 'Edit Slider',
                'slider' => $slider,
                'id' => $id
            ]);
        }

        return redirect()->route('plan-list');   
    }

    public function update($id, Request $request)
    {
        $id = $id;
       
        $slider = Slider::where('id',$id)->first();
         
       $input = $request->all();


        $image = '';
        if($request->hasFile('image')) {

            if (!file_exists(public_path('uploads/slider/thumb'))) {
                mkdir(public_path('uploads/slider/thumb'), 0755, true);
            }

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'slider'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'slider'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'1348','2537');

            if(@$image_upload['success'] && @$image_upload['success'] != ''){
                $input['image'] = @$image_upload['filename'];
            } else {
                return redirect('/admin/slider/edit/'.$input['id'])->with('status', $image_upload);
            }    
        }
      
        $slider = DB::table('slider')->where('id', $input['id'])->update($input);

        if($slider)
        {
            session(['key' => 'success']);
            session(['msg' => 'slider Updated Succesfully !']);    
        }

        return redirect()->route('slider');
    }

    public function delete($id)
    {
       $data = Slider::where('id',$id)->first();
        $data->delete();
        return redirect()->route('slider');
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