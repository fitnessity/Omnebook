<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Miscellaneous;
use App\User;
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


class TrainerController extends Controller
{   
    /*protected $plan;
    public $error = '';

    public function __construct(PlanRepository $plan)
    {
        $this->middleware('admin');
        $this->plan = $plan;    
    }*/

    public function index()
    {
        $trainers = Trainer::get();

        return view('admin.trainer.index', [
            'trainers' => $trainers,
            'pageTitle' => 'Manage Trainers'
        ]);
    }
    

    public function create()
    {
        return view('admin.trainer.create', [            
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

        $name = $arr['name'];
       
        if(@$arr['image']){
     
            if($request->hasFile('image')) {

                if (!file_exists(public_path('uploads/trainer/thumb'))) {
                    mkdir(public_path('uploads/trainer/thumb'), 0755, true);
                }

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'trainer'.DIRECTORY_SEPARATOR;


                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'trainer'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'589','346');

                if(@$image_upload['success'] && @$image_upload['success'] != ''){
                    $arr['image'] = @$image_upload['filename'];
                } else {
                    return redirect()->route('create-new-trainer')->with('status', $image_upload);
                }                
            }
        }
        
       $status = Trainer::create($arr);

        if($status)
        {
            session(['key' => 'success']);
            session(['msg' => 'Trainer Created Succesfully !']);    
        }

        return redirect()->route('trainer');
    }

    protected function saveValidator($data)
    {
        return Validator::make($data, [  
            'image' => 'required',          
            'name' => 'required|max:255',
            
        ],
        [
            'image.required' => 'Provide a Image',
            'name.required' => 'Provide a Title',
            
        ]);
    }

    protected function updateValidator($data,$id)
    {
        return Validator::make($data, [            
            'image' => 'required',          
            'name' => 'required|max:255',
            
        ],
        [
            'image.required' => 'Provide a Image',
            'name.required' => 'Provide a Title',
           
        ]);
    }

    public function edit($id)
    {
        $trainer = Trainer::where('id',$id)->get();

        if($trainer)
        {
            return view('admin.trainer.edit', [
                'pageTitle' => 'Edit Trainer',
                'trainer' => $trainer,
                'id' => $id
            ]);
        }

        return redirect()->route('plan-list');   
    }

    public function update($id, Request $request)
    {
        $id = $id;
       
        $trainer = Trainer::where('id',$id)->first();
         
       $input = $request->all();

        /* File Upload Start */
        $image = '';
        if($request->hasFile('image')) {

            if (!file_exists(public_path('uploads/trainer/thumb'))) {
                mkdir(public_path('uploads/trainer/thumb'), 0755, true);
            }

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'trainer'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'trainer'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'589','346');

            if(@$image_upload['success'] && @$image_upload['success'] != ''){
                $input['image'] = @$image_upload['filename'];
            } else {
                return redirect('/admin/trainer/edit/'.$input['id'])->with('status', $image_upload);
            }    
        }
        /* File Upload End */
       
       // update:where()($input['id'],$input);
       
        $trainer = DB::table('trainer')->where('id', $input['id'])->update($input);

        if($trainer)
        {
            session(['key' => 'success']);
            session(['msg' => 'Trainer Updated Succesfully !']);    
        }

        return redirect()->route('trainer');
    }

    public function delete($id)
    {
       $data = Trainer::where('id',$id)->first();
        $data->delete();
        return redirect()->route('trainer');
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