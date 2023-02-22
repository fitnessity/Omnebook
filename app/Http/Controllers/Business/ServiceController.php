<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{CompanyInformation,User,BusinessServicesMap,BusinessServices,BusinessPriceDetailsAges,BusinessPriceDetails,Miscellaneous};
use Auth;

class ServiceController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,$business_id)
    {
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        $companyInfo = CompanyInformation::where('id', $business_id)->orderBy('id', 'DESC')->first();
        $companyservice = @$companyInfo->service->sortByDesc('created_at');;
        $companyid = @$companyInfo->id;
        $companyname = @$companyInfo->name;
        return view('business.services.index', compact('cart', 'companyname','companyid', 'companyservice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $businessData = [
            'bstep' => 72,
            'cid' => $request->cid,
            'serviceid' => $request->serviceid,
            'servicetype' => $request->service_type
        ];
        User::where('id', Auth::user()->id)->update(['bstep' => 71]);
        return redirect()->route('createNewBusinessProfile');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($request->all());exit;

        $serid_pay=$request->serviceid;
        $businessData = [
            "cid" => $request->cid,
            "userid" => $request->userid
        ];
        /* Table - business_services_map */
        
        $business_services_map = BusinessServicesMap::where('id', $request->serviceid)->where('cid', $request->cid)->where('userid', Auth::user()->id)->get();
        $business_services_map_count = BusinessServicesMap::where('id', $request->serviceid)->where('cid', $request->cid)->where('userid', Auth::user()->id)->count();
        
        if ($business_services_map_count<=0) {
            $request->serviceid = BusinessServicesMap::create($businessData)->id;
        } else {
            BusinessServicesMap::where('id', $request->serviceid)->where('cid', $request->cid)->where('userid', Auth::user()->id)->update($businessData);
        }

        $profile_picture = "";
        $datadayimg = [];

        $bus_count = BusinessServices::where('cid', $request->cid)->where('userid', Auth::user()->id)->where('id',$serid_pay)->first();

        if($request->service_type=='experience') {
            for ($i=0; $i <count($request->days_title) ; $i++) { 
                if($request->file('dayplanpic_'.$i)){
                    $no= $i+1;
                    $file = $request->file('dayplanpic_'.$i);
                    $name = time().$no.'.'.$file->extension();
                    $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
                    $file->move($thumb_upload_path, $name);  
                    $datadayimg[$i] = $name;  
                    $no++;
                }else{
                    if($request->input('olddayplanpic_'.$i)){
                        $datadayimg[$i] = $request->input('olddayplanpic_'.$i);
                    }else{
                        $datadayimg[$i] = null;
                    }
                }
            }
        } 
       
       
        if($bus_count != ''){
            if($bus_count->profile_pic != ''){
                $img = rtrim($bus_count->profile_pic,',');
                $profile_picture .= $img.',';
            }else{
                $profile_picture .= '';
            }
        }else{
            $profile_picture .= '';
        }

        if ($request->hasFile('imgUpload')) {
            for($i=0;$i<count($request->imgUpload);$i++){
                $gallery_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR ;
                $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
                $image_upload = Miscellaneous::uploadPhotoGallery($request->imgUpload[$i], $gallery_upload_path, 1, $thumb_upload_path, 130, 100);
                /*print_r($image_upload);*/
                if($image_upload['success'] == true) {
                    $profile_picture .= $image_upload['filename'].',';
                }
            }
            
        } else {
            $profile_picture .= '';
        }


        $request->servicepic = rtrim($profile_picture,',');
        /* print_r($request->file('imgUpload'));
        echo $request->servicepic ;exit;*/
        $instant = $reserve = 0;
        
        $servicetype = $servicelocation = $programfor = $agerange = $numberofpeople = "";
        $experiencelevel = $servicefocuses = $teachingstyle = $hours = $cnumberofpeople = $safe_varification= "";
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
        if(isset($request->hours) && !empty($request->hours)) {
            $hours = @implode(",",$request->hours);    
        }
        if(isset($request->frm_cnumberofpeople) && !empty($request->frm_cnumberofpeople)) {
            $cnumberofpeople = @implode(",",$request->frm_cnumberofpeople);    
        }
        
        $servicetype1 = $servicelocation1 = $programfor1 = $agerange1 = $experiencelevel1 = $teachingstyle1 = $servicefocuses1 =  $included_thing = $notincluded_thing = $frm_wear= "";  
        $days_dayplanpic = "";
        if(isset($request->frm_lservice) && !empty($request->frm_lservice)) {
            $servicetype1 = @implode(",",$request->frm_lservice);    
        }
        if(isset($request->frm_lactivity) && !empty($request->frm_lactivity)) {
            $servicelocation1 = @implode(",",$request->frm_lactivity);    
        }
        if(isset($request->frm_lgreat) && !empty($request->frm_lgreat)) {
            $programfor1 = @implode(",",$request->frm_lgreat);    
        }
        if(isset($request->frm_lagerange) && !empty($request->frm_lagerange)) {
            $agerange1 = @implode(",",$request->frm_lagerange);    
        }
        if(isset($request->frm_ldifficulty) && !empty($request->frm_ldifficulty)) {
            $experiencelevel1 = @implode(",",$request->frm_ldifficulty);    
        }
        if(isset($request->frm_lcustomers) && !empty($request->frm_lcustomers)) {
            $teachingstyle1 = @implode(",",$request->frm_lcustomers);    
        }
        if(isset($request->frm_lproviders) && !empty($request->frm_lproviders)) {
            $servicefocuses1 = @implode(",",$request->frm_lproviders);    
        }
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
             $days_dayplanpic = json_encode($datadayimg);
        }
        /*if(isset($request->dayplanpic) && !empty($request->dayplanpic)) {
            $days_dayplanpic = json_encode($datadayimg);
        }*/
        
        if($request->has('instantbooking')){
            $instant = 1;
        }else{
            $instant = 0;
        }

        if($request->has('requestbooking')){
            $reserve = 1;
        }else{
            $reserve = 0;
        }

        //echo $safe_varification; exit;
        if($request->service_type=='experience') {
            $businessData = [
                "cid" => $request->cid,
                "userid" => $request->userid,
                "serviceid" => $request->serviceid,
                "service_type" => $request->service_type,
                "sport_activity" => $request->frm_servicesport,
                "program_name" => $request->frm_programname,
                "program_desc" => $request->frm_programdesc,
                "profile_pic" => $request->servicepic,
                "instant_booking" => $instant,
                "request_booking" => $reserve,
                "frm_min_participate" => $request->frm_min_participate,
                "beforetime" => $request->beforetime,
                "beforetimeint" => $request->beforetimeint,
                "notice_value" => $request->notice_value,
                "notice_key" => $request->notice_key,
                "advance_value" => $request->advance_value,
                "advance_key" => $request->advance_key,
                "activity_value" => $request->activity_value,
                "activity_key" => $request->activity_key,
                "cancel_value" => $request->cancel_value2,
                "cancel_key" => $request->cancel_key2,
                "willing_to_travel" => $request->willing_to_travel,
                "miles" => $request->travel_miles,
                "area" => $request->wanttowork,
                "select_service_type" => $servicetype,
                "activity_location" => $servicelocation,
                "activity_for" => $programfor,
                "age_range" => $agerange,
                "meetup_location" => @$request->meetup_location,
               /* "group_size" => $numberofpeople,*/
                "difficult_level" => $experiencelevel,
                "activity_experience" => $servicefocuses,
                "instructor_habit" => $teachingstyle,
                "activity_meets" => $request->frm_class_meets,
                "starting" => $request->starting,
                "schedule_until" => $request->frm_schedule_until,
                "sales_tax" => $request->salestax,
                "sales_tax_percent" => $request->salestaxpercentage,
                "dues_tax" => $request->duestax,
                "dues_tax_percent" => $request->duestaxpercentage,
                "mon_shift_start" => $request->mon_shift_start,
                "mon_shift_end" => $request->mon_shift_end,  
                "tue_shift_start" => $request->tue_shift_start,
                "tue_shift_end" => $request->tue_shift_end,  
                "wed_shift_start" => $request->wed_shift_start,
                "wed_shift_end" => $request->wed_shift_end,
                "thu_shift_start" => $request->thu_shift_start,
                "thu_shift_end" => $request->thu_shift_end,
                "fri_shift_start" => $request->fri_shift_start,
                "fri_shift_end" => $request->fri_shift_end,
                "sat_shift_start" => $request->sat_shift_start,
                "sat_shift_end" => $request->sat_shift_end,
                "sun_shift_start" => $request->sun_shift_start,
                "sun_shift_end" => $request->sun_shift_end,
                "mon_duration" => $request->mon_duration,
                "tue_duration" => $request->tue_duration,
                "wed_duration" => $request->wed_duration,
                "thu_duration" => $request->thu_duration,
                "fri_duration" => $request->fri_duration,
                "sat_duration" => $request->sat_duration,
                "sun_duration" => $request->sun_duration,
                "frm_servicedesc" => $request->frm_servicedesc,
                "exp_country" => @$request->cus_country,
                "exp_address" => @$request->cus_st_address,
                "exp_building" => @$request->cus_addi_address,
                "exp_city" => @$request->cus_city,
                "exp_state" => @$request->cus_state,
                "exp_zip" => @$request->cus_zip,
                "exp_lat" => @$request->cus_lat,
                "exp_lng" => @$request->cus_lng,
                "is_late_fee" => $request->is_late_fee,
                "late_fee" => $request->late_fee,
                "instructor_id"=> $request->instructor_id,
                "included_items" => $included_thing,
                "notincluded_items" => $notincluded_thing,
                "bring_wear" => $frm_wear,
                "req_safety" => $safe_varification,
                "days_plan_title" => $days_title,
                "days_plan_desc" => $days_desc,
                "days_plan_img" => $days_dayplanpic,
                "exp_highlight" =>$request->exp_highlight,
                "addi_info" =>$request->frm_addi_info,
                "accessibility" =>$request->frm_accessibility,
                "addi_info_help" =>$request->addi_info_help,
                "desc_location" =>$request->desc_location,
                "cancelbefore" =>$request->cancelbefore,
                "cancelbeforeint" =>$request->cancelbeforeint,
                "know_before_you_go"=>$request->know_before_you_go,
            ];
        } else {
            $businessData = [
                "cid" => $request->cid,
                "userid" => $request->userid,
                "serviceid" => $request->serviceid,
                "service_type" => $request->service_type,
                "sport_activity" => $request->frm_servicesport,
                "program_name" => $request->frm_programname,
                "program_desc" => $request->frm_programdesc,
                "profile_pic" => $request->servicepic,
                "instant_booking" => $instant,
                "request_booking" => $reserve,
                "frm_min_participate" => $request->frm_min_participate,
                "notice_value" => $request->notice_value,
                "notice_key" => $request->notice_key,
                "advance_value" => $request->advance_value,
                "advance_key" => $request->advance_key,
                "activity_value" => $request->activity_value,
                "activity_key" => $request->activity_key,
                "cancel_value" => $request->cancel_value2,
                "cancel_key" => $request->cancel_key2,
                "beforetime" => $request->beforetime,
                "beforetimeint" => $request->beforetimeint,
                "willing_to_travel" => $request->willing_to_travel,
                "miles" => $request->travel_miles,
                "area" => $request->wanttowork,
                "select_service_type" => $servicetype,
                "activity_location" => $servicelocation,
                "activity_for" => $programfor,
                "age_range" => $agerange,
                /*"group_size" => $numberofpeople,*/
                "difficult_level" => $experiencelevel,
                "activity_experience" => $servicefocuses,
                "instructor_habit" => $teachingstyle,
                "activity_meets" => $request->frm_class_meets,
                "starting" => $request->starting,
                "schedule_until" => $request->frm_schedule_until,
                "sales_tax" => $request->salestax,
                "sales_tax_percent" => $request->salestaxpercentage,
                "dues_tax" => $request->duestax,
                "dues_tax_percent" => $request->duestaxpercentage,
                "mon_shift_start" => $request->mon_shift_start,
                "mon_shift_end" => $request->mon_shift_end,  
                "tue_shift_start" => $request->tue_shift_start,
                "tue_shift_end" => $request->tue_shift_end,  
                "wed_shift_start" => $request->wed_shift_start,
                "wed_shift_end" => $request->wed_shift_end,
                "thu_shift_start" => $request->thu_shift_start,
                "thu_shift_end" => $request->thu_shift_end,
                "fri_shift_start" => $request->fri_shift_start,
                "fri_shift_end" => $request->fri_shift_end,
                "sat_shift_start" => $request->sat_shift_start,
                "sat_shift_end" => $request->sat_shift_end,
                "sun_shift_start" => $request->sun_shift_start,
                "sun_shift_end" => $request->sun_shift_end,
                "mon_duration" => $request->mon_duration,
                "tue_duration" => $request->tue_duration,
                "wed_duration" => $request->wed_duration,
                "thu_duration" => $request->thu_duration,
                "fri_duration" => $request->fri_duration,
                "sat_duration" => $request->sat_duration,
                "sun_duration" => $request->sun_duration,
                "is_late_fee" => $request->is_late_fee,
                "late_fee" => $request->late_fee,
                "instructor_id"=> $request->instructor_id,
                "cancelbefore" =>$request->cancelbefore,
                "cancelbeforeint" =>$request->cancelbeforeint,
                "know_before_you_go"=>$request->know_before_you_go,
            ];
        }
       /*print_r($businessData); exit;*/
        $pay_chk = $pay_session_type = $pay_session = $pay_price = $pay_discountcat = $pay_discounttype = $pay_discount = $pay_estearn = $pay_setnum = $pay_setduration = $pay_after = $recurring_price= $recurring_every= $recurring_duration= $fitnessity_fee= $is_recurring ="";
        if(isset($request->pay_chk) && !empty($request->pay_chk)) {
            $pay_chk = @implode(",",$request->pay_chk);    
        }
        if(isset($request->pay_session_type) && !empty($request->pay_session_type)) {
            $pay_session_type = @implode(",",$request->pay_session_type);    
        }
        if(isset($request->pay_session) && !empty($request->pay_session)) {
            $pay_session = @implode(",",$request->pay_session);    
        }
        if(isset($request->pay_price) && !empty($request->pay_price)) {
            $pay_price = @implode(",",$request->pay_price);    
        }
        if(isset($request->pay_discountcat) && !empty($request->pay_discountcat)) {
            $pay_discountcat = @implode(",",$request->pay_discountcat);    
        }
        if(isset($request->pay_discounttype) && !empty($request->pay_discounttype)) {
            $pay_discounttype = @implode(",",$request->pay_discounttype);    
        }
        if(isset($request->pay_discount) && !empty($request->pay_discount)) {
            $pay_discount = @implode(",",$request->pay_discount);    
        }
        if(isset($request->pay_estearn) && !empty($request->pay_estearn)) {
            $pay_estearn = @implode(",",$request->pay_estearn);    
        }
        if(isset($request->pay_setnum) && !empty($request->pay_setnum)) {
            $pay_setnum = @implode(",",$request->pay_setnum);    
        }
        if(isset($request->pay_setduration) && !empty($request->pay_setduration)) {
            $pay_setduration = @implode(",",$request->pay_setduration);    
        }
        if(isset($request->pay_after) && !empty($request->pay_after)) {
            $pay_after = @implode(",",$request->pay_after);    
        }
        
        if(isset($request->membership_type) && !empty($request->membership_type)) {
            $membership_type = @implode(",",$request->membership_type);    
        }
        if(isset($request->is_recurring) && !empty($request->is_recurring)) {
            $is_recurring = @implode(",",$request->is_recurring);    
        }
        if(isset($request->recurring_price) && !empty($request->recurring_price)) {
            $recurring_price = @implode(",",$request->recurring_price);    
        }
        if(isset($request->recurring_every) && !empty($request->recurring_every)) {
            $recurring_every = @implode(",",$request->recurring_every);    
        }
        if(isset($request->recurring_duration) && !empty($request->recurring_duration)) {
            $recurring_duration = @implode(",",$request->recurring_duration);    
        }
        if(isset($request->fitnessity_fee) && !empty($request->fitnessity_fee)) {
            $fitnessity_fee = @implode(",",$request->fitnessity_fee);    
        }
        
        $businessPayment_1 = [
            "cid" => $request->cid,
            "userid" => $request->userid,
            "serviceid" => $serid_pay,
            "pay_chk" => $pay_chk,
            "pay_session_type" => $pay_session_type,
            "pay_session" => $pay_session,
            "pay_price" => $pay_price,
            "pay_discountcat" => $pay_discountcat,
            "pay_discounttype" => $pay_discounttype,
            "pay_discount" => $pay_discount,
            "pay_estearn" => $pay_estearn,
            "pay_setnum" => $pay_setnum,
            "pay_setduration" => $pay_setduration,
            "pay_after" => $pay_after,
            "recurring_price"=>$recurring_price,
            "recurring_every"=>$recurring_every,
            "recurring_duration"=>$recurring_duration,
            "fitnessity_fee"=>$fitnessity_fee
        ];
        $bid=0;
        $business_service_count = BusinessServices::where('cid', $request->cid)->where('userid', Auth::user()->id)->where('id',$serid_pay)->count();
        $business_service = BusinessServices::where('cid', $request->cid)->where('userid', Auth::user()->id)->where('id', $request->serviceid)->get();
        
        if($business_service_count<=0){
              $bdata=BusinessServices::create($businessData);
              $bid=$bdata->id;
              $serid_pay=$bdata->id;
        } else { 
            BusinessServices::where('cid', $request->cid)->where('userid', Auth::user()->id)->where('id', $serid_pay)->update($businessData);
        }
        //exit;
        $shift_start = $shift_end = $set_duration = $activity_days = "";
        if(isset($request->shift_start) && !empty($request->shift_start)) {
            $shift_start = @implode(",",$request->shift_start);    
        }
        if(isset($request->shift_end) && !empty($request->shift_end)) {
            $shift_end = @implode(",",$request->shift_end);    
        }
        if(isset($request->set_duration) && !empty($request->set_duration)) {
            $set_duration = @implode(",",$request->set_duration);    
        }
        if(isset($request->activity_days) && !empty($request->activity_days)) {
            $activity_days = @implode(",",$request->activity_days);    
        }
       
        
        $paycount = count($request->category_title);
        if($paycount > 0) {
            $alldata_cat = BusinessPriceDetailsAges::where('cid', $request->cid)->where('userid', Auth::user()->id)->where('serviceid', $serid_pay)->get();
            $alldata_price = BusinessPriceDetails::where('cid', $request->cid)->where('userid', Auth::user()->id)->where('serviceid', $serid_pay)->get();
            $idary_cat = array();
            $idary_cat1 = array();
            $idary_price = array();
            $idary_price1 = array();

            foreach($alldata_cat as $data_all){
                $idary_cat[] =  $data_all['id'];
            }
            foreach($alldata_price as $data_all){
                $idary_price[] =  $data_all['id'];
            }

            for($i=0; $i < $paycount; $i++) {
                if($request->cat_id_db[$i] != ''){
                    $idary_cat1[] = $request->cat_id_db[$i];
                }
                
                $businessages= [
                    "category_title" => isset($request->category_title[$i]) ? $request->category_title[$i] : '',
                    "cid" => $request->cid,
                    "userid" => $request->userid,
                    "serviceid" => $serid_pay,
                    "dues_tax" => isset($request->dues_tax[$i]) ? $request->dues_tax[$i] : '',
                    "sales_tax" => isset($request->sales_tax[$i]) ? $request->sales_tax[$i] : '',
                ];
                if($request->cat_id_db[$i] != ''){
                    $db_status = 'update';
                    $create = BusinessPriceDetailsAges::where('id',$request->cat_id_db[$i])->update($businessages);
                }else{
                    $db_status = 'create';
                    $create = BusinessPriceDetailsAges::create($businessages);
                }
                /*print_r($create);exit;*/
                $age_cnt = $request->input('ages_count'.$i);
                if($age_cnt >= 0){
                    for($y=0; $y <= $age_cnt; $y++) {
                        if($request->input('price_id_db_'.$i.$y)){
                            $idary_price1[] = $request->input('price_id_db_'.$i.$y);
                        }

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
                            $recurring_customer_chage_by_adult = $request->input('recurring_customer_chage_by_adult_'.$i.$y);
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
                            $recurring_customer_chage_by_adult = NULL;
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
                            $recurring_customer_chage_by_child = $request->input('recurring_customer_chage_by_child_'.$i.$y);
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
                            $recurring_customer_chage_by_child = NULL;
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
                            $recurring_customer_chage_by_infant = $request->input('recurring_customer_chage_by_infant_'.$i.$y);
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
                            $recurring_customer_chage_by_infant = NULL;
                        }
                        
                        if($db_status == 'update'){
                            $cat_new_id = $request->cat_id_db[$i];
                        }else{
                            $cat_new_id = $create->id;
                        }

                        $adult_cus_weekly_price = $adult_weekend_price_diff = $adult_discount =  $adult_estearn = $weekend_adult_estearn = $child_cus_weekly_price = $child_discount = $child_weekend_price_diff = $child_estearn = $weekend_child_estearn = $infant_cus_weekly_price = $infant_weekend_price_diff =$infant_discount =$infant_estearn =  $weekend_infant_estearn =  NULL; 
                        if($request->input('sectiondisplay'.$i.$y) == 'freeprice'){
                            $adult_cus_weekly_price = $adult_weekend_price_diff = $adult_discount =  $adult_estearn = $weekend_adult_estearn = $child_cus_weekly_price = $child_discount = $child_weekend_price_diff = $child_estearn = $weekend_child_estearn = $infant_cus_weekly_price = $infant_weekend_price_diff =$infant_discount =$infant_estearn =  $weekend_infant_estearn =  0;
                        }else{
                            if($request->input('adult_cus_weekly_price_'.$i.$y) != 0){
                                $adult_cus_weekly_price =  $request->input('adult_cus_weekly_price_'.$i.$y);
                            }

                            if($request->input('adult_weekend_price_diff_'.$i.$y) != 0){
                                $adult_weekend_price_diff =  $request->input('adult_weekend_price_diff_'.$i.$y);
                            }
                            if($request->input('adult_discount_'.$i.$y) != 0){    
                                $adult_discount = $request->input('adult_discount_'.$i.$y);
                            }

                            if($request->input('adult_estearn_'.$i.$y) != 0){    
                                $adult_estearn = $request->input('adult_estearn_'.$i.$y);
                            }

                            if($request->input('weekend_adult_estearn_'.$i.$y) != 0){    
                                $weekend_adult_estearn = $request->input('weekend_adult_estearn_'.$i.$y);
                            }
                            if($request->input('child_cus_weekly_price_'.$i.$y) != 0){    
                                $child_cus_weekly_price = $request->input('child_cus_weekly_price_'.$i.$y);
                            }
                            if($request->input('child_discount_'.$i.$y) != 0){    
                                $child_discount = $request->input('child_discount_'.$i.$y);
                            }
                            if($request->input('child_weekend_price_diff_'.$i.$y) != 0){    
                                $child_weekend_price_diff = $request->input('child_weekend_price_diff_'.$i.$y);
                            }
                            if($request->input('child_estearn_'.$i.$y) != 0){    
                                $child_estearn = $request->input('child_estearn_'.$i.$y);
                            }

                            if($request->input('weekend_child_estearn_'.$i.$y) != 0){    
                                $weekend_child_estearn = $request->input('weekend_child_estearn_'.$i.$y);
                            }
                            if($request->input('infant_cus_weekly_price_'.$i.$y) != 0){    
                                $infant_cus_weekly_price = $request->input('infant_cus_weekly_price_'.$i.$y);
                            }
                            if($request->input('infant_weekend_price_diff_'.$i.$y) != 0){    $infant_weekend_price_diff = $request->input('infant_weekend_price_diff_'.$i.$y);
                            }

                            if($request->input('infant_discount_'.$i.$y) != 0){    
                                $infant_discount = $request->input('infant_discount_'.$i.$y);
                            }

                            if($request->input('infant_estearn_'.$i.$y) != 0){    $infant_estearn =  $request->input('infant_estearn_'.$i.$y);
                            }

                            if($request->input('weekend_infant_estearn_'.$i.$y) != 0){    $weekend_infant_estearn =  $request->input('weekend_infant_estearn_'.$i.$y);
                            }

                        }

                        $businessPayment = [
                            "category_id" => $cat_new_id,
                            "business_service_id"=>$bid,
                            "cid" => $request->cid,
                            "userid" => $request->userid,
                            "serviceid" => $serid_pay,
                            "pay_chk" => isset($request->pay_chk[$i]) ? $request->pay_chk[$i] : '',
                            /* "pay_price" => isset($request->pay_price[$i]) ? $request->pay_price[$i] : '',
                            "pay_discountcat" => isset($request->pay_discountcat[$i]) ? $request->pay_discountcat[$i] : '',
                            "pay_discounttype" => isset($request->pay_discounttype[$i]) ? $request->pay_discounttype[$i] : '',
                            "pay_discount" => isset($request->pay_discount[$i]) ? $request->pay_discount[$i] : '',
                            "pay_estearn" => isset($request->pay_estearn[$i]) ? $request->pay_estearn[$i] : '',*/
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
                            "recurring_customer_chage_by_adult" => $recurring_customer_chage_by_adult,

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
                            "recurring_customer_chage_by_child" => $recurring_customer_chage_by_child,

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
                            "recurring_customer_chage_by_infant" => $recurring_customer_chage_by_infant,
                            /*"recurring_every"=>$infantrecurring_every,
                            "recurring_duration"=> $infantrecurring_duration,*/
                            "fitnessity_fee"=> isset($request->fitnessity_fee) ? $request->fitnessity_fee : '',
                            "pay_setnum" => $request->input('pay_setnum_'.$i.$y),
                            "pay_setduration" => $request->input('pay_setduration_'.$i.$y),
                            "pay_after" => $request->input('pay_after_'.$i.$y),
                            "pay_session_type" => $request->input('pay_session_type_'.$i.$y),
                            "membership_type" =>  $request->input('membership_type_'.$i.$y),
                            "pay_session" => $request->input('pay_session_'.$i.$y),
                            "price_title" => $request->input('price_title_'.$i.$y),
                            "adult_cus_weekly_price" => $adult_cus_weekly_price,
                            "adult_weekend_price_diff" =>  $adult_weekend_price_diff,
                            "adult_discount" => $adult_discount, 
                            "adult_estearn" => $adult_estearn,
                            "weekend_adult_estearn" => $weekend_adult_estearn,
                            "child_cus_weekly_price" => $child_cus_weekly_price ,
                            "child_discount" => $child_discount,
                            "child_weekend_price_diff" => $child_weekend_price_diff,
                            "child_estearn" => $child_estearn,
                            "weekend_child_estearn" => $weekend_child_estearn,
                            "infant_cus_weekly_price" => $infant_cus_weekly_price,
                            "infant_weekend_price_diff" => $infant_weekend_price_diff, 
                            "infant_discount" => $infant_discount, 
                            "infant_estearn" =>  $infant_estearn,  
                            "weekend_infant_estearn" =>  $weekend_infant_estearn,  
                        ];
                       /* print_r($businessPayment);*/
                        if($request->input('price_id_db_'.$i.$y) != ''){
                            BusinessPriceDetails::where('id',$request->input('price_id_db_'.$i.$y))->update($businessPayment);
                        }else{
                            BusinessPriceDetails::create($businessPayment);
                        }
                    }
                }
            }

            $differenceArray_cat1 = array_diff($idary_cat, $idary_cat1);
            foreach($differenceArray_cat1 as $deletdata){
                BusinessPriceDetailsAges::where('id',$deletdata)->delete();
            }

            $differenceArray_price1 = array_diff($idary_price, $idary_price1);
            foreach($differenceArray_price1 as $deletdata){
                BusinessPriceDetails::where('id',$deletdata)->delete();
            }
        }
            
        CompanyInformation::where('id', $request->cid)->update(['serviceid' => $request->serviceid]);
        User::where('id', Auth::user()->id)->update(['bstep' => 7, 'serviceid' => 0, 'servicetype' => '']);
       
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        $companyInfo = CompanyInformation::where('id', $request->cid)->orderBy('id', 'DESC')->first();
        $companyservice = BusinessServices::where('userid', Auth::user()->id)->where('cid', $request->cid)->orderBy('id', 'DESC')->get();
        $popupserviceid = $serid_pay;
        $companyid = @$companyInfo->id;
        $companyname = @$companyInfo->name;
        return view('business.services.index', compact('cart', 'companyid', 'companyname', 'companyservice','popupserviceid'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request , $business_id,$service)
    {
       $businessData = [
            'bstep' => 72,
            'cid' => $request->cid,
            'serviceid' => $request->serviceid,
            'servicetype' => $request->service_type
        ];
        
        User::where('id', Auth::user()->id)->update($businessData);
        if($request->btnedit == 'Edit') {
            return redirect()->route('createNewBusinessProfile');
        }

        if($request->btnactive == 'Active') {
            BusinessServices::where('cid', $request->cid)->where('id', $request->serviceid)->where('userid', Auth::user()->id)->update(['is_active' => 1]);
            return redirect()->route('business.services.index');
        }

        if($request->btnactive == 'Inactive') {
             BusinessServices::where('cid', $request->cid)->where('id', $request->serviceid)->where('userid', Auth::user()->id)->update(['is_active' => 0]);
            return redirect()->route('business.services.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
