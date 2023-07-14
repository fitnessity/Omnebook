<?php
namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\{CompanyInformation,User,BusinessServicesMap,BusinessServices,BusinessPriceDetailsAges,BusinessPriceDetails,Miscellaneous,Sports,BusinessStaff};
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
        $companyInfo = $request->current_company;
        $services = @$companyInfo->service->sortByDesc('created_at');
        $companyId = @$companyInfo->id;
        $companyName = @$companyInfo->dba_business_name;
        return view('business.services.index', compact('companyName','companyId', 'services'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $fitnessity_fee = $recurring_fee= 0;
        $fitnessity_fee = Auth::user()->fitnessity_fee;
        $recurring_fee = Auth::user()->recurring_fee;
        $company = $request->current_company;
        $companyId =  $company->id;

        $serviceId = $request->serviceId != '' ? $request->serviceId : '0';
        $businessData = [
            'cid' =>  $companyId,
            'serviceid' => $serviceId,
            'servicetype' => $request->serviceType
        ];

        User::where('id', Auth::user()->id)->update($businessData);
        $serviceType =  $request->serviceType;

        $service = $company->service()->where(['id'=>$serviceId,'service_type'=>$request->serviceType])->first();
        $reqSafety = explode(',',@$service->req_safety);
        $proofVerification = empty($reqSafety) ? "" : (in_array("id_proof", $reqSafety) ? "checked" : "");
        $vaccinefVerification = empty($reqSafety) ? "" : (in_array("id_vaccine", $reqSafety) ? "checked" : "");
        $covidVerification = empty($reqSafety) ? "" : (in_array("id_covid", $reqSafety) ? "checked" : "");
        
        $profile_pic = explode(',', @$service->profile_pic);
        $staffData = BusinessStaff::where('business_id',$companyId)->get();
        $sportsData = Sports::where('is_deleted','0')->where('parent_sport_id', '=', NULL)->orWhere('parent_sport_id', '=', "''")->orderBy('sport_name')->get();
        if($service == '' && $serviceId != 0){
            return redirect(route('business.services.create',["serviceType"=> $request->serviceType,'business_id'=>$companyId]));
        }
        return view('business.services.create', compact('serviceType','sportsData','staffData','service','profile_pic','companyId','serviceId','proofVerification','vaccinefVerification','covidVerification','fitnessity_fee','recurring_fee'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // print_r($request->all()); 
        $profilePicture = $dayImage = $safe_varification ="";

        $user = Auth::user();
        $companyInfo = $request->current_company;
        $companyid = $companyInfo->id;
        $serviceId = $request->serviceId != '' ? $request->serviceId : '0';
        $thisService = $companyInfo->service()->where('id', $serviceId)->first(); 

        if($request->step == '1'){
            if($thisService != ''){
                if($thisService->profile_pic != ''){
                    $img = rtrim($thisService->profile_pic,',');
                    $profilePicture .= $img.',';
                }
            }
            if ($request->hasFile('imgUpload')) {
                for($i=0;$i<count($request->imgUpload);$i++){
                    $imagestore = ($request->imgUpload[$i])->store('activity');
                    $profilePicture .= $imagestore.',';
                }
            }

            $profilePicture= rtrim($profilePicture,',');
            $serviceData = [
                'cid' => $companyid,
                'userid' => $user->id,
                'serviceid' => $serviceId,
                'service_type' =>$request->serviceType,
                'profile_pic' => $profilePicture,
                'sport_activity' => $request->sports,
                'program_name' => $request->programName,
                'program_desc' => $request->programDesc,
                'know_before_you_go' => $request->thingsToKnow,
                'instructor_id' => $request->instructor_id,
            ];
        }else if($request->step == '2'){
            $instant = $request->has('instantbooking') ? 1 : 0;
            $requestbooking = $request->has('requestbooking') ? 1 : 0;
            $serviceTypes =     $request->serviceTypes != ''  ? implode(',' , $request->serviceTypes) :  '';
            $serviceLocation = $request->serviceLocation != ''  ? implode(',' ,$request->serviceLocation ) :  '';
            $programFor =      $request->programFor != ''  ? implode(',' , $request->programFor  ) :  '';
            $ageRange =        $request->ageRange != ''  ? implode(',' ,$request->ageRange ) :  '';
            $serviceFocus = $request->serviceFocus != ''  ? implode(',' , $request->serviceFocus ) :  '';
            $teachingStyle =   $request->teachingStyle != ''  ? implode(',' , $request->teachingStyle ) :  '';
            $difficultLevel =   $request->difficultLevel != ''  ? implode(',' , $request->difficultLevel ) :  '';

            $serviceData = [
                'service_type' =>$request->serviceType,
                'serviceid' => $serviceId,
                "instant_booking" => $instant,
                "request_booking" => $requestbooking,
                'frm_min_participate' => $request->minParticipate,
                'cancelbeforeint' => $request->cancelBeforeInt,
                'cancelbefore' => $request->cancelBefore,
                'select_service_type' => $serviceTypes, 
                'activity_location' => $serviceLocation,
                'activity_for' => $programFor,
                'age_range' => $ageRange,
                'activity_experience' => $serviceFocus,
                'instructor_habit' => $teachingStyle,
                'difficult_level' => $difficultLevel,
            ];  

            if($request->serviceType == 'experience'){
                for ($i=0; $i <count($request->days_title) ; $i++) {   
                    if($request->file('dayplanpic_'.$i)){
                        $dayImageStore = ($request->file('dayplanpic_'.$i))->store('activity/dayplan');
                        $dayImage .= $dayImageStore.',';
                        if($request->input('olddayplanpic_'.$i)){
                            Storage::delete($request->file('olddayplanpic_'.$i));
                        }  
                    }else{
                        $dayImage .= $request->input('olddayplanpic_'.$i) ? $request->input('olddayplanpic_'.$i).',': '';
                    }
                } 

                $safe_varification .= $request->has('idProof') ? 'id_proof,': '';
                $safe_varification .= $request->has('idVaccine') ? 'id_vaccine,': '';
                $safe_varification .= $request->has('idCovid') ? 'id_covid,': '';
                $expAry = [
                    "exp_highlight" =>  $request->expHighlight,
                    "included_items" =>  @implode(",",$request->includedThings),
                    "notincluded_items" =>  @implode(",",$request->notIncludedThings),
                    "bring_wear" =>  @implode(",",$request->wearThings),
                    "accessibility" =>  $request->accessibility,
                    "addi_info" =>  $request->additionalInfo,
                    "days_plan_title" =>  $request->days_title != '' ? json_encode($request->days_title): '',
                    "days_plan_desc" =>  $request->days_description != '' ? json_encode($request->days_description): '',
                    "days_plan_img" =>  $dayImage,
                    "desc_location" =>$request->descLocation,
                    "exp_country" => @$request->cus_country,
                    "exp_address" => @$request->address,
                    "exp_building" => @$request->addiAddress,
                    "exp_city" => @$request->city,
                    "exp_state" => @$request->state,
                    "exp_zip" => @$request->zip,
                    "exp_lat" => @$request->lat,
                    "exp_lng" => @$request->lng,
                    "addi_info_help" => @$request->addiInfoHelp,
                    "req_safety" => $safe_varification,
                ];
                $serviceData = array_merge($serviceData,$expAry);
            }

           /* print_r($serviceData);exit;*/
        }

        if($request->step != '3'){
             if($serviceId != 0){
                $service = $thisService->update($serviceData);
            }else{
                $service = BusinessServices::create($serviceData);
                $serviceId = $service->id;
            }

            return redirect()->route('business.services.create',['serviceType'=>$request->serviceType, 'serviceId'=> $serviceId]);
        }else{
            $paycount = count($request->category_title);
            if($paycount > 0) {
                $idary_cat = $idary_cat1 = $idary_price = $idary_price1 = array();

                $idary_cat= $user->BusinessPriceDetailsAges()->where(['cid'=> $companyid,'serviceid' => $serviceId])->pluck('id')->toArray();

                $idary_price = $user->BusinessPriceDetails()->where(['cid'=> $companyid,'serviceid' => $serviceId])->pluck('id')->toArray();

                for($i=0; $i < $paycount; $i++) {
                    $idary_cat1[] = $request->cat_id_db[$i] != '' ? $request->cat_id_db[$i] : '' ;
                    
                    $businessages= [
                        "category_title" => $request->category_title[$i] != '' ? $request->category_title[$i] : '',
                        "cid" => $user->cid,
                        "userid" =>  $user->id,
                        "serviceid" => $serviceId,
                        "dues_tax" => $request->dues_tax[$i] != '' ? $request->dues_tax[$i] : '',
                        "sales_tax" => $request->sales_tax[$i] != '' ? $request->sales_tax[$i] : '',
                        "visibility_to_public" => @$request->visibility_to_public[$i] != '' ? $request->visibility_to_public[$i] : 0,
                        "service_name" => $request->service_name[$i] != '' ? $request->service_name[$i] : '',
                        "service_price" => $request->service_price[$i] != '' ? $request->service_price[$i] : 0,
                        "service_description" => $request->service_description[$i] != '' ? $request->service_description[$i] : '',
                    ];
                    if($request->cat_id_db[$i] != ''){
                        $db_status = 'update';
                        $create = BusinessPriceDetailsAges::where('id',$request->cat_id_db[$i])->update($businessages);
                    }else{
                        $db_status = 'create';
                        $create = BusinessPriceDetailsAges::create($businessages);
                    }
                   
                    $age_cnt = $request->input('priceCount'.$i);
                    if($age_cnt >= 0){
                        for($y=0; $y <= $age_cnt; $y++) {

                            $idary_price1[] = $request->input('price_id_db_'.$i.$y)  != '' ? $request->input('price_id_db_'.$i.$y) : '' ;

                            $adultrecurring_price = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('recurring_price_adult_'.$i.$y) : NULL;
                            $adultrecurring_run_auto_pay = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('run_auto_pay_adult_'.$i.$y) : NULL;
                            $adultrecurring_cust_be_charge = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('cust_be_charge_adult_'.$i.$y) : NULL;
                            $adultrecurring_every_time_num = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('every_time_num_adult_'.$i.$y) : NULL;
                            $adultrecurring_every_time = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('every_time_adult_'.$i.$y) : NULL;
                            $adultrecurring_nuberofautopays = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('nuberofautopays_adult_'.$i.$y) : NULL;
                            $adultrecurring_happens_aftr_12_pmt = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('happens_aftr_12_pmt_adult_'.$i.$y) : NULL;
                            $adultrecurring_client_be_charge_on = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('client_be_charge_on_adult_'.$i.$y) : NULL;
                            $adultrecurring_first_pmt = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('first_pmt_adult_'.$i.$y) : NULL;
                            $adultrecurring_recurring_pmt = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('recurring_pmt_adult_'.$i.$y) : NULL;
                            $adultrecurring_total_contract_revenue = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('total_contract_revenue_adult_'.$i.$y) : NULL;
                            $recurring_customer_chage_by_adult = $request->input('is_recurring_adult_'.$i.$y) == 1 ? $request->input('customer_charged_num_adult_'.$i.$y).' '.$request->input('customer_charged_time_adult_'.$i.$y) : NULL;
                            
                            $childrecurring_price = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('recurring_price_child_'.$i.$y) : NULL;
                            $childrecurring_run_auto_pay = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('run_auto_pay_child_'.$i.$y) : NULL;
                            $childrecurring_cust_be_charge = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('cust_be_charge_child_'.$i.$y) : NULL;
                            $childrecurring_every_time_num = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('every_time_num_child_'.$i.$y) : NULL;
                            $childrecurring_every_time = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('every_time_child_'.$i.$y) : NULL;
                            $childrecurring_nuberofautopays = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('nuberofautopays_child_'.$i.$y) : NULL;
                            $childrecurring_happens_aftr_12_pmt = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('happens_aftr_12_pmt_child_'.$i.$y) : NULL;
                            $childrecurring_client_be_charge_on = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('client_be_charge_on_child_'.$i.$y) : NULL;
                            $childrecurring_first_pmt = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('first_pmt_child_'.$i.$y) : NULL;
                            $childrecurring_recurring_pmt = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('recurring_pmt_child_'.$i.$y) : NULL;
                            $childrecurring_total_contract_revenue = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('total_contract_revenue_child_'.$i.$y) : NULL;
                            $recurring_customer_chage_by_child = $request->input('is_recurring_child_'.$i.$y) == 1 ? $request->input('customer_charged_num_child_'.$i.$y).' '.$request->input('customer_charged_time_child_'.$i.$y) : NULL;

                            $infantrecurring_price = $request->input('is_recurring_infant_'.$i.$y) == 1 ? $request->input('recurring_price_infant_'.$i.$y) : NULL;
                            $infantrecurring_run_auto_pay = $request->input('is_recurring_infant_'.$i.$y) == 1 ? $request->input('run_auto_pay_infant_'.$i.$y) : NULL;
                            $infantrecurring_cust_be_charge = $request->input('is_recurring_infant_'.$i.$y) == 1 ? $request->input('cust_be_charge_infant_'.$i.$y) : NULL;
                            $infantrecurring_every_time_num = $request->input('is_recurring_infant_'.$i.$y) == 1 ? $request->input('every_time_num_infant_'.$i.$y) : NULL;
                            $infantrecurring_every_time = $request->input('is_recurring_infant_'.$i.$y) == 1 ? $request->input('every_time_infant_'.$i.$y) : NULL;
                            $infantrecurring_nuberofautopays = $request->input('is_recurring_infant_'.$i.$y) == 1 ? $request->input('nuberofautopays_infant_'.$i.$y) : NULL;
                            $infantrecurring_happens_aftr_12_pmt = $request->input('is_recurring_infant_'.$i.$y) == 1 ? $request->input('happens_aftr_12_pmt_infant_'.$i.$y) : NULL;
                            $infantrecurring_client_be_charge_on = $request->input('is_recurring_infant_'.$i.$y) == 1 ? $request->input('client_be_charge_on_infant_'.$i.$y) : NULL;
                            $infantrecurring_first_pmt = $request->input('is_recurring_infant_'.$i.$y) == 1 ? $request->input('first_pmt_infant_'.$i.$y) : NULL;
                            $infantrecurring_recurring_pmt = $request->input('is_recurring_infant_'.$i.$y) == 1 ? $request->input('recurring_pmt_infant_'.$i.$y) : NULL;
                            $infantrecurring_total_contract_revenue = $request->input('is_recurring_infant_'.$i.$y) == 1 ?  $request->input('total_contract_revenue_infant_'.$i.$y) : NULL;
                            $recurring_customer_chage_by_infant = $request->input('is_recurring_infant_'.$i.$y) == 1 ?  $request->input('customer_charged_num_infant_'.$i.$y).' '.$request->input('customer_charged_time_infant_'.$i.$y) : NULL;
            
                            
                            $cat_new_id = $db_status == 'update' ? $request->cat_id_db[$i] : $create->id ;

                            $displaySection = $request->input('sectiondisplay'.$i.$y);

                            if($displaySection == 'freeprice'){
                                $adult_cus_weekly_price = $adult_weekend_price_diff = $adult_discount =  $adult_estearn = $weekend_adult_estearn = $child_cus_weekly_price = $child_discount = $child_weekend_price_diff = $child_estearn = $weekend_child_estearn = $infant_cus_weekly_price = $infant_weekend_price_diff =$infant_discount =$infant_estearn =  $weekend_infant_estearn =  0;
                            }else{

                                if($displaySection == ''){
                                    if( $request->input('adult_weekend_price_diff_'.$i.$y) != '' || $request->input('child_weekend_price_diff_'.$i.$y) || $request->input('infant_weekend_price_diff_'.$i.$y) ){
                                        $displaySection = 'weekendprice';
                                    }else{
                                        $displaySection = 'weekdayprice';
                                    }
                                }

                                $adult_cus_weekly_price = $request->input('adult'.$i.$y) == 'adult' ? $request->input('adult_cus_weekly_price_'.$i.$y) : '';
                                $adult_weekend_price_diff =  $request->input('adult'.$i.$y) == 'adult' ? $request->input('adult_weekend_price_diff_'.$i.$y) : '';
                                $adult_discount = $request->input('adult'.$i.$y) == 'adult' ? $request->input('adult_discount_'.$i.$y) : '';
                                $adult_estearn = $request->input('adult'.$i.$y) == 'adult' ? $request->input('adult_estearn_'.$i.$y) : '';
                                $weekend_adult_estearn = $request->input('adult'.$i.$y) =='adult' ? $request->input('weekend_adult_estearn_'.$i.$y) : '';
                                $child_cus_weekly_price = $request->input('child'.$i.$y)=='child' ? $request->input('child_cus_weekly_price_'.$i.$y) : '';
                                $child_discount = $request->input('child'.$i.$y) == 'child' ? $request->input('child_discount_'.$i.$y) : '';
                                $child_weekend_price_diff = $request->input('child'.$i.$y) == 'child' ? $request->input('child_weekend_price_diff_'.$i.$y) : '';
                                $child_estearn = $request->input('child'.$i.$y) == 'child' ? $request->input('child_estearn_'.$i.$y) : '';
                                $weekend_child_estearn = $request->input('child'.$i.$y) == 'child' ? $request->input('weekend_child_estearn_'.$i.$y) : '';
                                $infant_cus_weekly_price = $request->input('infant'.$i.$y) == 'infant' ? $request->input('infant_cus_weekly_price_'.$i.$y) : '';
                                $infant_weekend_price_diff = $request->input('infant'.$i.$y) == 'infant' ? $request->input('infant_weekend_price_diff_'.$i.$y) : '';
                                $infant_discount = $request->input('infant'.$i.$y) == 'infant' ? $request->input('infant_discount_'.$i.$y) : '';
                                $infant_estearn =  $request->input('infant'.$i.$y) == 'infant' ? $request->input('infant_estearn_'.$i.$y) : '';
                                $weekend_infant_estearn =  $request->input('infant'.$i.$y) == 'infant' ? $request->input('weekend_infant_estearn_'.$i.$y) : '';
                            }

                            $businessPayment = [
                                "category_id" => $cat_new_id,
                                "dispaly_section" => $displaySection,
                                "business_service_id"=>$serviceId,
                                "cid" => $user->cid,
                                "userid" => $user->id,
                                "serviceid" => $serviceId,
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

                                "fitnessity_fee"=> $user->fitnessity_fee,
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

            $companyservice = $companyInfo->service->sortByDesc('created_at');
            $popupserviceid = '';
            $companyname = $companyInfo->name;
            return redirect()->route('business.services.index');
        }   
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id ,$serviceID)
    {   
        $company = $request->current_company;
        if($request->btnactive == 'Active') {
            BusinessServices::where('cid', $company->id)->where('id', $serviceID)->where('userid', Auth::user()->id)->update(['is_active' => 1]);
        }

        if($request->btnactive == 'Inactive') {
             BusinessServices::where('cid', $company->id)->where('id', $serviceID)->where('userid', Auth::user()->id)->update(['is_active' => 0]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$business_id , $id )
    {
        $company = $request->current_company;
        $business_service = $company->service()->findOrFail($id);
        $business_service->delete();
    }

    public function select(Request $request, $business_id){
        $company = $request->current_company;
        $companyService = $company->service()->orderBy('id', 'DESC')->get();
        return view('business.services.select',compact('business_id','companyService'));
    }

    public function destroyimage(Request $request){
        $company = $request->current_company;
        $service = $company->service()->findOrFail($request->serviceid);
        $profile_pic1 = str_contains($service->profile_pic, ',') ? explode(',', $service->profile_pic) : $service->profile_pic;

        $pro_img = '';
        if(is_array($profile_pic1)){
            foreach($profile_pic1 as $key => $data){
                if ($request->imgname != $data) {
                    if($data != ''){
                       $pro_img .= $data.',';
                    }
                }else{
                    Storage::delete($request->imgname);
                }
            }
        }

        $pro_img = rtrim($pro_img,',');
        $updateval = $service->update(['profile_pic' => $pro_img]);
        if($updateval == true){
            return "success";
        }else{
            return "fail";
        }
    }
}
