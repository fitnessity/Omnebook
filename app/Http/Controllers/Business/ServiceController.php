<?php
namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\{CompanyInformation,User,BusinessServicesMap,BusinessServices,BusinessPriceDetailsAges,BusinessPriceDetails,Miscellaneous,Sports,BusinessStaff,AddOnService};
use Auth;
use Illuminate\Support\Facades\Session;

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
        $displayModal  = '';
        if(session()->has('scheduleEdit')){
            $displayModal =  Session::get('scheduleEdit');
            Session::forget('scheduleEdit');
        }

        return view('business.services.index', compact('companyName','companyId', 'services','displayModal'));
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

        $categoryData = empty(@$service->BusinessPriceDetailsAges) ? [] : @$service->BusinessPriceDetailsAges;
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
        return view('business.services.create', compact('serviceType','sportsData','staffData','service','profile_pic','companyId','serviceId','proofVerification','vaccinefVerification','covidVerification','fitnessity_fee','recurring_fee','categoryData'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($request->all()); 
        $profilePicture = $dayImage = $safe_varification ="";

        $user = Auth::user();
        $companyInfo = $request->current_company;
        $companyid = $companyInfo->id;
        $serviceId = $request->serviceId ?? 0;
        $thisService = $companyInfo->service()->where('id', $serviceId)->first(); 

        if($request->step == '1'){
            if($thisService != ''  && $thisService->profile_pic != ''){
                $img = rtrim($thisService->profile_pic,',');
                $profilePicture .= $img.',';
            }

            if ($request->hasFile('imgUpload')) {
                foreach ($request->imgUpload as $file) {
                    $imagestore = $file->store('activity');
                    $profilePicture .= $imagestore . ',';
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
                $idary_cat = $idary_cat1 = $idary_price = $idary_price1 = $idary_addOn = $idary_addOn1 = array();

                $idary_cat= $user->BusinessPriceDetailsAges()->where(['cid'=> $companyid,'serviceid' => $serviceId])->pluck('id')->toArray();

                $idary_addOn = $user->AddOnService()->where(['cid'=> $companyid,'serviceid' => $serviceId])->pluck('id')->toArray();

                $idary_price = $user->BusinessPriceDetails()->where(['cid'=> $companyid,'serviceid' => $serviceId])->pluck('id')->toArray();



                for($i=0; $i < $paycount; $i++) {
                    $idary_cat1[] =  $request->cat_id_db[$i] ?? '';
                    $businessages= [
                        "category_title" => $request->category_title[$i] ?? '',
                        "cid" => $user->cid,
                        "userid" =>  $user->id,
                        "serviceid" => $serviceId,
                       /* "dues_tax" => $request->dues_tax[$i] ?? '',
                        "sales_tax" => $request->sales_tax[$i] ?? '',*/
                        "visibility_to_public" => in_array('V'.$i, @$request->visibility_to_public) ? 1 : 0,
                    ];

                    $createOrUpdate = BusinessPriceDetailsAges::updateOrCreate(['id' => $request->cat_id_db[$i]], $businessages);

                    //print_r($createOrUpdate);

                    $cat_new_id = $createOrUpdate->id; 
        
                    $age_cnt = $request->input('priceCount'.$i);
                    if($age_cnt >= 0){
                        for($y=0; $y <= $age_cnt; $y++) {

                            $idary_price1[] = $request->input('price_id_db_' . $i . $y) ?? '';
                            $isRecurringAdult = $request->input('is_recurring_adult_' . $i . $y);
                            $isRecurringChild = $request->input('is_recurring_child_' . $i . $y);
                            $isRecurringInfant = $request->input('is_recurring_infant_' . $i . $y);
                            $displaySection = $this->getDisplaySection($request, $i, $y);
                            $businessPrice = [
                                "category_id" => $cat_new_id,
                                "dispaly_section" => $displaySection,
                                "business_service_id"=>$serviceId,
                                "cid" => $user->cid,
                                "userid" => $user->id,
                                "serviceid" => $serviceId,
                                "is_recurring_adult"=>  $isRecurringAdult,
                                "recurring_price_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'recurring_price_adult_', $i, $y),
                                "recurring_run_auto_pay_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'run_auto_pay_adult_', $i, $y),
                                "recurring_cust_be_charge_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'cust_be_charge_adult_', $i, $y),
                                "recurring_every_time_num_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'every_time_num_adult_', $i, $y),
                                "recurring_every_time_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'every_time_adult_', $i, $y),
                                "recurring_nuberofautopays_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'nuberofautopays_adult_', $i, $y),
                                "recurring_happens_aftr_12_pmt_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'happens_aftr_12_pmt_adult_', $i, $y),
                                "recurring_client_be_charge_on_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'client_be_charge_on_adult_', $i, $y),
                                "recurring_first_pmt_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'first_pmt_adult_', $i, $y),
                                "recurring_recurring_pmt_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'recurring_pmt_adult_', $i, $y),
                                "recurring_total_contract_revenue_adult" =>  $this->getRecurringValue($isRecurringAdult, $request, 'total_contract_revenue_adult_', $i, $y),

                                "recurring_customer_chage_by_adult" => $this->getRecurringCustomerChargeBy($isRecurringAdult, $request, 'customer_charged_num_adult_', 'customer_charged_time_adult_', $i, $y),

                               "is_recurring_child" => $isRecurringChild,
                                "recurring_price_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'recurring_price_child_', $i, $y),
                                "recurring_run_auto_pay_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'run_auto_pay_child_', $i, $y),
                                "recurring_cust_be_charge_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'cust_be_charge_child_', $i, $y),
                                "recurring_every_time_num_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'every_time_num_child_', $i, $y),
                                "recurring_every_time_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'every_time_child_', $i, $y),
                                "recurring_nuberofautopays_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'nuberofautopays_child_', $i, $y),
                                "recurring_happens_aftr_12_pmt_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'happens_aftr_12_pmt_child_', $i, $y),
                                "recurring_client_be_charge_on_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'client_be_charge_on_child_', $i, $y),
                                "recurring_first_pmt_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'first_pmt_child_', $i, $y),
                                "recurring_recurring_pmt_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'recurring_pmt_child_', $i, $y),
                                "recurring_total_contract_revenue_child" =>  $this->getRecurringValue($isRecurringChild, $request, 'total_contract_revenue_child_', $i, $y),
                                "recurring_customer_chage_by_child" => $this->getRecurringCustomerChargeBy($isRecurringChild, $request, 'customer_charged_num_child_', 'customer_charged_time_child_', $i, $y),

                                "is_recurring_infant" => $isRecurringInfant,
                                "recurring_price_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'recurring_price_infant_', $i, $y),
                                "recurring_run_auto_pay_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'run_auto_pay_infant_', $i, $y),
                                "recurring_cust_be_charge_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'cust_be_charge_infant_', $i, $y),
                                "recurring_every_time_num_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'every_time_num_infant_', $i, $y),
                                "recurring_every_time_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'every_time_infant_', $i, $y),
                                "recurring_nuberofautopays_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'nuberofautopays_infant_', $i, $y),
                                "recurring_happens_aftr_12_pmt_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'happens_aftr_12_pmt_infant_', $i, $y),
                                "recurring_client_be_charge_on_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'client_be_charge_on_infant_', $i, $y),
                                "recurring_first_pmt_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'first_pmt_infant_', $i, $y),
                                "recurring_recurring_pmt_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'recurring_pmt_infant_', $i, $y),
                                "recurring_total_contract_revenue_infant" =>  $this->getRecurringValue($isRecurringInfant, $request, 'total_contract_revenue_infant_', $i, $y),
                                "recurring_customer_chage_by_infant" => $this->getRecurringCustomerChargeBy($isRecurringInfant, $request, 'customer_charged_num_infant_', 'customer_charged_time_infant_', $i, $y),

                                "fitnessity_fee"=> $user->fitnessity_fee,
                                "pay_setnum" => $request->input('pay_setnum_'.$i.$y),
                                "pay_setduration" => $request->input('pay_setduration_'.$i.$y),
                                "pay_after" => $request->input('pay_after_'.$i.$y),
                                "pay_session_type" => $request->input('pay_session_type_'.$i.$y),
                                "membership_type" =>  $request->input('membership_type_'.$i.$y),
                                "pay_session" => $request->input('pay_session_'.$i.$y),
                                "price_title" => $request->input('price_title_'.$i.$y),

                                "adult_cus_weekly_price" =>  $this->getSectionValue($request, $i, $y, 'adult', 'adult_cus_weekly_price_', $displaySection),
                                "adult_weekend_price_diff" =>  $this->getSectionValue($request, $i, $y, 'adult', 'adult_weekend_price_diff_', $displaySection),
                                "adult_discount" =>  $this->getSectionValue($request, $i, $y, 'adult', 'adult_discount_', $displaySection),
                                "adult_estearn" =>  $this->getSectionValue($request, $i, $y, 'adult', 'adult_estearn_', $displaySection),
                                "weekend_adult_estearn" =>  $this->getSectionValue($request, $i, $y, 'adult', 'weekend_adult_estearn_', $displaySection),
                                "child_cus_weekly_price" =>  $this->getSectionValue($request, $i, $y, 'child', 'child_cus_weekly_price_', $displaySection),
                                "child_discount" =>  $this->getSectionValue($request, $i, $y, 'child', 'child_discount_', $displaySection),
                                "child_weekend_price_diff" =>  $this->getSectionValue($request, $i, $y, 'child', 'child_weekend_price_diff_', $displaySection),
                                "child_estearn" =>  $this->getSectionValue($request, $i, $y, 'child', 'child_estearn_', $displaySection),
                                "weekend_child_estearn" =>  $this->getSectionValue($request, $i, $y, 'child', 'weekend_child_estearn_', $displaySection),
                                "infant_cus_weekly_price" =>  $this->getSectionValue($request, $i, $y, 'infant', 'infant_cus_weekly_price_', $displaySection),
                                "infant_weekend_price_diff" =>  $this->getSectionValue($request, $i, $y, 'infant', 'infant_weekend_price_diff_', $displaySection),
                                "infant_discount" =>  $this->getSectionValue($request, $i, $y, 'infant', 'infant_discount_', $displaySection),
                                "infant_estearn" =>  $this->getSectionValue($request, $i, $y, 'infant', 'infant_estearn_', $displaySection),
                                "weekend_infant_estearn" =>  $this->getSectionValue($request, $i, $y, 'infant', 'weekend_infant_estearn_', $displaySection), 
                            ];
                            
                            $createOrUpdate = BusinessPriceDetails::updateOrCreate(['id' => $request->input('price_id_db_' . $i . $y)], $businessPrice);
                        }
                    }

                    $addOnCnt = $request->input('addOnServiceCount'.$i);
                    if($addOnCnt >= 0){
                        for($z=0; $z <= $addOnCnt; $z++) {
                            if($request->input('service_name_'.$i.$z) != ''){
                                $idary_addOn1[] = $request->input('add_on_service_id_db_'.$i.$z)  ?? '' ;
                                $businessAddOnService = [
                                    "category_id" => $cat_new_id,
                                    "serviceid" => $serviceId,
                                    "cid" => $user->cid,
                                    "user_id" => $user->id,
                                    "service_name"=>$request->input('service_name_'.$i.$z)  ?? NULL,
                                    "service_price" =>  $request->input('service_price_'.$i.$z) ?? 0,
                                    "service_description" => $request->input('service_description_'.$i.$z) ?? NULL,
                                ];

                                $createOrUpdate = AddOnService::updateOrCreate(['id' => $request->input('add_on_service_id_db_' . $i . $z)], $businessAddOnService);
                            }
                        }
                    }
                }

                $differenceArray_cat1 = array_diff($idary_cat, $idary_cat1);
                BusinessPriceDetailsAges::whereIn('id', $differenceArray_cat1)->delete();
                
                $differenceArray_price1 = array_diff($idary_price, $idary_price1);
                BusinessPriceDetails::whereIn('id',$differenceArray_price1)->delete();

                $differenceArray_AOS1 = array_diff($idary_addOn, $idary_addOn1);
                AddOnService::whereIn('id',$differenceArray_AOS1)->delete();
            }

            $companyservice = $companyInfo->service->sortByDesc('created_at');
            $popupserviceid = '';
            $companyname = $companyInfo->name;
            return redirect()->route('business.services.index');
        }   
    }

    public function getRecurringValue($isRecurring, $request, $fieldPrefix, $i, $y)
    {
        if ($isRecurring == 1) {
            return $request->input($fieldPrefix . $i . $y);
        }
        return NULL;
    }

    public function getRecurringCustomerChargeBy($isRecurring, $request, $numFieldPrefix, $timeFieldPrefix, $i, $y)
    {
        if ($isRecurring == 1) {
            $numValue = $request->input($numFieldPrefix . $i . $y);
            $timeValue = $request->input($timeFieldPrefix . $i . $y);
            return $numValue . ' ' . $timeValue;
        }

        return NULL;
    }

    public function getSectionValue($request, $i, $y, $section, $fieldPrefix,$displaySection)
    {   
        if ($displaySection != 'freeprice') {
            if ($request->input($section . $i . $y) == $section) {
                return $request->input($fieldPrefix . $i . $y);
            }
            return '';
        }
        return '';
    }

    public function getDisplaySection($request, $i, $y)
    {
        $displaySection = $request->input('sectiondisplay'.$i.$y);
        if ($displaySection == 'freeprice') {
            return 'freeprice';
        } elseif ($displaySection == '') {
            if ($request->input('adult_weekend_price_diff_'.$i.$y)!=''||$request->input('child_weekend_price_diff_'.$i.$y)||$request->input('infant_weekend_price_diff_'.$i.$y))
            {
               return 'weekendprice';
            } else {
                return 'weekdayprice';
            }
        }
        return $displaySection;
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
