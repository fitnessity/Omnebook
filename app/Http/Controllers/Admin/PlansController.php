<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\{PlanRepository,SportsRepository,FeaturesRepository};
use Auth;
use Redirect;
use Response;
use DB;
use Validator;
use Image;
use Storage;
use App\Imports\ClaimImport;
use Maatwebsite\Excel\HeadingRowImport;
use App\{BusinessCompanyDetail,BusinessExperience,BusinessInformation,BusinessTerms,BusinessVerified,BusinessServices,BusinessServicesMap,BusinessPriceDetails,BusinessActivityScheduler,PagePost,PagePostSave,PageLike,BusinessReview,Miscellaneous,BusinessPriceDetailsAges,MailService,Plan,BusinessClaim,CompanyInformation,UserService,BusinessService,Sports,User,SGMailService};
use Illuminate\Http\Exceptions\HttpResponseException;

class PlansController extends Controller
{   
    protected $plan;
    public $error = '';
    protected $sports;
    protected $features;

    public function __construct(PlanRepository $plan ,SportsRepository $sports ,FeaturesRepository $features)
    {
        $this->middleware('admin');
        $this->plan = $plan;    
        $this->sports = $sports;
        $this->features = $features;
    }

    public function index()
    {
        $plans = $this->plan->getAllPlans();

        return view('admin.plan.index', [
            'plans' => $plans,
            'pageTitle' => 'Manage Membership Plans'
        ]);
    }

    public function create()
    {
        $features = $this->features->getAllFeatures();
        return view('admin.plan.create', [      
            'features' => $features,       
            'pageTitle' => 'Add New Membership Plan'

        ]);
    }

    public function store(Request $request)
    {
        $features = $this->features->getAllFeatures();
        $myArray = [];
        foreach ($features as $key=>$f){
            $myArray[$f->id] = $request->input('featureValue_'.$f->id);
        }
        $image = $request->has('image') ? $request->file('image')->store('plan') : ''; 
        $plan = $this->plan->create([
            'title' => $request->title,
            'description' => $request->description,
            'price_per_month' => $request->price_per_month,
            'price_per_year' => $request->price_per_year,
            'image' => $image,
            'featurs_details' => json_encode($myArray),
            'heading' => $request->heading]);

        if($plan)
        {
            session(['key' => 'success']);
            session(['msg' => 'Membership Plan Created Succesfully !']);    
        }

        return redirect()->route('plan-list');
    }

    protected function saveValidator($data)
    {
        return Validator::make($data, [            
            'title' => 'required|max:255|unique:membership_plans',
            'price_per_month' => 'required|integer',
            'price_per_year' =>'required|integer',
            'description' =>'required'
        ],
        [
            'title.required' => 'Provide a title',
            'price_per_month.required' => 'Provide a Price per month',
            'price_per_year.required' => 'Provide a  Price per year',
            'description.required' => 'Provide a description',
        ]);
    }

    protected function updateValidator($data,$id)
    {
        return Validator::make($data, [            
            'title' => 'required|max:255|unique:membership_plans,title,'.$id,
            'price_per_month' => 'required|integer',
            'price_per_year' =>'required|integer',
            'description' =>'required'
        ],
        [
            'title.required' => 'Provide a title',
            'price_per_month.required' => 'Provide a Price per month',
            'price_per_year.required' => 'Provide a Quote per month',
            'description.required' => 'Provide a description',
        ]);
    }

    public function edit($id)
    {
        $features = $this->features->getAllFeatures();
        $plan = $this->plan->getById($id);
        if($plan){
            return view('admin.plan.edit', [
                'pageTitle' => 'Edit Membership Plan',
                'plan' => $plan,
                'features' => $features
            ]);
        }

        return redirect()->route('plan-list');   
    }

    public function update($id, Request $request)
    {
        /*print_r($request->all());*/
        $features = $this->features->getAllFeatures();
        $myArray = [];
        foreach ($features as $key=>$f){
            $myArray[$f->id] = $request->input('featureValue_'.$f->id);
        }

        $image = $request->file('image') ? $request->file('image')->store('plan') : $request->hiddenimage; 
        $status = $this->plan->update($id,[
            'title' => $request->title,
            'description' => $request->description,
            'price_per_month' => $request->price_per_month,
            'price_per_year' => $request->price_per_year,
            'image' => $image,
            'featurs_details' =>  json_encode($myArray),
            'heading' => $request->heading]);

        if($status)
        {
            session(['key' => 'success']);
            session(['msg' => 'Membership Plan Updated Succesfully !']);    
        }

        return redirect()->route('plan-list');
    }

    public function deactivate(Request $request)
    {
        $status = $this->plan->update($request->id, array('is_deleted'=>'1'));

        if($status)
        {
            return json_encode([
                'status' => true
            ]);
        }
        
        return json_encode([
            'status' => false
        ]);
    }

    public function activate(Request $request)
    {
        $status = $this->plan->update($request->id, array('is_deleted'=>'0'));

        if($status)
        {
            return json_encode([
                'status' => true
            ]);
        }
        
        return json_encode([
            'status' => false
        ]);
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
    

    public function businessUnclaim()
    {
        $claims = CompanyInformation::where('is_verified',0)->get();

        return view('admin.plan.unclaim', [
            'claims' => $claims,
            'pageTitle' => 'Manage Business Claim'
        ]);
    }
    
    public function businessClaim(Request $request)
    {
        // $claims = CompanyInformation::where('claim_business_status',1)->get();
        $claims = CompanyInformation::where('is_verified',1)->get();
        foreach($claims as $value){
            $user = User::where('id',$value['user_id'])->first();
            $value['company_user_name'] = @$user->firstname.' '.@$user->lastname; 
            $services = UserService::where('company_id',$value['id'])->get();
            $str = '';
            foreach($services as $key2=>$value2){
               $sport =Sports::where('id',$value2['sport'])->first();
               $str = $str.$sport['sport_name'];
               if(($key2+1) != count($services)){
                   $str = $str.', ';
               }
           }
           $value['activity']=$str;
        }
         return view('admin.plan.claim', [
            'claims' => $claims,
            'pageTitle' => 'Manage Business Claim'
        ]);
    }
    
    public function addBusinessClaim(Request $request)
    {
        if($request->hasFile('import_file')){
			$ext = $request->file('import_file')->getClientOriginalExtension();
			if($ext != 'csv' && $ext != 'csvx' && $ext != 'xls' && $ext != 'xlsx' )
			{
				//Session::flash('error',"File format is not supported.");
				//return redirect()->back();
				return response()->json(['status'=>500,'message'=>'File format is not supported.']);
			}
			ini_set('max_execution_time', 10000); 
			$headings = (new HeadingRowImport)->toArray($request->file('import_file'));
			/*print_r($headings);*/
            if(!empty($headings)){
                foreach($headings as $key => $row) {
                    $firstrow = $row[0];
                   // print_r($row);
                    if(  $firstrow[0] != 'business_name' || $firstrow[1] != 'activity' 
                        || $firstrow[2] != 'location'|| $firstrow[3] != 'website' || $firstrow[4] != 'phone'|| $firstrow[5] !=    'address') 
                    {
                        $this->error = 'Problem in header.';
                        break;
                    }
                }
            }
            if($this->error != '')
            {
                return response()->json(['status'=>500,'message'=>$this->error]);
            }
            \Session::forget('user');
            \Session::forget('notuser');
            Excel::import(new ClaimImport, $request->file('import_file'));
            $repeat_data=\Session::get('user') != null ? \Session::get('user') : [];
            $not_repeat_data=\Session::get('notuser') != null ? \Session::get('notuser') : [];
        }

        if($this->error != '')
        {
        	return response()->json(['status'=>500,'message'=>$this->error]);
        }
        else{
            return response()->json(['status'=>200,'message'=>'File imported Successfully','repeat_data'=>$repeat_data,'not_repeat_data'=>$not_repeat_data]);
        }
    }
    
    public function ignoreReplaceBusinessClaim(Request $request)
    {
        $searchIDs = json_decode($request->searchIDs);
       
        if($request->ignore_replace == 'ignore')
        {
            $d = json_decode($request->datas);
            foreach($d as $key=>$value){
               // print_r($value);
                if(in_array($key,$searchIDs))
                    $business_claim = new BusinessClaim();
                else
                    $business_claim = BusinessClaim::where('website',$value[3])->first();
				$business_claim->business_name = ucfirst($value[0]);
				$business_claim->activity = ($value[1]);
				$business_claim->location = ($value[2]);
				$business_claim->website = ($value[3]);
				$business_claim->phone = ($value[4]);
				$business_claim->address = ($value[5]);
				$business_claim->save();
            }
                return response()->json(['status'=>200,'message'=>'File ignored Successfully']);
    
        }
        else{
            $d = json_decode($request->datas);
            foreach($d as $key=>$value){
                if(in_array($key,$searchIDs))
                    $business_claim = BusinessClaim::where('website',$value[3])->first();
                else
                    $business_claim = new BusinessClaim();
               // $business_claim = BusinessClaim::where('business_name',$value[0])->first();
				$business_claim->business_name = ucfirst($value[0]);
				$business_claim->activity = ($value[1]);
				$business_claim->location = ($value[2]);
				$business_claim->website = ($value[3]);
				$business_claim->phone = ($value[4]);
				$business_claim->address = ($value[5]);
				$business_claim->save();
            }
                return response()->json(['status'=>200,'message'=>'File replaced Successfully']);
    
        }  
    }

    public function deleteClaim($id){
        $data = BusinessCompanyDetail::where('cid',$id)->first();
        if( $data != ''){
            $delete = BusinessCompanyDetail::where('id',$data->id)->delete();
        }
       
        $dd = BusinessService::where('cid',$id)->first();
        if($dd != ''){
            $delete2 = BusinessService::where('id',$dd->id)->delete();
        }
        
        $save = CompanyInformation::where('id',$id)->delete();
        if($save){
            session(['key' => 'success']);
            session(['msg' => 'Delete Succesfully !']); 
            return redirect('admin/unclaimbusiness');
        }
    }

    public function edit_unclaim($id){
        $data = CompanyInformation::where('id',$id)->first();
        $bus_service = BusinessService::where('cid',$id)->first();
        $mon_shift_start = $mon_shift_end = $tue_shift_start = $tue_shift_end = $wed_shift_start = $wed_shift_end = $thu_shift_start = $thu_shift_end = "";
        $fri_shift_start = $fri_shift_end = $sat_shift_start = $sat_shift_end = $sun_shift_start = $sun_shift_end = ""; 
        $chk = "not";
        if($bus_service != ''){
            $chk = "yes";
            if($bus_service['mon_shift_start']  != '') {
                $mon_shift_start = $bus_service['mon_shift_start'];
            }
            if($bus_service['mon_shift_end']  != '') {
                $mon_shift_end = $bus_service['mon_shift_end'];
            }
            if($bus_service['tue_shift_start'] != '') {
                $tue_shift_start = $bus_service['tue_shift_start'];
            }
            if($bus_service['tue_shift_end'] != '') {
                $tue_shift_end = $bus_service['tue_shift_end'];
            }
            if($bus_service['wed_shift_start']  != '') {
                $wed_shift_start = $bus_service['wed_shift_start'];
            }
            if($bus_service['wed_shift_end'] != '')  {
                $wed_shift_end = $bus_service['wed_shift_end'];
            }
            if($bus_service['thu_shift_start']  != '') {
                $thu_shift_start = $bus_service['thu_shift_start'];
            }
            if($bus_service['thu_shift_end'] != '')  {
                $thu_shift_end = $bus_service['thu_shift_end'];
            }
            if($bus_service['fri_shift_start'] != '') {
                $fri_shift_start = $bus_service['fri_shift_start'];
            }
            if($bus_service['fri_shift_end'] != '') {
                $fri_shift_end = $bus_service['fri_shift_end'];
            }
            if($bus_service['sat_shift_start'] != '')  {
                $sat_shift_start = $bus_service['sat_shift_start'];
            }
            if($bus_service['sat_shift_end'] != '')  {
                $sat_shift_end = $bus_service['sat_shift_end'];
            }
            if($bus_service['sun_shift_start'] != '')  {
                $sun_shift_start = $bus_service['sun_shift_start'];
            }
            if($bus_service['sun_shift_end'] != '') {
                $sun_shift_end = $bus_service['sun_shift_end'];
            }
        }
        
        return view('admin.plan.unclaim_edit', [
            'data' => $data,  
            'mon_shift_start' => $mon_shift_start,
            'mon_shift_end' =>$mon_shift_end,
            'tue_shift_start' => $tue_shift_start, 
            'tue_shift_end' =>$tue_shift_end,
            'wed_shift_start' => $wed_shift_start,
            'wed_shift_end' =>$wed_shift_end ,
            'thu_shift_start' =>$thu_shift_start,
            'thu_shift_end' =>$thu_shift_end,
            'fri_shift_start' =>$fri_shift_start,
            'fri_shift_end' =>$fri_shift_end,
            'sat_shift_start' =>$sat_shift_start,
            'sat_shift_end' =>$sat_shift_end,
            'sun_shift_start' =>$sun_shift_start,
            'sun_shift_end' =>$sun_shift_end,
            'chk' =>$chk,
            'pageTitle' => 'Edit Unclaim Business'
        ]);
    }

    public function update_unclaim(Request $request)
    {   
        $address = '';
        $data['lat']  = NULL;
        $data['lng']  = NULL;
        $address .=  @$request->street_addr;
        if($request->addi_addr != ''){
            $address .= ', '.@$request->addi_addr;
        }

        if( $address != ''){
            $data['lat'] = $request->lat; 
            $data['lng'] = $request->lon;
        }
        

        CompanyInformation::where('id',$request->cid)->update(['company_name'=>$request->bname,'dba_business_name'=>$request->bname,'business_phone'=>@$request->phone,'state'=>@$request->state,'website'=>@$request->website,'business_email'=>@$request->email,'zip_code'=>@$request->zip,'address'=>@$address,'city'=>@$request->city,'country'=>@$request->country,'about_company'=>@$request->business_desc,'latitude' => $data['lat'],'longitude' => $data['lng']]);

        BusinessCompanyDetail::where('id',$request->cid)->update(['Companyname'=>$request->bname,'Phonenumber'=>@$request->phone,'State'=>@$request->state,'Emailb'=>@$request->email,'ZipCode'=>@$request->zip,'Address'=>@$address,'City'=>@$request->city,'Aboutcompany'=>@$request->business_desc,'country'=>@$request->country]);

        if($request->chk == 'yes'){
            BusinessService::where('cid',$request->cid)->update(['mon_shift_start' =>  @$request->mon_shift_start,'mon_shift_end'=>  @$request->mon_shift_end,  'tue_shift_start'=>  @$request->tue_shift_start,'tue_shift_end'=>  @$request->tue_shift_end,'wed_shift_start'=>  @$request->wed_shift_start, 'wed_shift_end'=>  @$request->wed_shift_end, 'thu_shift_start'=>  @$request->thu_shift_start, 'thu_shift_end'=>  @$request->thu_shift_end,'fri_shift_start'=>  @$request->fri_shift_start,'fri_shift_end'=>  @$request->fri_shift_end,'sat_shift_start'=>  @$request->sat_shift_start,'sat_shift_end'=>  @$request->sat_shift_end,'sun_shift_start'=>  @$request->sun_shift_start, 'sun_shift_end' =>  @$request->sun_shift_end]);
        }else{
            $bs = new BusinessService;
            $bs->cid = $request->cid;
            $bs->mon_shift_start =  @$request->mon_shift_start;
            $bs->mon_shift_end   =  @$request->mon_shift_end;  
            $bs->tue_shift_start =  @$request->tue_shift_start;
            $bs->tue_shift_end   =  @$request->tue_shift_end;  
            $bs->wed_shift_start =  @$request->wed_shift_start;
            $bs->wed_shift_end   =  @$request->wed_shift_end;
            $bs->thu_shift_start =  @$request->thu_shift_start;
            $bs->thu_shift_end   =  @$request->thu_shift_end;
            $bs->fri_shift_start =  @$request->fri_shift_start;
            $bs->fri_shift_end   =  @$request->fri_shift_end;
            $bs->sat_shift_start =  @$request->sat_shift_start;
            $bs->sat_shift_end   =  @$request->sat_shift_end;
            $bs->sun_shift_start =  @$request->sun_shift_start;
            $bs->sun_shift_end   =  @$request->sun_shift_end;
            $bs->hours_opt       =  'Open on selected hours';
            $bs->save();
        }
       
        session(['key' => 'success']);
        session(['msg' => 'Unclaim Business Updated Succesfully !']);    
        return redirect()->route('businessUnclaim');
    }

    public function manual_add_unclaim_business()
    {
        return view('admin.plan.manual-add-unclaim-business', [            
            'pageTitle' => 'Unclaimed Manual Business Information Upload'
        ]);
    }

    public function add_manual(Request $request)
    {
        $address = '';
        $data['lat']  = NULL;
        $data['lng']  = NULL;
        $address .=  @$request->street_addr;
        if($request->addi_addr != ''){
            $address .= ', '.@$request->addi_addr;
        }
         
        if($address != ''){
            $data['lat'] = $request->lat; 
            $data['lng'] = $request->lon;
        }

        $bc = new CompanyInformation;
        $bc->company_name = $request->bname;
        $bc->dba_business_name = $request->bname;
        $bc->business_phone = @$request->phone;
        $bc->address = $address ;
        $bc->city = @$request->city;
        $bc->state = @$request->state;
        $bc->zip_code = @$request->zip;
        $bc->website = @$request->website;
        $bc->business_email = @$request->email;
        $bc->country = @$request->country;
        $bc->about_company = @$request->business_desc;
        $bc->latitude = $data['lat'];
        $bc->longitude = $data['lng'];
        $bc->is_verified= 0;
        $bc->save();

        $bcd = new BusinessCompanyDetail;
        $bcd->cid = $bc->id;
 	    $bcd->Companyname = $request->bname;	
        $bcd->Phonenumber = @$request->phone;
        $bcd->Address = $address ;
        $bcd->City = @$request->city;
        $bcd->State = @$request->state;
        $bcd->ZipCode = @$request->zip;
        $bc->Country = @$request->country;
        $bcd->Emailb = @$request->email;
        $bcd->Aboutcompany = @$request->business_desc;
        $bcd->save();

        $bs = new BusinessService;
        $bs->cid = $bc->id;
        $bs->mon_shift_start =  @$request->mon_shift_start;
        $bs->mon_shift_end   =  @$request->mon_shift_end;  
        $bs->tue_shift_start =  @$request->tue_shift_start;
        $bs->tue_shift_end   =  @$request->tue_shift_end;  
        $bs->wed_shift_start =  @$request->wed_shift_start;
        $bs->wed_shift_end   =  @$request->wed_shift_end;
        $bs->thu_shift_start =  @$request->thu_shift_start;
        $bs->thu_shift_end   =  @$request->thu_shift_end;
        $bs->fri_shift_start =  @$request->fri_shift_start;
        $bs->fri_shift_end   =  @$request->fri_shift_end;
        $bs->sat_shift_start =  @$request->sat_shift_start;
        $bs->sat_shift_end   =  @$request->sat_shift_end;
        $bs->sun_shift_start =  @$request->sun_shift_start;
        $bs->sun_shift_end   =  @$request->sun_shift_end;
        $bs->hours_opt       =  'Open on selected hours';
        $bs->save();


        $email_detail = array(
            'companydata' => $bc,
            'email' => @$request->email);
        SGMailService::sendEmailToCustomerforClaim($email_detail);
        
        session(['key' => 'success']);
        session(['msg' => 'New Unclaim Business Added Succesfully !']); 
        return redirect()->route('businessUnclaim');
    }

    public function add_activity($id){
        return view('admin.plan.add_service', [            
            'pageTitle' => '',
            'cid'=>$id,
        ]);
    }

    public function edit_services($id, $cid){
        $business_price_ages =[];
        $business_service = BusinessServices::where('id', $id)->get();
        $business_service = isset($business_service[0]) ? $business_service[0] : [];
        if(!empty($business_service)){
            $business_price = BusinessPriceDetails::where('cid', $cid)->where('serviceid', $business_service['id'])->get();
            $business_price = isset($business_price) ? $business_price : [];
            
            $business_activity = BusinessActivityScheduler::where('cid', $cid)->where('serviceid', $business_service['id'])->get();
            $business_activity = isset($business_activity) ? $business_activity : [];
            $business_price_ages = BusinessPriceDetailsAges::where('cid', $cid)->where('serviceid', $business_service['id'])->get();
            $business_price_ages = isset($business_price_ages) ? $business_price_ages : [];
        }
        else
        {
            $business_price = []; $business_activity=[];$business_price_ages=[];
        }
        $sports_names = $this->sports->getAllSportsNames();
        $approve = []; //Evidents::where('user_id', $loggedinUser['id'])->get();
        $serviceType = Miscellaneous::businessType();
        $programType = Miscellaneous::programType();
        $programFor = Miscellaneous::programFor();
        $numberOfPeople = Miscellaneous::numberOfPeople();
        $ageRange = Miscellaneous::ageRange();
        $expLevel = Miscellaneous::expLevel();
        $serviceLocation = Miscellaneous::serviceLocation();
        $pFocuses = Miscellaneous::pFocuses();
        $duration = Miscellaneous::duration();
        $servicePriceOption = Miscellaneous::servicePriceOption();
        $specialDeals = Miscellaneous::specialDeals();
        return view('admin.plan.edit_service', [
            'pageTitle' => '',
            'sports_names' => $sports_names,
            'serviceType' => $serviceType,
            'programType' => $programType,
            'programFor' => $programFor,
            'serviceLocation' => $serviceLocation,
            'business_service' => $business_service,
            'business_activity' => $business_activity,
            'business_price' => $business_price,
            'business_price_ages' => $business_price_ages,
        ]);
    }

    public function list_activity($id){
		//DB::enableQueryLog();
        $companyInfo = CompanyInformation::where('id', $id)->orderBy('id', 'DESC')->get();
	   $companyservice = BusinessServices::where('cid', $id)->orderBy('id', 'DESC')->get();
        return view('admin.plan.list_service', [            
            'pageTitle' => '',
            'companyInfo' => $companyInfo,
            'companyservice' => $companyservice
        ]);
    }

    public function update_services(Request $request){
        //echo "<pre>"; print_r($request->all());exit();
        $pay_chk = $pay_session_type = $pay_session = $pay_price = $pay_discountcat = $pay_discounttype = $pay_estearn = $pay_setnum = $pay_setduration = $pay_after = $recurring_price= $recurring_every= $recurring_duration= $fitnessity_fee= $is_recurring ="";
        $pay_discount = 0;
        $profile_picture = "";
        $datadayimg = array();
        $comdata = CompanyInformation::where('id',$request->cid)->first();
        if($request->hidd_service_type =='experience') {
            if ($request->hasFile('servicepic')) {
            	/*echo "service";*/
                $gallery_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR ;
                $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
                $image_upload = Miscellaneous::uploadPhotoGallery($request->servicepic, $gallery_upload_path, 1, $thumb_upload_path, 130, 100);
            
                if($image_upload['success'] == true) {
                	/*echo "success";*/
                    $profile_picture = $image_upload['filename'];
                    /*print_r( $profile_picture);*/
                }
            } else {
                $profile_picture = $request->oldservicepic;
                /* print_r( $profile_picture);*/
            }
            if($request->hasfile('dayplanpic'))
            {
                $no=1;
                foreach($request->file('dayplanpic') as $file)
                {
                    $name = time().$no.'.'.$file->extension();
                    $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
                    $file->move($thumb_upload_path, $name);  
                    $datadayimg[] = $name;  
                    $no++;
                }
            }
        } else {
            if ($request->hasFile('servicepic')) {
                $gallery_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR ;
                $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
                $image_upload = Miscellaneous::uploadPhotoGallery($request->servicepic, $gallery_upload_path, 1, $thumb_upload_path, 130, 100);
                if($image_upload['success'] == true) {
                    $profile_picture = $image_upload['filename'];
                }
            } else {
                $profile_picture = $request->oldservicepic;
            }
        }

        // experience feild
        $notincluded_thing =  $included_thing = $frm_wear = $safe_varification = $days_title = $days_desc = $days_dayplanpic = '';
        if(isset($request->frm_included_things) && !empty($request->frm_included_things)) {
            $included_thing = @implode(",",$request->frm_included_things);    
        }
        if(isset($request->frm_notincluded_things) && !empty($request->frm_notincluded_things)) {
            $notincluded_thing = @implode(",",$request->frm_notincluded_things);    
        }
        if(isset($request->frm_wear) && !empty($request->frm_wear)) {
            $frm_wear = @implode(",",$request->frm_wear);    
        }
        if(isset($request->id_proof) && !empty($request->id_proof)) {
            $safe_varification='id_proof';
        }
        if(isset($request->id_vaccine) && !empty($request->id_vaccine)) {
            $safe_varification .=',id_vaccine';
        }
        if(isset($request->id_covid) && !empty($request->id_covid)) {
            $safe_varification .=',id_covid';
        }
        if(isset($request->days_title) && !empty($request->days_title)) {
            $days_title = json_encode($request->days_title);
        }
        if(isset($request->days_description) && !empty($request->days_description)) {
            $days_desc = json_encode($request->days_description);
        }
        if(isset($request->dayplanpic) && !empty($request->dayplanpic)) {
            $days_dayplanpic = json_encode($datadayimg);
        }


        $servicetype = $servicelocation = $programfor = $agerange = "";
        $experiencelevel = $servicefocuses = $teachingstyle = $cnumberofpeople= "";
        $numberofpeople = 1;
        if(isset($request->frm_servicetype) && !empty($request->frm_servicetype)) {
            $servicetype = @implode(",",$request->frm_servicetype);    
        }
        if(isset($request->frm_servicelocation) && !empty($request->frm_servicelocation)) {
            $servicelocation = @implode(",",$request->frm_servicelocation);    
        }
        if(isset($request->frm_programfor) && !empty($request->frm_programfor)) {
            $programfor = @implode(",",$request->frm_programfor);    
        }
        if(isset($request->frm_agerange) && !empty($request->frm_agerange)) {
            $agerange = @implode(",",$request->frm_agerange);    
        }
        if(isset($request->frm_numberofpeople) && !empty($request->frm_numberofpeople)) {
            $numberofpeople = @implode(",",$request->frm_numberofpeople);    
        }
        if(isset($request->frm_experience_level) && !empty($request->frm_experience_level)) {
            $experiencelevel = @implode(",",$request->frm_experience_level);    
        }
        if(isset($request->frm_servicefocuses) && !empty($request->frm_servicefocuses)) {
            $servicefocuses = @implode(",",$request->frm_servicefocuses);    
        }
        if(isset($request->frm_teachingstyle) && !empty($request->frm_teachingstyle)) {
            $teachingstyle = @implode(",",$request->frm_teachingstyle);    
        }

        /*echo $profile_picture;exit();*/
        if($request->hidd_service_type != 'experience'){
            BusinessServices::where('cid',$request->cid)->where('id',$request->sid)->update(['service_type'=>$request->hidd_service_type,
                'sport_activity'=> @$request->frm_servicesport ,
                'program_name'=> @$request->frm_programname,  
                'program_desc' => @$request->frm_programdesc,
                'profile_pic' => @$profile_picture,
                'select_service_type' => $servicetype,
                'activity_location' => $servicelocation,
                'activity_for' => $programfor,
                'age_range' =>  $agerange ,
                'group_size' =>  $numberofpeople,
                'difficult_level' => $experiencelevel,
                'instructor_habit' => $teachingstyle, 
                'activity_experience' =>  $servicefocuses,
                'activity_value' => @$request->activity_value,
                'activity_meets' => @$request->frm_class_meets,
                'starting' => @$request->starting,
                'schedule_until' => @$request->frm_schedule_until,
                'meetup_location' => @$request->meetup_location,'serviceid' => 0]);
        }else{
            BusinessServices::where('cid',$request->cid)->where('id',$request->sid)->update(['included_items' => $included_thing,'notincluded_items' => $notincluded_thing,'bring_wear' => $frm_wear,'req_safety' => $safe_varification,'days_plan_title' => $days_title,'days_plan_desc' => $days_desc,'days_plan_img' => $days_dayplanpic,'service_type'=>$request->hidd_service_type,'sport_activity'=> @$request->frm_servicesport ,'program_name'=> @$request->frm_programname,   'program_desc' => @$request->frm_programdesc,'profile_pic' => @$profile_picture,'select_service_type' => $servicetype,'activity_location' => $servicelocation, 'activity_for' => $programfor,'age_range' =>  $agerange ,'group_size' =>  $numberofpeople,'difficult_level' => $experiencelevel,'instructor_habit' => $teachingstyle,'activity_experience' =>  $servicefocuses,'activity_value' => @$request->activity_value,'activity_meets' => @$request->frm_class_meets,'starting' => @$request->starting,'schedule_until' => @$request->frm_schedule_until,'meetup_location' => @$request->meetup_location,'serviceid' => 0]);
        }

        $paycount = count($request->category_title);
        if($paycount > 0) {
            BusinessPriceDetailsAges::where('cid', $request->cid)->where('serviceid', $request->sid)->delete();
            BusinessPriceDetails::where('cid', $request->cid)->where('serviceid', $request->sid)->delete();
            for($i=0; $i < $paycount; $i++) {
                $bpd = new BusinessPriceDetailsAges;
                $bpd->cid= $request->cid;
                $bpd->serviceid= $request->sid;
                if($comdata->is_verified == 0){
                    $bpd->userid = Auth::user()->id;
                }else{
                    $bpd->userid = $comdata->user_id;
                } 
                $bpd->category_title = isset($request->category_title[$i]) ? $request->category_title[$i] : '';
                $bpd->save();
                $age_cnt = $request->input('ages_count'.$i);
                if($age_cnt >= 0){
                    for($y=0; $y <= $age_cnt; $y++) {
                        if($request->input('is_recurring_adult_'.$i.$y) == 1){
                            $adultrecurring_price = $request->input('recurring_price_adult_'.$i.$y);
                            $adultrecurring_run_auto_pay = $request->input('run_auto_pay_adult_'.$i.$y);
                            $adultrecurring_cust_be_charge = $request->input('cust_be_charge_adult_'.$i.$y);
                            $adultrecurring_every_time_num = $request->input('every_time_num_adult_'.$i.$y);
                            $adultrecurring_every_time = $request->input('every_time_adult_'.$i.$y);
                            $adultrecurring_nuberofautopays = $request->input('nuberofautopays_adult_'.$i.$y);
                            $adultrecurring_happens_aftr_12_pmt = $request->input('happens_aftr_12_pmt_adult_'.$i.$y);
                            $adultrecurring_client_be_charge_on = $request->input('client_be_charge_on_adult_'.$i.$y);
                            $adultrecurring_first_pmt = $request->input('first_pmt_adult_'.$i.$y);
                            $adultrecurring_recurring_pmt = $request->input('recurring_pmt_adult_'.$i.$y);
                            $adultrecurring_total_contract_revenue = $request->input('total_contract_revenue_adult_'.$i.$y);
                        }else{
                            $adultrecurring_price = NULL;
                            $adultrecurring_run_auto_pay  = NULL;
                            $adultrecurring_cust_be_charge = NULL;
                            $adultrecurring_every_time_num = NULL;
                            $adultrecurring_every_time = NULL;
                            $adultrecurring_nuberofautopays = NULL;
                            $adultrecurring_happens_aftr_12_pmt = NULL;
                            $adultrecurring_client_be_charge_on = NULL;
                            $adultrecurring_first_pmt = NULL;
                            $adultrecurring_recurring_pmt = NULL;
                            $adultrecurring_total_contract_revenue = NULL;
                        }

                        if($request->input('is_recurring_child_'.$i.$y) == 1){
                            /*$recurring_every = $request->input('recurring_every_'.$i.$y);
                            $recurring_duration = $request->input('recurring_duration_'.$i.$y);*/
                            $childrecurring_price = $request->input('recurring_price_child_'.$i.$y);
                            $childrecurring_run_auto_pay = $request->input('run_auto_pay_child_'.$i.$y);
                            $childrecurring_cust_be_charge = $request->input('cust_be_charge_child_'.$i.$y);
                            $childrecurring_every_time_num = $request->input('every_time_num_child_'.$i.$y);
                            $childrecurring_every_time = $request->input('every_time_child_'.$i.$y);
                            $childrecurring_nuberofautopays = $request->input('nuberofautopays_child_'.$i.$y);
                            $childrecurring_happens_aftr_12_pmt = $request->input('happens_aftr_12_pmt_child_'.$i.$y);
                            $childrecurring_client_be_charge_on = $request->input('client_be_charge_on_child_'.$i.$y);
                            $childrecurring_first_pmt = $request->input('first_pmt_child_'.$i.$y);
                            $childrecurring_recurring_pmt = $request->input('recurring_pmt_child_'.$i.$y);
                            $childrecurring_total_contract_revenue = $request->input('total_contract_revenue_child_'.$i.$y);
                        }else{
                            $childrecurring_price = NULL;
                            $childrecurring_run_auto_pay  = NULL;
                            $childrecurring_cust_be_charge = NULL;
                            $childrecurring_every_time_num = NULL;
                            $childrecurring_every_time = NULL;
                            $childrecurring_nuberofautopays = NULL;
                            $childrecurring_happens_aftr_12_pmt = NULL;
                            $childrecurring_client_be_charge_on = NULL;
                            $childrecurring_first_pmt = NULL;
                            $childrecurring_recurring_pmt = NULL;
                            $childrecurring_total_contract_revenue = NULL;
                        }

                        if($request->input('is_recurring_infant_'.$i.$y) == 1){
                            $infantrecurring_price = $request->input('recurring_price_infant_'.$i.$y);
                            $infantrecurring_run_auto_pay = $request->input('run_auto_pay_infant_'.$i.$y);
                            $infantrecurring_cust_be_charge = $request->input('cust_be_charge_infant_'.$i.$y);
                            $infantrecurring_every_time_num = $request->input('every_time_num_infant_'.$i.$y);
                            $infantrecurring_every_time = $request->input('every_time_infant_'.$i.$y);
                            $infantrecurring_nuberofautopays = $request->input('nuberofautopays_infant_'.$i.$y);
                            $infantrecurring_happens_aftr_12_pmt = $request->input('happens_aftr_12_pmt_infant_'.$i.$y);
                            $infantrecurring_client_be_charge_on = $request->input('client_be_charge_on_infant_'.$i.$y);
                            $infantrecurring_first_pmt = $request->input('first_pmt_infant_'.$i.$y);
                            $infantrecurring_recurring_pmt = $request->input('recurring_pmt_infant_'.$i.$y);
                            $infantrecurring_total_contract_revenue = $request->input('total_contract_revenue_infant_'.$i.$y);
                        }else{
                            /*$infantrecurring_every = NULL;
                            $infantrecurring_duration = NULL;*/
                            $infantrecurring_price = NULL;
                            $infantrecurring_run_auto_pay  = NULL;
                            $infantrecurring_cust_be_charge = NULL;
                            $infantrecurring_every_time_num = NULL;
                            $infantrecurring_every_time = NULL;
                            $infantrecurring_nuberofautopays = NULL;
                            $infantrecurring_happens_aftr_12_pmt = NULL;
                            $infantrecurring_client_be_charge_on = NULL;
                            $infantrecurring_first_pmt = NULL;
                            $infantrecurring_recurring_pmt = NULL;
                            $infantrecurring_total_contract_revenue = NULL;
                        }

                        if($comdata->is_verified == 0){
                            $userid = Auth::user()->id;
                        }else{
                            $userid = $comdata->user_id;
                        } 
                        $businessPayment = [
                            "category_id" =>$bpd->id,
                            "business_service_id"=> $request->sid,
                            "cid" => $request->cid,
                            "userid" => $userid,
                            "serviceid" => $request->sid,
                           
                            "pay_chk" => isset($request->pay_chk[$i]) ? $request->pay_chk[$i] : '',
                             "is_recurring_adult"=> $request->input('is_recurring_adult_'.$i.$y),
                            "recurring_price_adult"=>$adultrecurring_price,
                            "recurring_run_auto_pay_adult" => $adultrecurring_run_auto_pay,
                            "recurring_cust_be_charge_adult" => $adultrecurring_cust_be_charge,
                            "recurring_every_time_num_adult" => $adultrecurring_every_time_num ,
                            "recurring_every_time_adult" => $adultrecurring_every_time,
                            "recurring_nuberofautopays_adult" => $adultrecurring_nuberofautopays,
                            "recurring_happens_aftr_12_pmt_adult" => $adultrecurring_happens_aftr_12_pmt,
                            "recurring_client_be_charge_on_adult" => $adultrecurring_client_be_charge_on,
                            "recurring_first_pmt_adult" => $adultrecurring_first_pmt,
                            "recurring_recurring_pmt_adult" => $adultrecurring_recurring_pmt,
                            "recurring_total_contract_revenue_adult" => $adultrecurring_total_contract_revenue,

                            "is_recurring_child"=> $request->input('is_recurring_child_'.$i.$y),
                            "recurring_price_child"=>$childrecurring_price,
                            "recurring_run_auto_pay_child" => $childrecurring_run_auto_pay,
                            "recurring_cust_be_charge_child" => $childrecurring_cust_be_charge,
                            "recurring_every_time_num_child" => $childrecurring_every_time_num ,
                            "recurring_every_time_child" => $childrecurring_every_time,
                            "recurring_nuberofautopays_child" => $childrecurring_nuberofautopays,
                            "recurring_happens_aftr_12_pmt_child" => $childrecurring_happens_aftr_12_pmt,
                            "recurring_client_be_charge_on_child" => $childrecurring_client_be_charge_on,
                            "recurring_first_pmt_child" => $childrecurring_first_pmt,
                            "recurring_recurring_pmt_child" => $childrecurring_recurring_pmt,
                            "recurring_total_contract_revenue_child" => $childrecurring_total_contract_revenue,

                            "is_recurring_infant"=> $request->input('is_recurring_infant_'.$i.$y),
                            "recurring_price_infant"=>$infantrecurring_price,
                            "recurring_run_auto_pay_infant" => $infantrecurring_run_auto_pay,
                            "recurring_cust_be_charge_infant" => $infantrecurring_cust_be_charge,
                            "recurring_every_time_num_infant" => $infantrecurring_every_time_num ,
                            "recurring_every_time_infant" => $infantrecurring_every_time,
                            "recurring_nuberofautopays_infant" => $infantrecurring_nuberofautopays,
                            "recurring_happens_aftr_12_pmt_infant" => $infantrecurring_happens_aftr_12_pmt,
                            "recurring_client_be_charge_on_infant" => $infantrecurring_client_be_charge_on,
                            "recurring_first_pmt_infant" => $infantrecurring_first_pmt,
                            "recurring_recurring_pmt_infant" => $infantrecurring_recurring_pmt,
                            "recurring_total_contract_revenue_infant" => $infantrecurring_total_contract_revenue,

                            /*"recurring_every"=>$recurring_every,
                            "recurring_duration"=> $recurring_duration,*/
                            "fitnessity_fee"=> isset($request->fitnessity_fee) ? $request->fitnessity_fee : '',
                            "pay_setnum" => $request->input('pay_setnum_'.$i.$y),
                            "pay_setduration" => $request->input('pay_setduration_'.$i.$y),
                            "pay_after" => $request->input('pay_after_'.$i.$y),
                            "pay_session_type" => $request->input('pay_session_type_'.$i.$y),
                            "membership_type" =>  $request->input('membership_type_'.$i.$y),
                            "pay_session" => $request->input('pay_session_'.$i.$y),
                            "price_title" => $request->input('price_title_'.$i.$y),
                            "is_recurring"=> $request->input('is_recurring_'.$i.$y),
                            "adult_cus_weekly_price" => $request->input('adult_cus_weekly_price_'.$i.$y),
                            "adult_weekend_price_diff" =>  $request->input('adult_weekend_price_diff_'.$i.$y),
                            "adult_discount" => $request->input('adult_discount_'.$i.$y), 
                            "adult_estearn" => $request->input('adult_estearn_'.$i.$y),
                            "weekend_adult_estearn" => $request->input('weekend_adult_estearn_'.$i.$y),
                            "child_cus_weekly_price" => $request->input('child_cus_weekly_price_'.$i.$y) ,
                            "child_discount" => $request->input('child_discount_'.$i.$y),
                            "child_weekend_price_diff" => $request->input('child_weekend_price_diff_'.$i.$y),
                            "child_estearn" => $request->input('child_estearn_'.$i.$y),
                            "weekend_child_estearn" => $request->input('weekend_child_estearn_'.$i.$y),
                            "infant_cus_weekly_price" => $request->input('infant_cus_weekly_price_'.$i.$y) ,
                            "infant_weekend_price_diff" => $request->input('infant_weekend_price_diff_'.$i.$y), 
                            "infant_discount" => $request->input('infant_discount_'.$i.$y), 
                            "infant_estearn" =>  $request->input('infant_setearn_'.$i.$y),  
                            "weekend_infant_estearn" =>  $request->input('weekend_infant_estearn_'.$i.$y),  
                        ];
                       /* print_r($businessPayment);*/
                        BusinessPriceDetails::create($businessPayment);
                    }
                }
            }
        }
    
        session(['key' => 'success']);
        session(['msg' => 'Business Service Edited Succesfully !']); 
     
         return redirect()->route('list_activity',['id'=>$request->cid]);
    }

    public function add_services(Request $request){
       print_r($request->all());exit;
        $pay_chk = $pay_session_type = $pay_session = $pay_price = $pay_discountcat = $pay_discounttype = $pay_estearn = $pay_setnum = $pay_setduration = $pay_after = $recurring_price= $recurring_every= $recurring_duration= $fitnessity_fee= $is_recurring ="";
         $pay_discount = 0;

        $profile_picture = "";
        $comdata = CompanyInformation::where('id',$request->cid)->first();
        $datadayimg = array();
        if($request->hidd_service_type=='experience') {
            if ($request->hasFile('servicepic')) {
                $gallery_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR ;
                $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
                $image_upload = Miscellaneous::uploadPhotoGallery($request->servicepic, $gallery_upload_path, 1, $thumb_upload_path, 130, 100);
            
                if($image_upload['success'] == true) {
                    $profile_picture = $image_upload['filename'];
                    print_r( $profile_picture);
                }
            } else {
                $profile_picture = $request->oldservicepic;
            }
            if($request->hasfile('dayplanpic'))
            {
                $no=1;
                foreach($request->file('dayplanpic') as $file)
                {
                    $name = time().$no.'.'.$file->extension();
                    $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
                    $file->move($thumb_upload_path, $name);  
                    $datadayimg[] = $name;  
                    $no++;
                }
             }
            
            /* using the insertion time only */
            $request->servicepic = $profile_picture;
        } else {
            if ($request->hasFile('servicepic')) {
                $gallery_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR ;
                $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
                $image_upload = Miscellaneous::uploadPhotoGallery($request->servicepic, $gallery_upload_path, 1, $thumb_upload_path, 130, 100);
                if($image_upload['success'] == true) {
                    $profile_picture = $image_upload['filename'];
                }
            } else {
                $profile_picture = $request->oldservicepic;
            }

            /* using the insertion time only */
            $request->servicepic = $profile_picture;
        }

        // experience feild
        $notincluded_thing =  $included_thing = $frm_wear = $safe_varification = $days_title = $days_desc = $days_dayplanpic = '';
        if(isset($request->frm_included_things) && !empty($request->frm_included_things)) {
            $included_thing = @implode(",",$request->frm_included_things);    
        }
        if(isset($request->frm_notincluded_things) && !empty($request->frm_notincluded_things)) {
            $notincluded_thing = @implode(",",$request->frm_notincluded_things);    
        }
        if(isset($request->frm_wear) && !empty($request->frm_wear)) {
            $frm_wear = @implode(",",$request->frm_wear);    
        }
        if(isset($request->id_proof) && !empty($request->id_proof)) {
            $safe_varification='id_proof';
        }
        if(isset($request->id_vaccine) && !empty($request->id_vaccine)) {
            $safe_varification .=',id_vaccine';
        }
        if(isset($request->id_covid) && !empty($request->id_covid)) {
            $safe_varification .=',id_covid';
        }
        if(isset($request->days_title) && !empty($request->days_title)) {
            $days_title = json_encode($request->days_title);
        }
        if(isset($request->days_description) && !empty($request->days_description)) {
            $days_desc = json_encode($request->days_description);
        }
        if(isset($request->dayplanpic) && !empty($request->dayplanpic)) {
            $days_dayplanpic = json_encode($datadayimg);
        }


        $servicetype = $servicelocation = $programfor = $agerange = "";
        $experiencelevel = $servicefocuses = $teachingstyle = $cnumberofpeople= "";
        $numberofpeople = 1;
        if(isset($request->frm_servicetype) && !empty($request->frm_servicetype)) {
            $servicetype = @implode(",",$request->frm_servicetype);    
        }
        if(isset($request->frm_servicelocation) && !empty($request->frm_servicelocation)) {
            $servicelocation = @implode(",",$request->frm_servicelocation);    
        }
        if(isset($request->frm_programfor) && !empty($request->frm_programfor)) {
            $programfor = @implode(",",$request->frm_programfor);    
        }
        if(isset($request->frm_agerange) && !empty($request->frm_agerange)) {
            $agerange = @implode(",",$request->frm_agerange);    
        }
        if(isset($request->frm_numberofpeople) && !empty($request->frm_numberofpeople)) {
            $numberofpeople = @implode(",",$request->frm_numberofpeople);    
        }
        if(isset($request->frm_experience_level) && !empty($request->frm_experience_level)) {
            $experiencelevel = @implode(",",$request->frm_experience_level);    
        }
        if(isset($request->frm_servicefocuses) && !empty($request->frm_servicefocuses)) {
            $servicefocuses = @implode(",",$request->frm_servicefocuses);    
        }
        if(isset($request->frm_teachingstyle) && !empty($request->frm_teachingstyle)) {
            $teachingstyle = @implode(",",$request->frm_teachingstyle);    
        }

        $bs = new BusinessServices;
        $bs->cid = $request->cid;
        $bs->service_type = $request->hidd_service_type;
        $bs->sport_activity = @$request->frm_servicesport;
        $bs->program_name = @$request->frm_programname;
        $bs->program_desc = @$request->frm_programdesc;
        $bs->profile_pic = @$request->servicepic;
        $bs->select_service_type = $servicetype;
        $bs->activity_location = $servicelocation;
        $bs->activity_for = $programfor;
        $bs->age_range =  $agerange ;
        $bs->group_size =  $numberofpeople;
        $bs->difficult_level = $experiencelevel;
        $bs->instructor_habit = $teachingstyle;
        $bs->activity_experience =  $servicefocuses;
        $bs->activity_value = @$request->activity_value;
        $bs->activity_meets = @$request->frm_class_meets;
        $bs->starting = @$request->starting;
        $bs->schedule_until = @$request->frm_schedule_until;
        $bs->meetup_location = @$request->meetup_location;
        if($request->hidd_service_type == 'experience' ){
            $bs->included_items = $included_thing;
            $bs->notincluded_items = $notincluded_thing;
            $bs->bring_wear = $frm_wear;
            $bs->req_safety = $safe_varification;
            $bs->days_plan_title = $days_title;
            $bs->days_plan_desc = $days_desc;
            $bs->days_plan_img = $days_dayplanpic;
        }
        $bs->serviceid = 0;
        if($comdata->is_verified == 0){
            $bs->userid = Auth::user()->id;
        }else{
            $bs->userid = $comdata->user_id;
        }
        $bs->save();
      /*  print_r($bs);exit();*/
           
      
        $paycount = count($request->category_title);
        if($paycount > 0) {
            for($i=0; $i < $paycount; $i++) {
                $bpd = new BusinessPriceDetailsAges;
                $bpd->cid= $request->cid;
                $bpd->serviceid= $bs->id;
                if($comdata->is_verified == 0){
                    $bpd->userid = Auth::user()->id;
                }else{
                    $bpd->userid = $comdata->user_id;
                } 
                $bpd->category_title = isset($request->category_title[$i]) ? $request->category_title[$i] : '';
                $bpd->save();
                $age_cnt = $request->input('ages_count'.$i);
                if($age_cnt >= 0){
                    for($y=0; $y <= $age_cnt; $y++) {
                        if($request->input('is_recurring_adult_'.$i.$y) == 1){
                            /*$recurring_every = $request->input('recurring_every_'.$i.$y);
                            $recurring_duration = $request->input('recurring_duration_'.$i.$y);*/
                            $adultrecurring_price = $request->input('recurring_price_adult_'.$i.$y);
                            $adultrecurring_run_auto_pay = $request->input('run_auto_pay_adult_'.$i.$y);
                            $adultrecurring_cust_be_charge = $request->input('cust_be_charge_adult_'.$i.$y);
                            $adultrecurring_every_time_num = $request->input('every_time_num_adult_'.$i.$y);
                            $adultrecurring_every_time = $request->input('every_time_adult_'.$i.$y);
                            $adultrecurring_nuberofautopays = $request->input('nuberofautopays_adult_'.$i.$y);
                            $adultrecurring_happens_aftr_12_pmt = $request->input('happens_aftr_12_pmt_adult_'.$i.$y);
                            $adultrecurring_client_be_charge_on = $request->input('client_be_charge_on_adult_'.$i.$y);
                            $adultrecurring_first_pmt = $request->input('first_pmt_adult_'.$i.$y);
                            $adultrecurring_recurring_pmt = $request->input('recurring_pmt_adult_'.$i.$y);
                            $adultrecurring_total_contract_revenue = $request->input('total_contract_revenue_adult_'.$i.$y);
                        }else{
                            /*$recurring_every = NULL;
                            $recurring_duration = NULL;*/
                            $adultrecurring_price = NULL;
                            $adultrecurring_run_auto_pay  = NULL;
                            $adultrecurring_cust_be_charge = NULL;
                            $adultrecurring_every_time_num = NULL;
                            $adultrecurring_every_time = NULL;
                            $adultrecurring_nuberofautopays = NULL;
                            $adultrecurring_happens_aftr_12_pmt = NULL;
                            $adultrecurring_client_be_charge_on = NULL;
                            $adultrecurring_first_pmt = NULL;
                            $adultrecurring_recurring_pmt = NULL;
                            $adultrecurring_total_contract_revenue = NULL;
                        }

                        if($request->input('is_recurring_child_'.$i.$y) == 1){
                            /*$recurring_every = $request->input('recurring_every_'.$i.$y);
                            $recurring_duration = $request->input('recurring_duration_'.$i.$y);*/
                            $childrecurring_price = $request->input('recurring_price_child_'.$i.$y);
                            $childrecurring_run_auto_pay = $request->input('run_auto_pay_child_'.$i.$y);
                            $childrecurring_cust_be_charge = $request->input('cust_be_charge_child_'.$i.$y);
                            $childrecurring_every_time_num = $request->input('every_time_num_child_'.$i.$y);
                            $childrecurring_every_time = $request->input('every_time_child_'.$i.$y);
                            $childrecurring_nuberofautopays = $request->input('nuberofautopays_child_'.$i.$y);
                            $childrecurring_happens_aftr_12_pmt = $request->input('happens_aftr_12_pmt_child_'.$i.$y);
                            $childrecurring_client_be_charge_on = $request->input('client_be_charge_on_child_'.$i.$y);
                            $childrecurring_first_pmt = $request->input('first_pmt_child_'.$i.$y);
                            $childrecurring_recurring_pmt = $request->input('recurring_pmt_child_'.$i.$y);
                            $childrecurring_total_contract_revenue = $request->input('total_contract_revenue_child_'.$i.$y);
                        }else{
                            /*$childrecurring_every = NULL;
                            $childrecurring_duration = NULL;*/
                            $childrecurring_price = NULL;
                            $childrecurring_run_auto_pay  = NULL;
                            $childrecurring_cust_be_charge = NULL;
                            $childrecurring_every_time_num = NULL;
                            $childrecurring_every_time = NULL;
                            $childrecurring_nuberofautopays = NULL;
                            $childrecurring_happens_aftr_12_pmt = NULL;
                            $childrecurring_client_be_charge_on = NULL;
                            $childrecurring_first_pmt = NULL;
                            $childrecurring_recurring_pmt = NULL;
                            $childrecurring_total_contract_revenue = NULL;
                        }

                        if($request->input('is_recurring_infant_'.$i.$y) == 1){
                            /*$recurring_every = $request->input('recurring_every_'.$i.$y);
                            $recurring_duration = $request->input('recurring_duration_'.$i.$y);*/
                            $infantrecurring_price = $request->input('recurring_price_infant_'.$i.$y);
                            $infantrecurring_run_auto_pay = $request->input('run_auto_pay_infant_'.$i.$y);
                            $infantrecurring_cust_be_charge = $request->input('cust_be_charge_infant_'.$i.$y);
                            $infantrecurring_every_time_num = $request->input('every_time_num_infant_'.$i.$y);
                            $infantrecurring_every_time = $request->input('every_time_infant_'.$i.$y);
                            $infantrecurring_nuberofautopays = $request->input('nuberofautopays_infant_'.$i.$y);
                            $infantrecurring_happens_aftr_12_pmt = $request->input('happens_aftr_12_pmt_infant_'.$i.$y);
                            $infantrecurring_client_be_charge_on = $request->input('client_be_charge_on_infant_'.$i.$y);
                            $infantrecurring_first_pmt = $request->input('first_pmt_infant_'.$i.$y);
                            $infantrecurring_recurring_pmt = $request->input('recurring_pmt_infant_'.$i.$y);
                            $infantrecurring_total_contract_revenue = $request->input('total_contract_revenue_infant_'.$i.$y);
                        }else{
                            /*$infantrecurring_every = NULL;
                            $infantrecurring_duration = NULL;*/
                            $infantrecurring_price = NULL;
                            $infantrecurring_run_auto_pay  = NULL;
                            $infantrecurring_cust_be_charge = NULL;
                            $infantrecurring_every_time_num = NULL;
                            $infantrecurring_every_time = NULL;
                            $infantrecurring_nuberofautopays = NULL;
                            $infantrecurring_happens_aftr_12_pmt = NULL;
                            $infantrecurring_client_be_charge_on = NULL;
                            $infantrecurring_first_pmt = NULL;
                            $infantrecurring_recurring_pmt = NULL;
                            $infantrecurring_total_contract_revenue = NULL;
                        }

                        if($comdata->is_verified == 0){
                            $userid = Auth::user()->id;
                        }else{
                            $userid = $comdata->user_id;
                        } 
                        $businessPayment = [
                            "category_id" =>$bpd->id,
                            "business_service_id"=> $bs->id,
                            "cid" => $request->cid,
                            "userid" => $userid,
                            "serviceid" =>  $bs->id,
                           
                            "pay_chk" => isset($request->pay_chk[$i]) ? $request->pay_chk[$i] : '',
                            "is_recurring_adult"=> $request->input('is_recurring_adult_'.$i.$y),
                            "recurring_price_adult"=>$adultrecurring_price,
                            "recurring_run_auto_pay_adult" => $adultrecurring_run_auto_pay,
                            "recurring_cust_be_charge_adult" => $adultrecurring_cust_be_charge,
                            "recurring_every_time_num_adult" => $adultrecurring_every_time_num ,
                            "recurring_every_time_adult" => $adultrecurring_every_time,
                            "recurring_nuberofautopays_adult" => $adultrecurring_nuberofautopays,
                            "recurring_happens_aftr_12_pmt_adult" => $adultrecurring_happens_aftr_12_pmt,
                            "recurring_client_be_charge_on_adult" => $adultrecurring_client_be_charge_on,
                            "recurring_first_pmt_adult" => $adultrecurring_first_pmt,
                            "recurring_recurring_pmt_adult" => $adultrecurring_recurring_pmt,
                            "recurring_total_contract_revenue_adult" => $adultrecurring_total_contract_revenue,

                            "is_recurring_child"=> $request->input('is_recurring_child_'.$i.$y),
                            "recurring_price_child"=>$childrecurring_price,
                            "recurring_run_auto_pay_child" => $childrecurring_run_auto_pay,
                            "recurring_cust_be_charge_child" => $childrecurring_cust_be_charge,
                            "recurring_every_time_num_child" => $childrecurring_every_time_num ,
                            "recurring_every_time_child" => $childrecurring_every_time,
                            "recurring_nuberofautopays_child" => $childrecurring_nuberofautopays,
                            "recurring_happens_aftr_12_pmt_child" => $childrecurring_happens_aftr_12_pmt,
                            "recurring_client_be_charge_on_child" => $childrecurring_client_be_charge_on,
                            "recurring_first_pmt_child" => $childrecurring_first_pmt,
                            "recurring_recurring_pmt_child" => $childrecurring_recurring_pmt,
                            "recurring_total_contract_revenue_child" => $childrecurring_total_contract_revenue,

                            "is_recurring_infant"=> $request->input('is_recurring_infant_'.$i.$y),
                            "recurring_price_infant"=>$infantrecurring_price,
                            "recurring_run_auto_pay_infant" => $infantrecurring_run_auto_pay,
                            "recurring_cust_be_charge_infant" => $infantrecurring_cust_be_charge,
                            "recurring_every_time_num_infant" => $infantrecurring_every_time_num ,
                            "recurring_every_time_infant" => $infantrecurring_every_time,
                            "recurring_nuberofautopays_infant" => $infantrecurring_nuberofautopays,
                            "recurring_happens_aftr_12_pmt_infant" => $infantrecurring_happens_aftr_12_pmt,
                            "recurring_client_be_charge_on_infant" => $infantrecurring_client_be_charge_on,
                            "recurring_first_pmt_infant" => $infantrecurring_first_pmt,
                            "recurring_recurring_pmt_infant" => $infantrecurring_recurring_pmt,
                            "recurring_total_contract_revenue_infant" => $infantrecurring_total_contract_revenue,
                            
                            /*"recurring_every"=>$recurring_every,
                            "recurring_duration"=> $recurring_duration,*/
                            "fitnessity_fee"=> isset($request->fitnessity_fee) ? $request->fitnessity_fee : '',
                            "pay_setnum" => $request->input('pay_setnum_'.$i.$y),
                            "pay_setduration" => $request->input('pay_setduration_'.$i.$y),
                            "pay_after" => $request->input('pay_after_'.$i.$y),
                            "pay_session_type" => $request->input('pay_session_type_'.$i.$y),
                            "membership_type" =>  $request->input('membership_type_'.$i.$y),
                            "pay_session" => $request->input('pay_session_'.$i.$y),
                            "price_title" => $request->input('price_title_'.$i.$y),
                            "is_recurring"=> $request->input('is_recurring_'.$i.$y),
                            "adult_cus_weekly_price" => $request->input('adult_cus_weekly_price_'.$i.$y),
                            "adult_weekend_price_diff" =>  $request->input('adult_weekend_price_diff_'.$i.$y),
                            "adult_discount" => $request->input('adult_discount_'.$i.$y), 
                            "adult_estearn" => $request->input('adult_estearn_'.$i.$y),
                            "weekend_adult_estearn" => $request->input('weekend_adult_estearn_'.$i.$y),
                            "child_cus_weekly_price" => $request->input('child_cus_weekly_price_'.$i.$y) ,
                            "child_discount" => $request->input('child_discount_'.$i.$y),
                            "child_weekend_price_diff" => $request->input('child_weekend_price_diff_'.$i.$y),
                            "child_estearn" => $request->input('child_estearn_'.$i.$y),
                            "weekend_child_estearn" => $request->input('weekend_child_estearn_'.$i.$y),
                            "infant_cus_weekly_price" => $request->input('infant_cus_weekly_price_'.$i.$y) ,
                            "infant_weekend_price_diff" => $request->input('infant_weekend_price_diff_'.$i.$y), 
                            "infant_discount" => $request->input('infant_discount_'.$i.$y), 
                            "infant_estearn" =>  $request->input('infant_estearn_'.$i.$y),  
                            "weekend_infant_estearn" =>  $request->input('weekend_infant_estearn_'.$i.$y),  
                        ];
                       /* print_r($businessPayment);*/
                        BusinessPriceDetails::create($businessPayment);
                    }
                }
            }
        }
    
        session(['key' => 'success']);
        session(['msg' => 'Business Service Added Succesfully !']); 
        return redirect()->route('list_activity',['id'=>$request->cid]);
    }

    public function delete(Request $request)
    {
        $status = $this->plan->deleteItem($request->id);

        if($status)
        {
            return json_encode([
                'status' => true
            ]);
        }
        
        return json_encode([
            'status' => false
        ]);
    }

	public function business_delete($id){
		//$comp = CompanyInformation::where('id', $id)->first();
		$del = CompanyInformation::where('id',$id)->delete();
		
		if($del){
			$delbdetail = BusinessCompanyDetail::where('cid',$id)->delete();
			$delbexp = BusinessExperience::where('cid',$id)->delete();
			$delbinfo = BusinessInformation::where('cid',$id)->delete();
			$delbser = BusinessService::where('cid',$id)->delete();
			$delbterms = BusinessTerms::where('cid',$id)->delete();
			$delbveri = BusinessVerified::where('cid',$id)->delete();
			$delbservces = BusinessServices::where('cid',$id)->delete();
			$delbsmap = BusinessServicesMap::where('cid',$id)->delete();
			$delbprice = BusinessPriceDetails::where('cid',$id)->delete();
			$delbsched = BusinessActivityScheduler::where('cid',$id)->delete();
			$delPost = PagePost::where('page_id',$id)->delete();
			$delPostSave = PagePostSave::where('page_id',$id)->delete();
			$delPostSave = PagePostSave::where('page_id',$id)->delete();
			$delPageLike = PageLike::where('pageid',$id)->delete();
			$delbReview = BusinessReview::where('page_id',$id)->delete();
			session(['key' => 'success']);
			session(['msg' => 'Delete Succesfully !']); 
            return redirect('admin/claimbusiness');
		}
	}
	
	public function editBusinessServiceadmin(Request $request){
        if($request->btnactive == 'Active') {
            BusinessServices::where('cid', $request->cid)->where('id', $request->serviceid)->update(['is_active' => 1]);
        }
        
        if($request->btnactive == 'Inactive') {
            BusinessServices::where('cid', $request->cid)->where('id', $request->serviceid)->update(['is_active' => 0]);
        }
    }
    public function admin_businesspricedetails($catid){ 
        $pageTitle ='';
        $catdata =  BusinessPriceDetailsAges::where('id',$catid)->first();
        $business_activity = BusinessActivityScheduler::where('cid', $catdata['cid'])->where('serviceid', $catdata['serviceid'])->where('category_id',$catid)->get();
        $business_activity = isset($business_activity) ? $business_activity : [];
        return view('admin.plan.admin_businesspricedetail',compact('catid','catdata','business_activity','pageTitle'));
    }

    public function adminaddbusinessschedule(Request $request){
        /*print_r($request->all());exit();*/

        $shift_start = $request->duration_cnt;
        /*echo $shift_start; exit;*/
        if($shift_start >= 0) {
            $busschedata =  BusinessServices::where('cid', $request->cid)->first();
          
            if($busschedata != ''){
                $userid= $busschedata['userid'];
            }else{
                $userid= Auth::user()->id;
            }
            BusinessActivityScheduler::where('cid', $request->cid)->where('userid',$userid)->where('serviceid',  $request->serviceid)->where('category_id',$request->catid)->delete();
            
            for($i=0; $i <= $shift_start; $i++) { 
                if($request->shift_start[$i] != '' && $request->shift_end[$i] != '' && $request->set_duration[$i] != '') {
                    $activitySchedulerData = [
                        "cid" => $request->cid,
                        "category_id" => $request->catid,
                        "userid" =>$userid,
                        "serviceid" =>$request->serviceid,
                        "activity_meets" => $request->frm_class_meets,
                        "starting" => $request->starting,
                        "activity_days" => isset($request->activity_days[$i]) ? $request->activity_days[$i] : '',
                        "shift_start" => isset($request->shift_start[$i]) ? $request->shift_start[$i] : '',
                        "shift_end" => isset($request->shift_end[$i]) ? $request->shift_end[$i] : '',
                        "set_duration" => isset($request->set_duration[$i]) ? $request->set_duration[$i] : '',
                        "spots_available" => isset($request->sport_avail[$i]) ? $request->sport_avail[$i] : '',
                        "scheduled_day_or_week" => $request->until, 
                        "scheduled_day_or_week_num" => $request->scheduled,
                        "is_active" => 1,
                        "schedule_until" => '',
                        "sales_tax" => '',
                        "sales_tax_percent" => '',
                        "dues_tax" => '',
                        "dues_tax_percent" => ''
                    ];
    
                    BusinessActivityScheduler::create($activitySchedulerData);
                }
            }
        }
        return redirect()->route('admin_businesspricedetails', [$request->catid]);
    }

    public function sendemail(Request $request){

       /* $detail_data_com['company_data'] = CompanyInformation::where('id',$request->cid)->first();
        $AllDetail  = json_decode(json_encode($detail_data_com), true); 
        $status = MailService::sendEmailfromadmin($AllDetail);*/

        $company_data= CompanyInformation::where('id',$request->cid)->first();
        $email_detail = array(
            'companydata' => $company_data,
            'email' => @$company_data->business_email);
        $status = SGMailService::sendEmailToCustomerforClaim($email_detail);
        return $status;
    }


    protected function throwValidationException(Request $request, $validator)
    {
        throw new HttpResponseException(response()->json(['error' => $validator->errors()], 422));
    }
}