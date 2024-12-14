<?php
namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\{CompanyInformation,User,BusinessServicesMap,BusinessServices,BusinessPriceDetailsAges,BusinessPriceDetails,Miscellaneous,Sports,BusinessStaff,AddOnService,BusinessClassPriceDetails,BusinessActivityScheduler,BusinessServicesFaq};
use Auth,Str;
use Illuminate\Support\Facades\Session;
use DB;
use Redirect;
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
        // dd($companyInfo);
        $services = @$companyInfo->service->sortByDesc('created_at');
        $companyId = @$companyInfo->id;
        $companyName = @$companyInfo->dba_business_name;
        $displayModal  = '';
        if(session()->has('scheduleEdit')){
            $displayModal =  Session::get('scheduleEdit');
            Session::forget('scheduleEdit');
        }

        return view('business.services.index', compact('companyName','companyId', 'services','displayModal'));
        // return view('business.services.manage_services', compact('companyName','companyId', 'services','displayModal'));

    }

    public function FaqDestroy($bussinessid,$id)
    {
        $faq = BusinessServicesFaq::find($id);
        if ($faq) {
            $faq->delete();
            return response()->json(['success' => true, 'message' => 'FAQ deleted successfully.']);
        }        
        return response()->json(['success' => false, 'message' => 'FAQ not found.'], 404);
    }
    public function ServiceCreate(Request $request,$businessid,$serviceId)
    {
        // dd($id);
        // $companyInfo = $request->current_company;
        $data=CompanyInformation::find($businessid);
        $service = $data->service()->where(['id'=>$serviceId,'service_type'=>$request->serviceType])->first();
        $services=$data->service->sortByDesc('created_at');
        // $services = @$companyInfo->service->sortByDesc('created_at');
        $companyId = @$data->id;
        $companyName = @$data->dba_business_name;
        $displayModal  = '';
        $displayType = $request->displayType;
        // dd($displayType);
        if(session()->has('scheduleEdit')){
            $displayModal =  Session::get('scheduleEdit');
            Session::forget('scheduleEdit');
        }

        $service_data = BusinessServices::find($serviceId);
        if (!$service_data) {
            return redirect()->back()->with('error', 'Service not found.');
        }
        $sportsData = Sports::where('is_deleted','0')->where('parent_sport_id', '=', NULL)->orWhere('parent_sport_id', '=', "''")->orderBy('sport_name')->get();
        // dd($service);
        $serviceType=$service_data->service_type;
        $profile_pic = explode(',', @$service_data->profile_pic);
        $faqData = optional($service_data)->businessServicesFaq;
        $category = optional($service_data)->BusinessPriceDetailsAges();
        $faqData = optional($service_data)->businessServicesFaq;
        $displayRecCategory = $request->displayRecCategory;

        
        $displayRecPrice = $request->displayRecPrice;

        $categoryData = $category ?  $category->where('class_type', NULL)->get() : [];
        $classes = optional($service_data)->BusinessPriceDetailsAges() ? optional($service_data)->BusinessPriceDetailsAges()->where('class_type', $serviceType)->get() : [];        
        return view('business.services.manage_services', compact('companyName','service','classes','displayRecPrice','faqData','displayRecCategory','categoryData','companyId', 'services','displayModal','service_data','serviceId','serviceType','sportsData','profile_pic','displayType'));
        // return view('services.show', compact('service'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd('23');
        $fitnessity_fee = $recurring_fee = 0;
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

        $category = optional($service)->BusinessPriceDetailsAges();
        $faqData = optional($service)->businessServicesFaq;

        $categoryData = $category ?  $category->where('class_type', NULL)->get() : [];
        $classes = optional($service)->BusinessPriceDetailsAges() ? optional($service)->BusinessPriceDetailsAges()->where('class_type', $serviceType)->get() : [];

        $reqSafety = explode(',',@$service->req_safety);
        $proofVerification = empty($reqSafety) ? "" : (in_array("id_proof", $reqSafety) ? "checked" : "");
        $vaccinefVerification = empty($reqSafety) ? "" : (in_array("id_vaccine", $reqSafety) ? "checked" : "");
        $covidVerification = empty($reqSafety) ? "" : (in_array("id_covid", $reqSafety) ? "checked" : "");
        
        $profile_pic = explode(',', @$service->profile_pic);
        $staffData = BusinessStaff::where('business_id',$companyId)->get();
        $staffDataHTml = '<input type="hidden" name="instructure[0]" value=""><select name="instructure[0][]" id="instructure0" multiple>';
          foreach($staffData as $data){
               $selected ='';
               if(@$service->instructor_id == $data->id) {
                    $selected = "selected" ;
               }
               $staffDataHTml .= '<option value="'.$data->id.'" '.$selected.'>'.$data->first_name.' '.$data->last_name.'</option>';
          }
          $staffDataHTml .= '</select>';

        $sportsData = Sports::where('is_deleted','0')->where('parent_sport_id', '=', NULL)->orWhere('parent_sport_id', '=', "''")->orderBy('sport_name')->get();
        if($service == '' && $serviceId != 0){
            return redirect(route('business.services.create',["serviceType"=> $request->serviceType,'business_id'=>$companyId]));
        }

        $displayRecPrice = $request->displayRecPrice;
        $displayRecCategory = $request->displayRecCategory;
        $displayType = $request->displayType;
        // dd($categoryData);

        // dd($classes);
        return view('business.services.create', compact('serviceType','sportsData','staffData','service','profile_pic','companyId','serviceId','proofVerification','vaccinefVerification','covidVerification','fitnessity_fee','recurring_fee','categoryData','displayRecPrice','displayRecCategory','displayType','classes','faqData','staffDataHTml'));
    }


    // new 
    public function store(Request $request)
    {   
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
                $coverPhoto = $thisService->cover_photo;
            }

            if($request->has('imageBlobs')){
                //echo "hii";exit;
                for($i=0; $i< count($request->imageBlobs); $i++){
                    $base64File = $request->imageBlobs[$i];
                    $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));
                    $filename = 'activity/' . Str::uuid()->toString() . '.jpg';
                    Storage::disk('s3')->put($filename, $fileData);
                    $profilePicture .= $filename.',';
                }
            }

            if ($request->hasFile('coverUpload')) {
                $coverStore = $request->file('coverUpload')->store('activity');
                $coverPhoto = $coverStore;
            }

            $profilePicture= rtrim($profilePicture,',');
            $serviceData = [
                'cid' => $companyid,
                'userid' => $user->id,
                'serviceid' => $serviceId,
                'service_type' =>$request->serviceType,
                'cover_photo' => $coverPhoto,
                'profile_pic' => $profilePicture,
                'sport_activity' => $request->sports,
                'program_name' => $request->programName,
                'program_desc' => $request->programDesc,
                'know_before_you_go' => $request->thingsToKnow,
                'video' => $request->video,
            ];
        }

        if($request->step == '2'){
            $instant = $request->has('instantbooking') ? 1 : 0;
            $requestbooking = $request->has('requestbooking') ? 1 : 0;
            $serviceTypes =     $request->serviceTypes != ''  ? implode(',' , $request->serviceTypes) :  '';
            $serviceLocation = $request->serviceLocation != ''  ? implode(',' ,$request->serviceLocation ) :  '';
            $programFor = $request->programFor != ''  ? implode(',' , $request->programFor  ) :  '';
            $ageRange =  $request->ageRange != ''  ? implode(',' ,$request->ageRange ) :  '';
            $serviceFocus = $request->serviceFocus != ''  ? implode(',' , $request->serviceFocus ) :  '';
            $teachingStyle =   $request->teachingStyle != ''  ? implode(',' , $request->teachingStyle ) :  '';
            $difficultLevel =   $request->difficultLevel != ''  ? implode(',' , $request->difficultLevel ) :  '';
            $aftertime = $request->can_book_after_activity_starts == 'Yes' ? $request->aftertime: '';
            $aftertimeint = $request->can_book_after_activity_starts == 'Yes' ? $request->aftertimeint: 0;

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
                'beforetime' => $request->beforetime,
                'beforetimeint' => $request->beforetimeint,
                'can_book_after_activity_starts' => $request->can_book_after_activity_starts ?? 'No',
                'aftertime' => $aftertime,
                'aftertimeint' => $aftertimeint,
                'cancellation_policy' => $request->cancellation_policy,
            ];  
        }


        if($request->step == '3'){
            for ($i=0; $i <count($request->days_title) ; $i++) {   
                if($request->file('dayplanpic_'.$i)){
                    $dayImageStore = ($request->file('dayplanpic_'.$i))->store('activity/dayplan');
                    $dayImage .= $dayImageStore.',';
                    if($request->input('olddayplanpic_'.$i)){
                        Storage::delete($request->file('olddayplanpic_'.$i));
                    }  
                }else{
                    $dayImage .= $request->input('olddayplanpic_'.$i) ? $request->input('olddayplanpic_'.$i).',': ',';
                }
            } 

            $safe_varification .= $request->has('idProof') ? 'id_proof,': '';
            $safe_varification .= $request->has('idVaccine') ? 'id_vaccine,': '';
            $safe_varification .= $request->has('idCovid') ? 'id_covid,': '';

            $serviceData = [
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
                "exp_country" => @$request->country,
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

        }

        if ($request->step == '4') {
            $faqTitles = $request->faq_title ?? [];
            $faqCount = count($faqTitles);
        
            if ($faqCount > 0) {
                $idaryFaq = [];
                $idaryFaq1 = [];
        
                $idaryFaq = $thisService->businessServicesFaq()->pluck('id')->toArray();
        
                for ($i = 0; $i < $faqCount; $i++) {
                    $idaryFaq1[] = $request->faq_id_db[$i] ?? '';
        
                    $faqs = [
                        "faq_title" => $faqTitles[$i] ?? '',
                        "faq_answer" => $request->faq_answer[$i] ?? '',
                        "business_id" => $user->cid,
                        "user_id" => $user->id,
                        "service_id" => $serviceId,
                    ];
                    
                    BusinessServicesFaq::updateOrCreate(['id' => $request->faq_id_db[$i]], $faqs);
                }
        
                $differenceArrayFaq = array_diff($idaryFaq, $idaryFaq1);
                BusinessServicesFaq::whereIn('id', $differenceArrayFaq)->delete();
                return Redirect::route('business.show_service_details', ['id' => $serviceId])->with( ['serviceType' => $request->serviceType, 'serviceId' => $serviceId]);
            }
        }
        

        if($request->step != '5'){
            if($serviceId != 0){
                $service = $thisService->update($serviceData);
            }else{
                $service = BusinessServices::create($serviceData);
                $serviceId = $service->id;
            }
            return Redirect::route('business.show_service_details', ['id' => $serviceId])->with(['serviceType'=>$request->serviceType, 'serviceId'=> $serviceId]);
        }


        if($request->step == '5'){
            $catCount = count($request->category_title);
            if($catCount > 0) {
                $idary_cat = $idary_cat1 = $idary_price = $idary_price1 = $idary_addOn = $idary_addOn1 = array();

                $idary_cat= $user->BusinessPriceDetailsAges()->where(['cid'=> $companyid,'serviceid' => $serviceId])->whereNull('class_type')->pluck('id')->toArray();

                $idary_addOn = $user->AddOnService()->where(['cid'=> $companyid,'serviceid' => $serviceId])->pluck('id')->toArray();

                $idary_price = $user->BusinessPriceDetails()->where(['cid'=> $companyid,'serviceid' => $serviceId])->pluck('id')->toArray();

                // dd($cartcount);
                for($i=0; $i < $catCount; $i++) {
                    $idary_cat1[] =  $request->cat_id_db[$i] ?? '';
                    $businessages= [
                        "category_title" => $request->category_title[$i] ?? '',
                        "cid" => $user->cid,
                        "userid" =>  $user->id,
                        "serviceid" => $serviceId,
                        "visibility_to_public" => (!empty(@$request->visibility_to_public)) ? (in_array('V'.$i, @$request->visibility_to_public) ? 1 : 0) : 0,
                        "stype" => 1,
                    ];


                    $createOrUpdate = BusinessPriceDetailsAges::updateOrCreate(['id' => $request->cat_id_db[$i]], $businessages);

                    
                    $cat_new_id = $createOrUpdate->id; 
                    $priceCnt = $request->input('priceCount'.$i);
                    if($priceCnt >= 0){
                        for($y=0; $y <= $priceCnt; $y++) {
                            // dd($request->all());
                            $visibilityKey = 'visibility_to_public_price' . $i . $y;
                            $isVisible = $request->has($visibilityKey) ? 1 : 0;
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
                                "visibility_to_public" => $isVisible,
                                "is_recurring_adult"=>  (@$request->input('adult'.$i.$y) )?  $isRecurringAdult : 0,
                                "recurring_price_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'recurring_price_adult_', $i, $y) : '',
                                "recurring_run_auto_pay_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'run_auto_pay_adult_', $i, $y) : '',
                                "recurring_cust_be_charge_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'cust_be_charge_adult_', $i, $y) : '',
                                "recurring_every_time_num_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'every_time_num_adult_', $i, $y) : 0,
                                "recurring_every_time_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'every_time_adult_', $i, $y) : '',
                                "recurring_nuberofautopays_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'nuberofautopays_adult_', $i, $y) : 0,
                                "recurring_happens_aftr_12_pmt_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'happens_aftr_12_pmt_adult_', $i, $y) : '',
                                "recurring_client_be_charge_on_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'client_be_charge_on_adult_', $i, $y) : '',
                                "recurring_first_pmt_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'first_pmt_adult_', $i, $y) : '',
                                "recurring_recurring_pmt_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'recurring_pmt_adult_', $i, $y) : '',
                                "recurring_total_contract_revenue_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'total_contract_revenue_adult_', $i, $y) : '',

                                "recurring_customer_chage_by_adult" => (@$request->input('adult'.$i.$y)) ?  $this->getRecurringCustomerChargeBy($isRecurringAdult, $request, 'customer_charged_num_adult_', 'customer_charged_time_adult_', $i, $y) : '',


                               "is_recurring_child" =>  (@$request->input('child'.$i.$y)) ?  $isRecurringChild : 0,
                                "recurring_price_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'recurring_price_child_', $i, $y) : 0,
                                "recurring_run_auto_pay_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'run_auto_pay_child_', $i, $y) : 0,
                                "recurring_cust_be_charge_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'cust_be_charge_child_', $i, $y) : 0,
                                "recurring_every_time_num_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'every_time_num_child_', $i, $y) : 0,
                                "recurring_every_time_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'every_time_child_', $i, $y) : 0,
                                "recurring_nuberofautopays_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'nuberofautopays_child_', $i, $y) : 0,
                                "recurring_happens_aftr_12_pmt_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'happens_aftr_12_pmt_child_', $i, $y) : 0,
                                "recurring_client_be_charge_on_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'client_be_charge_on_child_', $i, $y) : 0,
                                "recurring_first_pmt_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'first_pmt_child_', $i, $y) : 0,
                                "recurring_recurring_pmt_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'recurring_pmt_child_', $i, $y) : 0,
                                "recurring_total_contract_revenue_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'total_contract_revenue_child_', $i, $y) : 0,
                                "recurring_customer_chage_by_child" => (@$request->input('child'.$i.$y)) ? $this->getRecurringCustomerChargeBy($isRecurringChild, $request, 'customer_charged_num_child_', 'customer_charged_time_child_', $i, $y) : 0,

                                "is_recurring_infant" => (@$request->input('infant'.$i.$y)) ?  $isRecurringInfant : 0,
                                "recurring_price_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'recurring_price_infant_', $i, $y) : '',
                                "recurring_run_auto_pay_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'run_auto_pay_infant_', $i, $y)  : '',
                                "recurring_cust_be_charge_infant" => (@$request->input('infant'.$i.$y)) ?   $this->getRecurringValue($isRecurringInfant, $request, 'cust_be_charge_infant_', $i, $y)  : '',
                                "recurring_every_time_num_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'every_time_num_infant_', $i, $y)  : 0,
                                "recurring_every_time_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'every_time_infant_', $i, $y)  : '',
                                "recurring_nuberofautopays_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'nuberofautopays_infant_', $i, $y)  : 0,
                                "recurring_happens_aftr_12_pmt_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'happens_aftr_12_pmt_infant_', $i, $y)  : '',
                                "recurring_client_be_charge_on_infant" => (@$request->input('infant'.$i.$y)) ?   $this->getRecurringValue($isRecurringInfant, $request, 'client_be_charge_on_infant_', $i, $y)  : '',
                                "recurring_first_pmt_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'first_pmt_infant_', $i, $y)  : '',
                                "recurring_recurring_pmt_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'recurring_pmt_infant_', $i, $y)  : '',
                                "recurring_total_contract_revenue_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'total_contract_revenue_infant_', $i, $y)  : '',
                                "recurring_customer_chage_by_infant" => (@$request->input('infant'.$i.$y)) ?  $this->getRecurringCustomerChargeBy($isRecurringInfant, $request, 'customer_charged_num_infant_', 'customer_charged_time_infant_', $i, $y)  : '',

                                "fitnessity_fee"=> $user->fitnessity_fee,
                                "pay_setnum" => $request->input('pay_setnum_'.$i.$y),
                                "pay_setduration" => $request->input('pay_setduration_'.$i.$y),
                                "pay_after" => $request->input('pay_after_'.$i.$y),
                                "pay_session_type" => $request->input('pay_session_type_'.$i.$y),
                                "membership_type" =>  $request->input('membership_type_'.$i.$y),
                                "pay_session" => $request->input('pay_session_'.$i.$y),
                                "price_title" => $request->input('price_title_'.$i.$y),

                                "adult_cus_weekly_price" =>  ($displaySection != 'freeprice' && @$request->input('adult'.$i.$y) ) ? $request->input('adult_cus_weekly_price_'.$i.$y) : '',
                                "adult_weekend_price_diff" =>  ($displaySection != 'freeprice' && @$request->input('adult'.$i.$y) ) ? $request->input('adult_weekend_price_diff_'.$i.$y) : '' ,
                                "adult_discount" => ($displaySection != 'freeprice' && @$request->input('adult'.$i.$y) ) ? $request->input('adult_discount_'.$i.$y) : '' ,

                                "child_cus_weekly_price" =>  ($displaySection != 'freeprice' && @$request->input('child'.$i.$y) ) ? $request->input('child_cus_weekly_price_'.$i.$y) : '',
                                "child_weekend_price_diff" =>  ($displaySection != 'freeprice' && @$request->input('child'.$i.$y) ) ? $request->input('child_weekend_price_diff_'.$i.$y) : '' ,
                                "child_discount" => ($displaySection != 'freeprice' && @$request->input('child'.$i.$y) ) ? $request->input('child_discount_'.$i.$y) : '' ,

                                 "infant_cus_weekly_price" =>  ($displaySection != 'freeprice' && @$request->input('infant'.$i.$y) ) ? $request->input('infant_cus_weekly_price_'.$i.$y) : '',
                                "infant_weekend_price_diff" =>  ($displaySection != 'freeprice' && @$request->input('infant'.$i.$y) ) ? $request->input('infant_weekend_price_diff_'.$i.$y) : '' ,
                                "infant_discount" => ($displaySection != 'freeprice' && @$request->input('infant'.$i.$y) ) ? $request->input('infant_discount_'.$i.$y) :'',
                            ];
                            
                            if($request->input('price_title_'.$i.$y) != ''){
                                $createOrUpdate = BusinessPriceDetails::updateOrCreate(['id' => $request->input('price_id_db_' . $i . $y)], $businessPrice);
                            }
                            
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

                if($differenceArray_price1!=='')
                {

                    $data= BusinessPriceDetails::whereIn('id',$differenceArray_price1)->get();
                    
                    if(!$data->isEmpty()) 

                    {
                        // dd($data);
                        $activity = BusinessActivityScheduler::where('serviceid', $request->serviceId)
                        ->whereIn('category_id', $request->cat_id_db)
                        ->whereNull('deleted_at')
                        ->whereIn('category_id', $data->category_id)
                        ->delete();                      
                    }
                }
                
                $activity = BusinessActivityScheduler::where('serviceid', $request->serviceId)
                ->whereIn('category_id', $request->cat_id_db)
                ->whereNull('deleted_at')
                ->whereIn('category_id', $differenceArray_cat1)
                ->delete();

            }

            $companyservice = $companyInfo->service->sortByDesc('created_at');
            $popupserviceid = '';
            $companyname = $companyInfo->name;
            // dd(\DB::getQueryLog()); 
            if($request->submitType == 'recurring'){
                return Redirect::route('business.show_service_details', ['id' => $serviceId])->with(['serviceType'=>$request->serviceType, 'serviceId'=> $serviceId ,'displayRecPrice' => $request->displayRecPrice ,'displayType' =>$request->displayType,'displayRecCategory' =>$request->displayRecCategory]);
            }else{
                return Redirect::route('business.show_service_details', ['id' => $serviceId])->with(['serviceType'=>$request->serviceType, 'serviceId'=> $serviceId ]);
            } 
        }   
    }

    public function storeClassPriceOptionupdate(Request $request ,$business_id){
        //    print_r($request->all());exit;
            // dd($request->all());
            // \DB::enableQueryLog(); // Enable query log
    
            $pIds = $request->input('priceId'.$request->classId);
            $pidArray = explode(',', $pIds);
            $oldPriceOptions = BusinessClassPriceDetails::where('class_id' , $request->classId)->pluck('id')->toArray();
      
            $pidArray = array_values(array_filter($pidArray));
            $ids = [];
            foreach ($pidArray as $pId) {
                $checkExis = BusinessClassPriceDetails::where(['price_id' =>$pId ,'class_id' => $request->classId])->first();
                if(!$checkExis){
                    $data = BusinessClassPriceDetails::create([
                        'user_id' => Auth::user()->id,
                        'business_id' => $business_id,
                        'service_id' => $request->serviceid,
                        'class_id' => $request->classId,
                        'price_id' => $pId,
                    ]);
    
                    $ids[] = $data->id;
                }else{
                    $ids[] = $checkExis->id;
                }
            }
            
            $serviceId=$request->serviceid;
            $diff = array_diff($oldPriceOptions,$ids);
            BusinessClassPriceDetails::whereIn('id',$diff)->delete();
            // dd(\DB::getQueryLog()); 
    
            // return Redirect::route('business.show_service_details', ['id' => $serviceId])->with( ['serviceType' => $request->serviceType, 'serviceId' => $serviceId]);
            return redirect()->to('business/'.$business_id.'./show_service_details/'.$serviceId.'?serviceType='.$request->serviceType.'&serviceId='.$request->serviceid.'#stepFour');
        }

    // end

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {   
    //     //ini_set('memory_limit', '-1');
    //     //print_r($request->all()); //exit();
    //     // dd($request->step); 
    //     // DB::enableQueryLog(); 
    //     $profilePicture = $dayImage = $safe_varification ="";

    //     $user = Auth::user();
    //     $companyInfo = $request->current_company;
    //     $companyid = $companyInfo->id;
    //     $serviceId = $request->serviceId ?? 0;
    //     $thisService = $companyInfo->service()->where('id', $serviceId)->first(); 

    //     if($request->step == '1'){
    //         if($thisService != ''  && $thisService->profile_pic != ''){
    //             $img = rtrim($thisService->profile_pic,',');
    //             $profilePicture .= $img.',';
    //             $coverPhoto = $thisService->cover_photo;
    //         }

    //         if($request->has('imageBlobs')){
    //             //echo "hii";exit;
    //             for($i=0; $i< count($request->imageBlobs); $i++){
    //                 $base64File = $request->imageBlobs[$i];
    //                 $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));
    //                 $filename = 'activity/' . Str::uuid()->toString() . '.jpg';
    //                 Storage::disk('s3')->put($filename, $fileData);
    //                 $profilePicture .= $filename.',';
    //             }
    //         }

    //         //print_r($profilePicture);exit;
    //         if ($request->hasFile('coverUpload')) {
    //             $coverStore = $request->file('coverUpload')->store('activity');
    //             $coverPhoto = $coverStore;
    //         }

    //         $profilePicture= rtrim($profilePicture,',');
    //         $serviceData = [
    //             'cid' => $companyid,
    //             'userid' => $user->id,
    //             'serviceid' => $serviceId,
    //             'service_type' =>$request->serviceType,
    //             'cover_photo' => $coverPhoto,
    //             'profile_pic' => $profilePicture,
    //             'sport_activity' => $request->sports,
    //             'program_name' => $request->programName,
    //             'program_desc' => $request->programDesc,
    //             'know_before_you_go' => $request->thingsToKnow,
    //             'video' => $request->video,
    //         ];
    //     }

    //     // dd(\DB::getQueryLog()); 
    //     if($request->step == '2'){
    //         $instant = $request->has('instantbooking') ? 1 : 0;
    //         $requestbooking = $request->has('requestbooking') ? 1 : 0;
    //         $serviceTypes =     $request->serviceTypes != ''  ? implode(',' , $request->serviceTypes) :  '';
    //         $serviceLocation = $request->serviceLocation != ''  ? implode(',' ,$request->serviceLocation ) :  '';
    //         $programFor = $request->programFor != ''  ? implode(',' , $request->programFor  ) :  '';
    //         $ageRange =  $request->ageRange != ''  ? implode(',' ,$request->ageRange ) :  '';
    //         $serviceFocus = $request->serviceFocus != ''  ? implode(',' , $request->serviceFocus ) :  '';
    //         $teachingStyle =   $request->teachingStyle != ''  ? implode(',' , $request->teachingStyle ) :  '';
    //         $difficultLevel =   $request->difficultLevel != ''  ? implode(',' , $request->difficultLevel ) :  '';
    //         $aftertime = $request->can_book_after_activity_starts == 'Yes' ? $request->aftertime: '';
    //         $aftertimeint = $request->can_book_after_activity_starts == 'Yes' ? $request->aftertimeint: 0;

    //         $serviceData = [
    //             'service_type' =>$request->serviceType,
    //             'serviceid' => $serviceId,
    //             "instant_booking" => $instant,
    //             "request_booking" => $requestbooking,
    //             'frm_min_participate' => $request->minParticipate,
    //             'cancelbeforeint' => $request->cancelBeforeInt,
    //             'cancelbefore' => $request->cancelBefore,
    //             'select_service_type' => $serviceTypes, 
    //             'activity_location' => $serviceLocation,
    //             'activity_for' => $programFor,
    //             'age_range' => $ageRange,
    //             'activity_experience' => $serviceFocus,
    //             'instructor_habit' => $teachingStyle,
    //             'difficult_level' => $difficultLevel,
    //             'beforetime' => $request->beforetime,
    //             'beforetimeint' => $request->beforetimeint,
    //             'can_book_after_activity_starts' => $request->can_book_after_activity_starts ?? 'No',
    //             'aftertime' => $aftertime,
    //             'aftertimeint' => $aftertimeint,
    //             'cancellation_policy' => $request->cancellation_policy,
    //         ];  
    //        /* print_r($serviceData);exit;*/
    //     }


    //     if($request->step == '3'){
    //         //print_r($request->all());exit;
    //         for ($i=0; $i <count($request->days_title) ; $i++) {   
    //             if($request->file('dayplanpic_'.$i)){
    //                 $dayImageStore = ($request->file('dayplanpic_'.$i))->store('activity/dayplan');
    //                 $dayImage .= $dayImageStore.',';
    //                 if($request->input('olddayplanpic_'.$i)){
    //                     Storage::delete($request->file('olddayplanpic_'.$i));
    //                 }  
    //             }else{
    //                 $dayImage .= $request->input('olddayplanpic_'.$i) ? $request->input('olddayplanpic_'.$i).',': ',';
    //             }
    //         } 

    //        // echo $dayImage;exit;
    //         $safe_varification .= $request->has('idProof') ? 'id_proof,': '';
    //         $safe_varification .= $request->has('idVaccine') ? 'id_vaccine,': '';
    //         $safe_varification .= $request->has('idCovid') ? 'id_covid,': '';

    //         $serviceData = [
    //             "exp_highlight" =>  $request->expHighlight,
    //             "included_items" =>  @implode(",",$request->includedThings),
    //             "notincluded_items" =>  @implode(",",$request->notIncludedThings),
    //             "bring_wear" =>  @implode(",",$request->wearThings),
    //             "accessibility" =>  $request->accessibility,
    //             "addi_info" =>  $request->additionalInfo,
    //             "days_plan_title" =>  $request->days_title != '' ? json_encode($request->days_title): '',
    //             "days_plan_desc" =>  $request->days_description != '' ? json_encode($request->days_description): '',
    //             "days_plan_img" =>  $dayImage,
    //             "desc_location" =>$request->descLocation,
    //             "exp_country" => @$request->country,
    //             "exp_address" => @$request->address,
    //             "exp_building" => @$request->addiAddress,
    //             "exp_city" => @$request->city,
    //             "exp_state" => @$request->state,
    //             "exp_zip" => @$request->zip,
    //             "exp_lat" => @$request->lat,
    //             "exp_lng" => @$request->lng,
    //             "addi_info_help" => @$request->addiInfoHelp,
    //             "req_safety" => $safe_varification,
    //         ];

    //         //print_r($serviceData);exit;
    //     }

    //     // if($request->step == '4'){
    //     //     $faqCount = count($request->faq_title);
    //     //     if($faqCount > 0) {
    //     //         $idaryFaq = $idaryFaq1 = array();
    //     //         $idaryFaq= $thisService->businessServicesFaq()->pluck('id')->toArray();
    //     //         for($i=0; $i < $faqCount; $i++) {
    //     //             $idaryFaq1[] =  $request->faq_id_db[$i] ?? '';

    //     //             $faqs = [
    //     //                 "faq_title" => $request->faq_title[$i] ?? '',
    //     //                 "faq_answer" => $request->faq_answer[$i] ?? '',
    //     //                 "business_id" => $user->cid,
    //     //                 "user_id" =>  $user->id,
    //     //                 "service_id" => $serviceId,
    //     //             ];
                    
    //     //             BusinessServicesFaq::updateOrCreate(['id' => $request->faq_id_db[$i]], $faqs);
    //     //         }

    //     //         $differenceArrayFaq = array_diff($idaryFaq, $idaryFaq1);
    //     //         BusinessServicesFaq::whereIn('id', $differenceArrayFaq)->delete();
    //     //         return redirect()->route('business.services.create',['serviceType'=>$request->serviceType, 'serviceId'=> $serviceId]);
    //     //     }
    //     // }
    //     if ($request->step == '4') {
    //         // Default to empty array if not set
    //         $faqTitles = $request->faq_title ?? [];
    //         $faqCount = count($faqTitles);
        
    //         if ($faqCount > 0) {
    //             $idaryFaq = [];
    //             $idaryFaq1 = [];
        
    //             $idaryFaq = $thisService->businessServicesFaq()->pluck('id')->toArray();
        
    //             for ($i = 0; $i < $faqCount; $i++) {
    //                 $idaryFaq1[] = $request->faq_id_db[$i] ?? '';
        
    //                 $faqs = [
    //                     "faq_title" => $faqTitles[$i] ?? '',
    //                     "faq_answer" => $request->faq_answer[$i] ?? '',
    //                     "business_id" => $user->cid,
    //                     "user_id" => $user->id,
    //                     "service_id" => $serviceId,
    //                 ];
                    
    //                 BusinessServicesFaq::updateOrCreate(['id' => $request->faq_id_db[$i]], $faqs);
    //             }
        
    //             $differenceArrayFaq = array_diff($idaryFaq, $idaryFaq1);
    //             BusinessServicesFaq::whereIn('id', $differenceArrayFaq)->delete();
        
    //             return redirect()->route('business.services.create', ['serviceType' => $request->serviceType, 'serviceId' => $serviceId]);
    //         }
    //     }
        

    //     if($request->step != '5'){
    //         // dd($serviceData);
    //         if($serviceId != 0){
    //            // print_r($serviceData);exit;
    //             $service = $thisService->update($serviceData);
    //         }else{
    //             $service = BusinessServices::create($serviceData);
    //             $serviceId = $service->id;
    //         }
    //         // dd(\DB::getQueryLog()); 
    //         return redirect()->route('business.services.create',['serviceType'=>$request->serviceType, 'serviceId'=> $serviceId]);
    //     }


    //     if($request->step == '5'){
    //         // dd($request->all());
    //         $catCount = count($request->category_title);
    //         if($catCount > 0) {
    //             $idary_cat = $idary_cat1 = $idary_price = $idary_price1 = $idary_addOn = $idary_addOn1 = array();

    //             $idary_cat= $user->BusinessPriceDetailsAges()->where(['cid'=> $companyid,'serviceid' => $serviceId])->whereNull('class_type')->pluck('id')->toArray();

    //             $idary_addOn = $user->AddOnService()->where(['cid'=> $companyid,'serviceid' => $serviceId])->pluck('id')->toArray();

    //             $idary_price = $user->BusinessPriceDetails()->where(['cid'=> $companyid,'serviceid' => $serviceId])->pluck('id')->toArray();

    //             // dd($cartcount);
    //             for($i=0; $i < $catCount; $i++) {
    //                 $idary_cat1[] =  $request->cat_id_db[$i] ?? '';
    //                 $businessages= [
    //                     "category_title" => $request->category_title[$i] ?? '',
    //                     "cid" => $user->cid,
    //                     "userid" =>  $user->id,
    //                     "serviceid" => $serviceId,
    //                    /* "dues_tax" => $request->dues_tax[$i] ?? '',
    //                     "sales_tax" => $request->sales_tax[$i] ?? '',*/
    //                     "visibility_to_public" => (!empty(@$request->visibility_to_public)) ? (in_array('V'.$i, @$request->visibility_to_public) ? 1 : 0) : 0,
    //                     "stype" => 1,
    //                 ];

    //                 // dd($up);

    //                 $createOrUpdate = BusinessPriceDetailsAges::updateOrCreate(['id' => $request->cat_id_db[$i]], $businessages);

                    
    //                 //print_r($createOrUpdate);
    //                 $cat_new_id = $createOrUpdate->id; 
    //                 $priceCnt = $request->input('priceCount'.$i);
    //                 // dd($priceCnt);
    //                 if($priceCnt >= 0){
    //                     for($y=0; $y <= $priceCnt; $y++) {
    //                         // dd($request->all());
    //                         $visibilityKey = 'visibility_to_public_price' . $i . $y;
    //                         $isVisible = $request->has($visibilityKey) ? 1 : 0;

    //                         // dd($request->visibility_to_public_price.$i.$y);
    //                         $idary_price1[] = $request->input('price_id_db_' . $i . $y) ?? '';
    //                         $isRecurringAdult = $request->input('is_recurring_adult_' . $i . $y);
    //                         $isRecurringChild = $request->input('is_recurring_child_' . $i . $y);
    //                         $isRecurringInfant = $request->input('is_recurring_infant_' . $i . $y);
    //                         $displaySection = $this->getDisplaySection($request, $i, $y);
                            
    //                         $businessPrice = [
    //                             "category_id" => $cat_new_id,
    //                             "dispaly_section" => $displaySection,
    //                             "business_service_id"=>$serviceId,
    //                             "cid" => $user->cid,
    //                             "userid" => $user->id,
    //                             "serviceid" => $serviceId,
    //                             "visibility_to_public" => $isVisible,
    //                             "is_recurring_adult"=>  (@$request->input('adult'.$i.$y) )?  $isRecurringAdult : 0,
    //                             "recurring_price_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'recurring_price_adult_', $i, $y) : '',
    //                             "recurring_run_auto_pay_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'run_auto_pay_adult_', $i, $y) : '',
    //                             "recurring_cust_be_charge_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'cust_be_charge_adult_', $i, $y) : '',
    //                             "recurring_every_time_num_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'every_time_num_adult_', $i, $y) : 0,
    //                             "recurring_every_time_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'every_time_adult_', $i, $y) : '',
    //                             "recurring_nuberofautopays_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'nuberofautopays_adult_', $i, $y) : 0,
    //                             "recurring_happens_aftr_12_pmt_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'happens_aftr_12_pmt_adult_', $i, $y) : '',
    //                             "recurring_client_be_charge_on_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'client_be_charge_on_adult_', $i, $y) : '',
    //                             "recurring_first_pmt_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'first_pmt_adult_', $i, $y) : '',
    //                             "recurring_recurring_pmt_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'recurring_pmt_adult_', $i, $y) : '',
    //                             "recurring_total_contract_revenue_adult" =>  (@$request->input('adult'.$i.$y)) ?  $this->getRecurringValue($isRecurringAdult, $request, 'total_contract_revenue_adult_', $i, $y) : '',

    //                             "recurring_customer_chage_by_adult" => (@$request->input('adult'.$i.$y)) ?  $this->getRecurringCustomerChargeBy($isRecurringAdult, $request, 'customer_charged_num_adult_', 'customer_charged_time_adult_', $i, $y) : '',


    //                            "is_recurring_child" =>  (@$request->input('child'.$i.$y)) ?  $isRecurringChild : 0,
    //                             "recurring_price_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'recurring_price_child_', $i, $y) : 0,
    //                             "recurring_run_auto_pay_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'run_auto_pay_child_', $i, $y) : 0,
    //                             "recurring_cust_be_charge_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'cust_be_charge_child_', $i, $y) : 0,
    //                             "recurring_every_time_num_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'every_time_num_child_', $i, $y) : 0,
    //                             "recurring_every_time_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'every_time_child_', $i, $y) : 0,
    //                             "recurring_nuberofautopays_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'nuberofautopays_child_', $i, $y) : 0,
    //                             "recurring_happens_aftr_12_pmt_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'happens_aftr_12_pmt_child_', $i, $y) : 0,
    //                             "recurring_client_be_charge_on_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'client_be_charge_on_child_', $i, $y) : 0,
    //                             "recurring_first_pmt_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'first_pmt_child_', $i, $y) : 0,
    //                             "recurring_recurring_pmt_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'recurring_pmt_child_', $i, $y) : 0,
    //                             "recurring_total_contract_revenue_child" =>  (@$request->input('child'.$i.$y)) ? $this->getRecurringValue($isRecurringChild, $request, 'total_contract_revenue_child_', $i, $y) : 0,
    //                             "recurring_customer_chage_by_child" => (@$request->input('child'.$i.$y)) ? $this->getRecurringCustomerChargeBy($isRecurringChild, $request, 'customer_charged_num_child_', 'customer_charged_time_child_', $i, $y) : 0,

    //                             "is_recurring_infant" => (@$request->input('infant'.$i.$y)) ?  $isRecurringInfant : 0,
    //                             "recurring_price_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'recurring_price_infant_', $i, $y) : '',
    //                             "recurring_run_auto_pay_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'run_auto_pay_infant_', $i, $y)  : '',
    //                             "recurring_cust_be_charge_infant" => (@$request->input('infant'.$i.$y)) ?   $this->getRecurringValue($isRecurringInfant, $request, 'cust_be_charge_infant_', $i, $y)  : '',
    //                             "recurring_every_time_num_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'every_time_num_infant_', $i, $y)  : 0,
    //                             "recurring_every_time_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'every_time_infant_', $i, $y)  : '',
    //                             "recurring_nuberofautopays_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'nuberofautopays_infant_', $i, $y)  : 0,
    //                             "recurring_happens_aftr_12_pmt_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'happens_aftr_12_pmt_infant_', $i, $y)  : '',
    //                             "recurring_client_be_charge_on_infant" => (@$request->input('infant'.$i.$y)) ?   $this->getRecurringValue($isRecurringInfant, $request, 'client_be_charge_on_infant_', $i, $y)  : '',
    //                             "recurring_first_pmt_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'first_pmt_infant_', $i, $y)  : '',
    //                             "recurring_recurring_pmt_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'recurring_pmt_infant_', $i, $y)  : '',
    //                             "recurring_total_contract_revenue_infant" =>  (@$request->input('infant'.$i.$y)) ?  $this->getRecurringValue($isRecurringInfant, $request, 'total_contract_revenue_infant_', $i, $y)  : '',
    //                             "recurring_customer_chage_by_infant" => (@$request->input('infant'.$i.$y)) ?  $this->getRecurringCustomerChargeBy($isRecurringInfant, $request, 'customer_charged_num_infant_', 'customer_charged_time_infant_', $i, $y)  : '',

    //                             "fitnessity_fee"=> $user->fitnessity_fee,
    //                             "pay_setnum" => $request->input('pay_setnum_'.$i.$y),
    //                             "pay_setduration" => $request->input('pay_setduration_'.$i.$y),
    //                             "pay_after" => $request->input('pay_after_'.$i.$y),
    //                             "pay_session_type" => $request->input('pay_session_type_'.$i.$y),
    //                             "membership_type" =>  $request->input('membership_type_'.$i.$y),
    //                             "pay_session" => $request->input('pay_session_'.$i.$y),
    //                             "price_title" => $request->input('price_title_'.$i.$y),

    //                             "adult_cus_weekly_price" =>  ($displaySection != 'freeprice' && @$request->input('adult'.$i.$y) ) ? $request->input('adult_cus_weekly_price_'.$i.$y) : '',
    //                             "adult_weekend_price_diff" =>  ($displaySection != 'freeprice' && @$request->input('adult'.$i.$y) ) ? $request->input('adult_weekend_price_diff_'.$i.$y) : '' ,
    //                             "adult_discount" => ($displaySection != 'freeprice' && @$request->input('adult'.$i.$y) ) ? $request->input('adult_discount_'.$i.$y) : '' ,

    //                             "child_cus_weekly_price" =>  ($displaySection != 'freeprice' && @$request->input('child'.$i.$y) ) ? $request->input('child_cus_weekly_price_'.$i.$y) : '',
    //                             "child_weekend_price_diff" =>  ($displaySection != 'freeprice' && @$request->input('child'.$i.$y) ) ? $request->input('child_weekend_price_diff_'.$i.$y) : '' ,
    //                             "child_discount" => ($displaySection != 'freeprice' && @$request->input('child'.$i.$y) ) ? $request->input('child_discount_'.$i.$y) : '' ,

    //                              "infant_cus_weekly_price" =>  ($displaySection != 'freeprice' && @$request->input('infant'.$i.$y) ) ? $request->input('infant_cus_weekly_price_'.$i.$y) : '',
    //                             "infant_weekend_price_diff" =>  ($displaySection != 'freeprice' && @$request->input('infant'.$i.$y) ) ? $request->input('infant_weekend_price_diff_'.$i.$y) : '' ,
    //                             "infant_discount" => ($displaySection != 'freeprice' && @$request->input('infant'.$i.$y) ) ? $request->input('infant_discount_'.$i.$y) :'',
    //                         ];
                            
    //                         // print_r($businessPrice);
    //                         if($request->input('price_title_'.$i.$y) != ''){
    //                             $createOrUpdate = BusinessPriceDetails::updateOrCreate(['id' => $request->input('price_id_db_' . $i . $y)], $businessPrice);
    //                         }
                            
    //                     }
    //                 }
    //                 // dd($businessPrice);
    //                 $addOnCnt = $request->input('addOnServiceCount'.$i);
    //                 if($addOnCnt >= 0){
    //                     for($z=0; $z <= $addOnCnt; $z++) {
    //                         if($request->input('service_name_'.$i.$z) != ''){
    //                             $idary_addOn1[] = $request->input('add_on_service_id_db_'.$i.$z)  ?? '' ;
    //                             $businessAddOnService = [
    //                                 "category_id" => $cat_new_id,
    //                                 "serviceid" => $serviceId,
    //                                 "cid" => $user->cid,
    //                                 "user_id" => $user->id,
    //                                 "service_name"=>$request->input('service_name_'.$i.$z)  ?? NULL,
    //                                 "service_price" =>  $request->input('service_price_'.$i.$z) ?? 0,
    //                                 "service_description" => $request->input('service_description_'.$i.$z) ?? NULL,
    //                             ];

    //                             $createOrUpdate = AddOnService::updateOrCreate(['id' => $request->input('add_on_service_id_db_' . $i . $z)], $businessAddOnService);
    //                         }
    //                     }
    //                 }
    //             }
             
    //             $differenceArray_cat1 = array_diff($idary_cat, $idary_cat1);
    //             BusinessPriceDetailsAges::whereIn('id', $differenceArray_cat1)->delete();
                
    //             $differenceArray_price1 = array_diff($idary_price, $idary_price1);
    //             BusinessPriceDetails::whereIn('id',$differenceArray_price1)->delete();

    //             $differenceArray_AOS1 = array_diff($idary_addOn, $idary_addOn1);
    //             AddOnService::whereIn('id',$differenceArray_AOS1)->delete();

    //             if($differenceArray_price1!=='')
    //             {

    //                 $data= BusinessPriceDetails::whereIn('id',$differenceArray_price1)->get();
                    
    //                 if(!$data->isEmpty()) 

    //                 {
    //                     // dd($data);
    //                     $activity = BusinessActivityScheduler::where('serviceid', $request->serviceId)
    //                     ->whereIn('category_id', $request->cat_id_db)
    //                     ->whereNull('deleted_at')
    //                     ->whereIn('category_id', $data->category_id)
    //                     ->delete();                      
    //                 }
    //             }
                
    //             $activity = BusinessActivityScheduler::where('serviceid', $request->serviceId)
    //             ->whereIn('category_id', $request->cat_id_db)
    //             ->whereNull('deleted_at')
    //             ->whereIn('category_id', $differenceArray_cat1)
    //             ->delete();

    //         }

    //         $companyservice = $companyInfo->service->sortByDesc('created_at');
    //         $popupserviceid = '';
    //         $companyname = $companyInfo->name;
    //         // dd(\DB::getQueryLog()); 

    //         if($request->submitType == 'recurring'){
    //             return redirect()->route('business.services.create',['serviceType'=>$request->serviceType, 'serviceId'=> $serviceId ,'displayRecPrice' => $request->displayRecPrice ,'displayType' =>$request->displayType,'displayRecCategory' =>$request->displayRecCategory]);
    //         }else{
    //            return redirect()->route('business.services.create',['serviceType'=>$request->serviceType, 'serviceId'=> $serviceId ]);
    //         } 
    //     }   
    // }

    function getRecurringValue($isRecurring, $request, $fieldPrefix, $i, $y)
    {
        if ($isRecurring == 1) {
            return $request->input($fieldPrefix . $i . $y);
        }
        return NULL;
    }

    function getRecurringCustomerChargeBy($isRecurring, $request, $numFieldPrefix, $timeFieldPrefix, $i, $y)
    {
        if ($isRecurring == 1) {
            $numValue = $request->input($numFieldPrefix . $i . $y);
            $timeValue = $request->input($timeFieldPrefix . $i . $y);
            return $numValue . ' ' . $timeValue;
        }

        return NULL;
    }

    function getSectionValue($request, $i, $y, $section, $fieldPrefix,$displaySection)
    {   
        if($displaySection != 'freeprice') {
            if ($request->input($section . $i . $y) == $section) {
                return $request->input($fieldPrefix . $i . $y);
            }
            return '';
        }
        return '';
    }

    function getDisplaySection($request, $i, $y)
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
    public function destroy(Request $request,$business_id , $id)
    {
        // dd('33');
        $company = $request->current_company;
        $business_service = $company->service()->findOrFail($id);        
        $business_service->delete();
        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully'
        ]);
    }

    public function select(Request $request, $business_id){
        // dd('4');
        $company = $request->current_company;
        $companyService = $company->service()->orderBy('id', 'DESC')->get();
        return view('business.services.select',compact('business_id','companyService'));
    }

    public function destroyimage(Request $request){
        $company = $request->current_company;
        $service = $company->service()->findOrFail($request->serviceid);

        if($request->imagtype){
            $updateval = $service->update(['cover_photo' => '']);
        }else{
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
        }
        
        if($updateval == true){
            return "success";
        }else{
            return "fail";
        }
    }

    public function storeClass(Request $request){

        // dd('33');
        $validatedData = $request->validate([
            'category_title' => 'required|string|max:255',
        ]);

        BusinessPriceDetailsAges::create([
            "category_title" => $request->category_title ,
            // "desc" => $request->desc,
            "cid" => $request->cid,
            "userid" =>  Auth::user()->id,
            "serviceid" => $request->serviceid,
            "class_type" => $request->serviceType,
            "stype"=>'1',
        ]);

        return redirect()->to('business/'.$request->cid.'/services/create?serviceType='.$request->serviceType.'&serviceId='.$request->serviceid.'#stepFour');
    }

    public function editClass($business_id,$id){
        $class = BusinessPriceDetailsAges::find($id);
        // dd($class);
        return view('business.services.edit_class',compact('class'));
    }

    public function updateClass(Request $request){
        
        $validatedData = $request->validate([
            'category_title' => 'required|string|max:255',
        ]);

        $class = BusinessPriceDetailsAges::find($request->id);
        // dd($class);
        $class->update([
            'category_title'=> $request->category_title ,
            'desc'=>$request->desc ,
            'stype'=>1,
        ]);
        
        return redirect()->to('business/'.$request->cid.'/services/create?serviceType='.$request->serviceType.'&serviceId='.$request->serviceid.'#stepFour');
    }


    public function deleteClass($business_id,$id){
        $class = BusinessPriceDetailsAges::find($id);
        if($class){
            $class->delete();
        }
    }

    public function storeClassPriceOption(Request $request ,$business_id){
    //    print_r($request->all());exit;
        // dd($request->all());
        // \DB::enableQueryLog(); // Enable query log

        $pIds = $request->input('priceId'.$request->classId);
        $pidArray = explode(',', $pIds);
        $oldPriceOptions = BusinessClassPriceDetails::where('class_id' , $request->classId)->pluck('id')->toArray();
  
        $pidArray = array_values(array_filter($pidArray));
        $ids = [];
        foreach ($pidArray as $pId) {
            $checkExis = BusinessClassPriceDetails::where(['price_id' =>$pId ,'class_id' => $request->classId])->first();
            if(!$checkExis){
                $data = BusinessClassPriceDetails::create([
                    'user_id' => Auth::user()->id,
                    'business_id' => $business_id,
                    'service_id' => $request->serviceid,
                    'class_id' => $request->classId,
                    'price_id' => $pId,
                ]);

                $ids[] = $data->id;
            }else{
                $ids[] = $checkExis->id;
            }
        }

        $diff = array_diff($oldPriceOptions,$ids);
        BusinessClassPriceDetails::whereIn('id',$diff)->delete();
        // dd(\DB::getQueryLog()); 


        return redirect()->to('business/'.$business_id.'/services/create?serviceType='.$request->serviceType.'&serviceId='.$request->serviceid.'#stepFour');
    }

    public function getSchedule($business_id, Request $request){
        $businessActivity = BusinessActivityScheduler::where('cid', $business_id)->where('category_id',$request->id)->whereNull('deleted_at')->get();    
        return view('business.services.schedule_break_down_model', compact('businessActivity'));
    }

    public function getScheduleData($business_id, Request $request){
        $category = BusinessPriceDetailsAges::find($request->catId);
        $staffData = BusinessStaff::where('business_id',$business_id)->get();
        $staffDataHTml = '<input type="hidden" name="instructure[0]" value=""><select name="instructure[0][]" id="instructure0" multiple>';
        foreach($staffData as $data){
            $selected ='';
            if(@$service->instructor_id == $data->id) {
                $selected = "selected" ;
            }
            $staffDataHTml .= '<option value="'.$data->id.'" '.$selected.'>'.$data->first_name.' '.$data->last_name.'</option>';
        }

        $staffDataHTml .= '</select>';
        $businessActivity = $category->BusinessActivityScheduler;
        return view('business.services.schedule_section', ['staffData' => $staffData, 'staffDataHTml' => $staffDataHTml,'loop' => $request->loop,'category'=>$category,'businessActivity'=>$businessActivity,'returnUrl'=>$request->returnUrl]);
    }
}
