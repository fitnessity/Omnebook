<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\SportsRepository;
use App\Repositories\SportsCategoriesRepository;
use App\Repositories\ProfessionalRepository;

use App\User;
use App\Sports;
use App\UserService;
use Auth;
use Redirect;
use Response;
use DB;
use Validator;
use Image;

use App\Miscellaneous;
use App\MailService;

class SportsController extends Controller
{   
    protected $sports;
    protected $sports_cats;
    protected $professional;

    public function __construct(SportsRepository $sports,SportsCategoriesRepository $sports_cats,ProfessionalRepository $professional)
    {
        $this->middleware('admin',['except' => ['getAjaxSportListFromCat','getAjaxHappeningNow']]);
        $this->sports = $sports;    
        $this->sports_cats = $sports_cats;
        $this->professional = $professional;
    }

    public function index()
    {   
        $loggedinAdmin = auth()->guard('admin')->user();
        
        if($loggedinAdmin){
            
            $sportsList = $this->sports->getAllSports();
            $sportCatsObj = $this->sports_cats->getAllSportsCategories();
            $sportsName = $this->sports->getAllSportsNames(1);
            $sportCats = array();

            foreach ($sportCatsObj as $key => $value) {
                $sportCats[$value->id] = $value->category_name;
            }

            return view('admin.sports.index', [
                'sports_list' => $sportsList,
                'sportCats' => $sportCats,
                'sportsName' => $sportsName,
                'pageTitle' => "Manage Sports"
            ]);

        } else {
             return Redirect::to('/admin');
        }
    }

    public function getAjaxSportListFromCat(Request $request)
    {   
        $cat_id = $request->input('cat_id'); 
        
        if($cat_id){
            $sportsList = $this->sports->getSportsFromCatId($cat_id);
        }

        if(@$sportsList)
        {
            echo json_encode(array(
                'sports_list'    => $sportsList
            ));
            die;               
        }

        echo json_encode(array(
            'sports_list'    => array()
        ));
        die;
    }
    
    public function getAjaxHappeningNow(Request $request)
    {   
        $flag = $request->input('flag');
        $sport_names = $this->sports->getAllSportsNames();
        
        if($flag){

            $professionals_list = $this->professional->getTopBookedProfessionals($flag);
        }
        if(@$professionals_list)
        {
            echo json_encode(array(
                'professionals_list'    => $professionals_list,
                'sport_names' => $sport_names
            ));
            die;
        }

        echo json_encode(array(
            'professionals_list'    => array(),
            'sport_names' => $sport_names
        ));
        die;
    }


    public function create()
    {
        $all_sports_cats = $this->sports_cats->getAllSportsCategories();
        $parent_sports = $this->sports->getParentSportsList();
        return view('admin.sports.create', [ 
            'all_sports_cats' => $all_sports_cats,           
            'parent_sports' => $parent_sports,           
            'pageTitle' => 'Add New Sport'
        ]);
    }

    public function store(Request $request)
    {     
        $loggedinAdmin = auth()->guard('admin')->user();
        if($loggedinAdmin){
            $arr = $request->all();

            if(@$arr['parent_sport_id'] > 0){
                $parentSportDetail = $this->sports->getSportDetail($arr['parent_sport_id']);
                $arr['category_id'] = explode(',',@$parentSportDetail[0]['category_id']);
            } else {
                $arr['parent_sport_id'] = NULL;
            }

            $validator = $this->sportsValidator($arr, null);
        } else {
            $response = array('danger' => 'Unauthorized access.');
            return redirect('/admin/sports')->with('status', $response);
        }


        $category_id = @$arr['category_id']?implode(",",$arr['category_id']):'';
        $arr['category_id'] = $category_id;
        
        
        if($validator->fails()) {
          $errMsg = array();
            foreach($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = end($messages);
            }
            $response = array(
                    'danger' =>  $errMsg,
            );
            return redirect()->route('create-new-sport')->with('status', $response);
        }

        if(@$arr['image']){
     
            if($request->hasFile('image')) {

                if (!file_exists(public_path('uploads/sports/thumb'))) {
                    mkdir(public_path('uploads/sports/thumb'), 0755, true);
                }

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'sports'.DIRECTORY_SEPARATOR;

                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'sports'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'380','258');

                if(@$image_upload['success'] && @$image_upload['success'] != ''){
                    $arr['image'] = @$image_upload['filename'];
                } else {
                    return redirect()->route('create-new-sport')->with('status', $image_upload);
                }                
            }
        } 
    
        $status = $this->sports->create($arr);

        if($status)
        {

            
            if($arr['parent_sport_id'] > 0){
                $ps_id = $arr['parent_sport_id'];

                $alertSportPersonsList = User::whereHas('service', function($query) use ($ps_id) {
                    $query->where('sport',$ps_id);
                })->get();

                $parent_sport = Sports::where('id',$ps_id)->first();

                if(count($alertSportPersonsList) > 0 && !empty($alertSportPersonsList)){
                    $mailObject = array();

                    foreach ($alertSportPersonsList as $key => $value) {
                        $mailObject =  array(
                            'firstname' => $value->firstname,
                            'lastname' => $value->lastname,
                            'email' => $value->email,
                            'main_sport' => $parent_sport->sport_name,
                            'sub_sport' => $arr['sport_name']
                        );

                        if(isset($value->email) && !empty($value->email)){
                            MailService::sendEmailSportCategoryChange($mailObject);
                        }

                        $mailObject = array();
                    }
                }
            }

            session(['key' => 'success']);
            session(['msg' => 'New Sport Created Succesfully !']);    
        }

        return redirect()->route('sports-list');
    }

     public function getEdit($id)
    {
        $loggedinAdmin = auth()->guard('admin')->user();
        if($loggedinAdmin){
            
            $sport_details = $this->sports->getSportDetail($id);
            $parent_sports = $this->sports->getParentSportsList($id);
            $is_parent = $this->sports->checkIsParentSport($id);
            $all_sports_cats = $this->sports_cats->getAllSportsCategories();

            return view('admin.sports.edit', [
                'id' => $id,
                'sport_details' => $sport_details?$sport_details[0]:NULL,
                'all_sports_cats' => $all_sports_cats,
                'parent_sports' => $parent_sports,
                'is_parent' => $is_parent,
                'pageTitle' => "Edit Sport"
            ]);

        } else {
             return Redirect::to('/admin');
        }
    }

    public function postEdit(Request $request)
    { 
        $loggedinAdmin = auth()->guard('admin')->user();
        if($loggedinAdmin){
            
            $input = $request->all();
            if(@$input['parent_sport_id'] > 0){
                $parentSportDetail = $this->sports->getSportDetail($input['parent_sport_id']);
                $input['category_id'] = explode(',',@$parentSportDetail[0]['category_id']);
            } else {
                $input['parent_sport_id'] = NULL;
            }            
            $validator = $this->sportsValidator($input, $input['id']);
        } else {
            $response = array('danger' => 'Unauthorized access.');
            return redirect('/admin/sports')->with('status', $response);
        }

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $sport_name = $input['sport_name']?$input['sport_name']:'';
        $parent_sport_id = $input['parent_sport_id']?$input['parent_sport_id']:NULL;
        $category_id = $input['category_id']?implode(",",$input['category_id']):'';
        $input['category_id'] = $category_id;        

        $image = '';
        if($request->hasFile('image')) {

            if (!file_exists(public_path('uploads/sports/thumb'))) {
                mkdir(public_path('uploads/sports/thumb'), 0755, true);
            }

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'sports'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'sports'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'380','258');

            if(@$image_upload['success'] && @$image_upload['success'] != ''){
                $input['image'] = @$image_upload['filename'];
            } else {
                return redirect('/admin/sports/edit/'.$input['id'])->with('status', $image_upload);
            }    
        }

        $store = $this->sports->update($input['id'],$input);
        
        if($store){
            DB::table('sports')->where('parent_sport_id', $input['id'])
                 ->update(['category_id' => $input['category_id']]);

            $response = array(
                'success' => 'Updated succesfully!',
            );
        } else {
            $response = array(
                'danger' => 'Error while updating.',
            );  
        }
        return redirect('/admin/sports/edit/'.$input['id'])->with('status', $response);
    }

    public function deactivate(Request $request){

        $is_parent = $this->sports->checkIsParentSport($request->id);
        if($is_parent == 1){
            return json_encode([
                'status' => false,
                'msg' => 'You can not delete this sport because it is having sub sports attached with it.'
            ]);   
        } else {
            $status = Sports::where('id',$request->id)->delete();
        }
        
        if($status)
        {
            return json_encode([
                'status' => true
            ]);
        }
        
        return json_encode([
            'status' => false,
            'msg' => 'Error while deleting sport.'
        ]);
    }    

    public function activate(Request $request)
    {
        $is_parent = $this->sports->checkIsParentSport($request->id);
            $status = $this->sports->update($request->id, array('is_deleted'=>'0'));
        
        if($status)
        {
            return json_encode([
                'status' => true
            ]);
        }
        
        return json_encode([
            'status' => false,
            'msg' => 'Error while deleting sport.'
        ]);
    }

    protected function sportsValidator($data, $id)
    {
        $validation = array();
        $message = array();

        $validation['sport_name'] = 'required|max:255|unique:sports,sport_name';
        $validation['category_id'] = 'required|max:11';
        $validation['description'] = 'required|max:255';
        $validation['image'] = 'sometimes|required|image|mimes:jpeg,jpg,bmp,png|max:1024';

        $message['sport_name.required'] = 'Provide a sport name';
        $message['category_id.required'] = 'Provide a category';
        $message['sport_name.unique'] = 'Sport name already taken';
        $message['description.required']= 'Provide Description';
        $message['description.max']= 'Description should not be grater than 255 character long';
        $message['image.required'] = 'Provide an image';

        if( $id && !empty($id) ) {
            $validation['sport_name'] = 'required|max:255|unique:sports,sport_name,'.$id;
        }

        return Validator::make($data, $validation, $message);
    }
}