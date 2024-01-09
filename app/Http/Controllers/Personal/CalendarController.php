<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Redirect,Storage,Hash,Response,DB;
use App\{User,CompanyInformation,Customer,UserBookingStatus,BusinessServices,BusinessStaff};

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $familyDetails = $companies = [];
         $ids = [];
        if($request->customer_id){
            if(request()->type == 'user'){
                $familyMember = Auth::user()->user_family_details()->where('id',$request->customer_id)->first();
                $customer = Customer::where(['fname' => $familyMember->first_name,'lname' => $familyMember->last_name,'email' => $familyMember->email]);
            }else{
                $customer = Customer::where('id', $request->customer_id);
            }

            $ids = $request->business_id ? $customer->where('business_id' ,$request->business_id)->pluck('id')->toArray() : $customer->pluck('id')->toArray();
        }else{
            $user = Auth::user();
            $customer = $user->customers;
            foreach($customer as $cs){
                $companies[] = $cs->company_information;
            }
                
            $customer =  $request->business_id ? $customer->where('business_id' ,$request->business_id) : $customer;     

            foreach($customer as $cs){
                $ids [] =  $cs->id;
                $familyDetails [] = $cs;
                foreach ($cs->get_families() as $fm){
                    $familyDetails [] = $fm;
                    $ids [] =  $fm->id;
                } 
            }
        }

       
        $data = UserBookingStatus::selectRaw('chkdetails.id, ser.program_name as title, ser_sche.shift_start, ser_sche.shift_end, ser_sche.set_duration,chkdetails.checkin_date as start,bdetails.user_id')
                ->join("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                ->join("booking_checkin_details as chkdetails", DB::raw('chkdetails.booking_detail_id'), '=', 'bdetails.id')
                ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                ->join("business_activity_scheduler as ser_sche", DB::raw('ser_sche.id'), '=', 'bdetails.act_schedule_id')
                ->whereIn('bdetails.user_id', $ids)
                ->get();
       
       /* echo "<pre>";print_r($data);exit;*/
        $fullary= $dataAry = $ajaxArray = [];
        foreach($data as $dt){
            $full_name = "N/A";
            if(@$dt->user_id != ''){
                $customerdata = Customer::where('id',$dt->user_id)->first();
                $full_name = ucwords(@$customerdata->full_name) ?? "N/A";
            }

            $time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
            if(@$dt->set_duration != ''){
                $tm = explode(' ',$dt->set_duration);
                $hr=''; $min=''; $sec='';
                $hr = $tm[0] != 0 ? $tm[0].' hr ' : '';
                $min = $tm[2] != 0 ? $tm[2].' min ' : '';
                $sec = $tm[4] != 0 ? $tm[4].' sec ' : '';
                $time =  $hr.$min.$sec; 
            }
           
            $fullary[] =array(
                "id"=> $dt['id'],
                "title"=>$dt['title'],
                "shift_start"=>$dt['shift_start'],
                "shift_end"=>$dt['shift_end'],
                "time"=>$time,
                "start"=>$dt['start'].'T'.date("h:i:s", strtotime( $dt["shift_start"]) ),
                "end"=>$dt['start'].'T'.date("h:i:s", strtotime( $dt["shift_end"]) ),
                "full_name"=>$full_name);

            $dataAry [] =array(
                'allDay'  =>'false',
                'id'  => $dt['id'],
                'title'  => $dt['title']. ' \n '.date("h:i a", strtotime( $dt["shift_start"] )).' - '.$time . ' \n '.$full_name,  
                'description' => $dt['title']. ' <br> '.date("h:i a", strtotime($dt["shift_start"])).' - '.$time . ' <br> '.$full_name,  
                'start'  => $dt['start'].'T'.date("h:i", strtotime( $dt["shift_start"]) ),
                'end'  => $dt["start"].'T'.date("h:i", strtotime( $dt["shift_end"]) ),
            );
        }

        if($request->ajax()){
            $fDetails = '<option value="all"> ALL</option>';
            foreach($familyDetails as $fm){
                $fDetails .= '<option value="'.$fm->id.'"> '.$fm->full_name.'</option>';
            }
            
            if($request->type){
                $ajaxArray = $dataAry;
            }else{
                $ajaxArray = array(
                    'events' => $dataAry,
                    'familyDetails' => $fDetails,
                );
            }
            

            return response()->json($ajaxArray);
        }

        return view('personal.calendar.index', compact('fullary','familyDetails','companies') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Responsall();exit;
     */
    public function store(Request $request)
    {   
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
    {   //print_r($request->all());exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
