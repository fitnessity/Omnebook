<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\{CompanyInformation,BusinessExperience,BusinessTerms,BusinessService};
use Auth;
use Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = CompanyInformation::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('personal.company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $companyId = $request->company;
        $company = CompanyInformation::where('id',@$companyId)->first();
        $experience = BusinessExperience::where('cid',@$companyId)->first();
        $service = BusinessService::where('cid',@$companyId)->first();
        $terms = BusinessTerms::where('cid',@$companyId)->first();
        return view('personal.company.create',compact('company','experience','service','terms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Responsall();exit;
     */
    public function store(Request $request)
    {   
        //print_r($request->all()); exit;

        $companyId = $request->cid != '' &&  $request->cid != '0' ? $request->cid : '';
        if($request->step == 1){
            $companyImage = $request->has('profilePic') ? $request->file('profilePic')->store('company') : $request->oldProfile; 
            if($request->has('profilePic') && $request->oldProfile != ''){
                Storage::delete($request->oldProfile);
            }

            $company = [
                "user_id" => Auth::user()->id,
                "first_name" => $request->firstName,
                "last_name" => $request->lastName,
                "email" => $request->email,
                "contact_number" => $request->contact,
                "logo" => $companyImage,
                "company_name" => $request->companyName,
                "address" => $request->address,
                "state" => $request->state,
                "country" => $request->country,
                "zip_code" => $request->zipCode,
                "city" => $request->city,
                "business_user_tag" => $request->businessUserName,
                "about_company" => $request->aboutCompany,
                "short_description" => $request->shortDescription,
                "embed_video" => $request->embedVideo,
                "latitude" => $request->lat,
                "longitude" => $request->lon,
                'dba_business_name' => $request->dbaBusinessName,
                'additional_address' => $request->additionalAddress,
                'neighborhood' => $request->neighborhood,
                'business_phone' => $request->businessPhone,
                'business_email' => $request->businessEmail,
                'business_website' => $request->website,
                'business_type' => $request->businessType,
            ];

            if($companyId != ''){
                $companyDetail = CompanyInformation::where('id',$companyId)->update($company);
            }else{
                $companyDetail  =  CompanyInformation::create($company);
                Auth::user()->update(['cid'=>$companyDetail->id]);
                $companyId = $companyDetail->id;
            }
            
        }else if($request->step == 2){
            $frm_organisation = $frm_posi = $frm_servi_start = $frm_service_end = $frm_ispresent = $frm_course = array();
            for($i=0; $i < count($request->frm_organisationname);$i++){
                $frm_organisation[] = @$request->frm_organisationname[$i];
                $frm_posi[] = @$request->frm_position[$i];
                $frm_servi_start[] = @$request->frm_servicestart[$i];
                $frm_service_end[] = @$request->frm_serviceend[$i];
                $frm_ispresent[] = @$request->frm_ispresent[$i];
            }

            for($i=0;$i < count($request->frm_course);$i++){
                $frm_course[] = @$request->frm_course[$i];
                $frm_university[] = @$request->frm_university[$i];
                $frm_passingyear[] = @$request->frm_passingyear[$i];
            }

            for($i=0;$i < count($request->certification);$i++){
                $certification[] = @$request->certification[$i];
                $frm_passingdate[] = @$request->frm_passingdate[$i];
            }

            for($i=0;$i < count($request->skill_type);$i++){
                $skill_type[] = $request->skill_type[$i];
                $skillcompletion[] = @$request->skillcompletion[$i];
                $frm_skilldetail[] = @$request->frm_skilldetail[$i];
            }

            
            $skill_type = json_encode($skill_type,true);
            $skillcompletion = json_encode($skillcompletion,true);
            $frm_skilldetail = json_encode($frm_skilldetail,true);

            $certification = json_encode($certification,true);
            $frm_passingdate = json_encode($frm_passingdate,true);

            $frm_course = json_encode($frm_course,true);
            $frm_university = json_encode($frm_university,true);
            $frm_passingyear = json_encode($frm_passingyear,true);

            $frm_organisationname = json_encode($frm_organisation,true);
            $frm_position = json_encode($frm_posi,true);
            $frm_servicestart = json_encode($frm_servi_start,true);
            $frm_serviceend = json_encode($frm_service_end,true);
            $frm_ispresentcheck = json_encode($frm_ispresent,true);
         
            $stillwork= $request->frm_ispresentcheck=='on' ? 1: 0;
    
            $experience = [
                "cid" => $request->cid,
                "userid" => Auth::user()->id,
                "frm_organisationname" => $frm_organisationname,
                "frm_position" => $frm_position,
                "frm_ispresentcheck" => $frm_ispresentcheck,
                "frm_servicestart" => $frm_servicestart,
                "frm_serviceend" => $frm_serviceend,
                "frm_course" => $frm_course,
                "frm_university" => $frm_university,
                "frm_passingyear" => $frm_passingyear,
                "certification" => $certification,
                "frm_passingdate" => $frm_passingdate,
                "skill_type" => $skill_type,
                "skillcompletion" => $skillcompletion,
                "frm_skilldetail" => $frm_skilldetail,
            ];

            if($request->has('id')){
                BusinessExperience::where('id' , $request->id)->update($experience);
            }else{
                BusinessExperience::create($experience);
            }
        }else if($request->step == 3){
            $service = [
              'cid' => $companyId,
              'userid'=>Auth::user()->id, 
              'languages'=> isset($request->languages) ? @implode(",",$request->languages) : '', 
              'hours_opt'=>$request->hours_opt,
              'mon_shift_start'=>$request->mon_shift_start,
              'mon_shift_end'=>$request->mon_shift_end,  
              'tue_shift_start'=>$request->tue_shift_start,
              'tue_shift_end'=>$request->tue_shift_end,  
              'wed_shift_start'=>$request->wed_shift_start,
              'wed_shift_end'=>$request->wed_shift_end,
              'thu_shift_start'=>$request->thu_shift_start,
              'thu_shift_end'=>$request->thu_shift_end,
              'fri_shift_start'=>$request->fri_shift_start,
              'fri_shift_end'=>$request->fri_shift_end,
              'sat_shift_start'=>$request->sat_shift_start,
              'sat_shift_end'=>$request->sat_shift_end,
              'sun_shift_start'=>$request->sun_shift_start,
              'sun_shift_end'=>$request->sun_shift_end,
              'serTimeZone'=>$request->serTimeZone,
              'special_days_off'=> $request->daysOff,
              'serBusinessoff1'=> isset($request->offers) ? @implode(",",$request->offers):''
            ];

            //print_r($service);exit;
            if($request->has('id')){
                BusinessService::where('id' , $request->id)->update($service);
            }else{
                BusinessService::create($service);
            }
        }else if($request->step == 4){

            $termcondfaq = $request->has('termcondfaq') ? 1 : 0 ;
            $termcondfaqtext = $request->has('termcondfaq') ? $request->termcondfaqtext : '' ; 

            $contractterms = $request->has('contractterms') ? 1 : 0 ;
            $contracttermstext = $request->has('contractterms') ? $request->contracttermstext : '' ;

            $refundpolicy = $request->has('refundpolicy') ? 1 : 0 ;
            $refundpolicytext = $request->has('refundpolicy') ? $request->refundpolicytext : '' ;

            $liability = $request->has('liability') ? 1 : 0 ;
            $liabilitytext = $request->has('liability') ? $request->liabilitytext : '' ;
            
            $covid = $request->has('covid') ? 1 : 0 ;
            $covidtext = $request->has('covid') ? $request->covidtext : '' ;
           
            $terms = [
                "cid" => $companyId,
                "userid" => Auth::user()->id,
                "houserules" => $request->houserules,
                "cancelation" => $request->cancelation,
                "cleaning" => $request->cleaning,
                "termcondfaq" => $termcondfaq,
                "termcondfaqtext" => $termcondfaqtext,
                "contractterms" => $contractterms,
                "contracttermstext" => $contracttermstext,
                "liability" => $liability,
                "liabilitytext" => $liabilitytext,
                "covid" => $covid,
                "covidtext" => $covidtext,
                "refundpolicy" => $refundpolicy,
                "refundpolicytext" => $refundpolicytext
            ];

            if(@$request->id != ''){
                BusinessTerms::where('id' , $request->id)->update($terms);
            }else{
               BusinessTerms::create($terms);
            }
        }   


        if($request->step != 4){
            return redirect()->route('personal.company.create',['company'=> $companyId]);
        }else{
            return redirect()->route('personal.company.index');
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
    public function edit($id)
    {
        //
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
        $company = Auth::user()->company()->findOrFail($id);
        $company->service()->each(function($service) {
            $service->delete();
        });
        $company->delete();
    }
}
