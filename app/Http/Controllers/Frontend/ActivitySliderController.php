<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\PlanRepository;
use App\Miscellaneous;
use App\{Plan,User,ActivitySlider};
use Auth,Redirect,Response,DB,Validator,Image;

class ActivitySliderController extends Controller
{  
    public function index()
    {
        $sliders = ActivitySlider::get();

        return view('admin.activity_slider.index', [
            'sliders' => $sliders,
            'pageTitle' => 'Manage Activtiy Sliders'
        ]);
    }
    

    public function create()
    {
        return view('admin.activity_slider.create', [            
            'pageTitle' => 'Add New Activtiy Slider'
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
        
       $status = ActivitySlider::create($arr);

        if($status)
        {
            session(['key' => 'success']);
            session(['msg' => 'Activity Slider Created Succesfully !']);    
        }

        return redirect()->route('activity-slider');
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
        $slider = ActivitySlider::where('id',$id)->get();

        if($slider)
        {
            return view('admin.activity_slider.edit', [
                'pageTitle' => 'Edit Activity Slider',
                'slider' => $slider,
                'id' => $id
            ]);
        }

        return redirect()->route('activity-slider');   
    }

    public function update($id, Request $request)
    {
        $id = $id;
        $slider = ActivitySlider::where('id',$id)->first();
        $input = $request->except('_token');

        /* File Upload Start */
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
                return redirect('/admin/activity-slider/edit/'.$input['id'])->with('status', $image_upload);
            }    
        }
        /* File Upload End */
      
        $slider = DB::table('activity_slider')->where('id', $input['id'])->update($input);

        if($slider)
        {
            session(['key' => 'success']);
            session(['msg' => 'Activity slider Updated Succesfully !']);    
        }

        return redirect()->route('activity-slider');
    }

    public function delete($id)
    {
       $data = ActivitySlider::where('id',$id)->first();
        $data->delete();
        return redirect()->route('activity-slider');
    }

    
    /**
     * Delete Multiple Plans
     * 
     * @param Request $request
     * @return array
     */
   
}