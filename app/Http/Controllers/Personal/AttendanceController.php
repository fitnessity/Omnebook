<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Redirect,Storage,Hash,Response,Carbon\Carbon;;
use App\{BookingCheckinDetails,UserBookingDetail,Customer};


class AttendanceController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
        $this->currentYear = Carbon::now()->year;
        $this->startMonth = Carbon::create($this->currentYear, 1, 1)->startOfMonth();
        $this->endMonth = Carbon::create($this->currentYear, 12, 31)->startOfMonth();

    }

    public function index(Request $request)
    {
        $months = $year= $category = $dataCount = [];
        $totalYears = $totalMonths = $totalDays = $totalHours = $totalMinutes = 0;

        if($request->customer_id){
            if($request->type == 'user'){
                $familyMember = Auth::user()->user_family_details()->where('id',$request->customer_id)->first();
                $customer = Customer::where(['fname' => $familyMember->first_name,'lname' => $familyMember->last_name,'email' => $familyMember->email,])->first();
            }else{
                $customer = Customer::find($request->customer_id);
            }
            
            $id = @$customer->id;
        }else{
            $customer = Auth::user()->customers()->where('business_id',$request->business_id)->first();
            $id = @$customer->id;
        }

        $date = explode(' to ', @$request->dates);

        $stDateCal =  @$date[0] != '' ?  Carbon::create($date[0]):  $this->startMonth;
        $endateCal = array_key_exists(1,$date) ? Carbon::create($date[1]) : $this->endMonth;
       
        if($stDateCal == $this->startMonth && $endateCal == $this->endMonth){
            $cDate = $this->startMonth->copy();
            while ($cDate->lte($this->endMonth)) {
                $dataCount[] = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereYear('checked_at',$cDate->year)->whereMonth('checked_at' , $cDate->month)->count();
                $cDate->addMonth();
            }
            $category = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        }else{
            $loopDate = Carbon::parse($stDateCal)->copy();
            $daysDifference = Carbon::parse($endateCal)->diffInDays($loopDate);
            if($daysDifference < 32){
                while($loopDate->lte($endateCal)) {
                    $category[] = $loopDate->format('m/d/Y');
                    $dataCount[] = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereDate('checked_at',$loopDate->format('Y-m-d'))->count();
                    $loopDate->addDay();
                } 
            }else{
                while($loopDate->lte($endateCal)) {
                    if(!in_array($loopDate->month ,$months)){
                        $category [] = $loopDate->format('M');
                        $months[]= $loopDate->month;
                        $year[]= $loopDate->year;
                    }
                    $loopDate->addDay();
                }
                
                for ($i=0; $i < count($months); $i++) { 
                    $dataCount[] = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereYear('checked_at',$year[$i])->whereMonth('checked_at' , $months[$i])->count();
                }
            }
        }

        $category = array_values(array_unique($category));
        $graphData = json_encode($dataCount);
        $categoryData = json_encode($category);
        
        $attendanceCnt = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereYear('checkin_date', '>=', $stDateCal->format('Y'))->whereMonth('checkin_date', '<=', $stDateCal->format('m'))->whereDate('checkin_date', '>=', $stDateCal)->whereDate('checkin_date', '<=', $endateCal)->whereNotNull('checked_at')->count();
        
        $bookingDetails = UserBookingDetail::where('user_id',@$customer->id )->whereDate('expired_at', '>', $stDateCal)->whereDate('expired_at', '<', $endateCal)->pluck('contract_date')->toArray();
  
        $currentDate = Carbon::now();
        foreach ($bookingDetails as $date) {
            $carbonDate = Carbon::parse($date);
            $totalMinutes += $carbonDate->diffInMinutes($currentDate);
        }

        $totalYears = floor($totalMinutes / (365 * 24 * 60));
        $remainingMinutes = $totalMinutes % (365 * 24 * 60);

        $totalMonths = floor($remainingMinutes / (30 * 24 * 60));
        $remainingMinutes %= (30 * 24 * 60);

        $totalDays = floor($remainingMinutes / (24 * 60));
        $remainingMinutes %= (24 * 60);

        $totalHours = floor($remainingMinutes / 60);
        $remainingMinutes %= 60;

        $totalMinutes = $remainingMinutes;
       
        
        return view('personal.attendance_belt.index',compact('id','attendanceCnt','totalYears','totalMonths','totalDays','totalHours','totalMinutes','graphData','categoryData','stDateCal','endateCal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $categoryData = $graphData= []; $dataCount = '';

        $currentDate = Carbon::now();
        if($request->type == 'day'){
            $graphData = BookingCheckinDetails::where('customer_id' ,$request->id)->whereDate('checked_at',date('Y-m-d'))->count() ;
            $category = [  date('m/d/Y')];
            $graphData = [ $graphData]; 
        }else if($request->type == 'week'){
            $currentDate = Carbon::now();
            $currentDay = $currentDate->dayOfWeek;
            $startDate = $currentDate->copy()->subDays($currentDay);
            $endDate = $currentDate->copy()->addDays(6 - $currentDay);
            $loopDate = $startDate->copy();
            while ($loopDate->lte($endDate)) {
                $graphData[] = BookingCheckinDetails::where('customer_id' ,$request->id)->whereDate('checked_at',$loopDate->toDateString())->count() ;
                $loopDate->addDay();
            }
            $category = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        }else if($request->type == 'year'){
            $startDate = $this->startMonth->copy();
            $endDate = $this->endMonth->copy();
            $loopDate = $startDate->copy();
            while ($startDate->lte($endDate)) {
                $graphData[] = BookingCheckinDetails::where('customer_id' ,$request->id)->whereDate('checked_at','>=',$startDate->format('Y-m-d'))->whereDate('checked_at' , '<=',$endDate->format('Y-m-d'))->count();
                $startDate->addMonth();
            }
            $category = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        }else {
            $startDate = $currentDate->copy()->startOfMonth();
            $endDate = $currentDate->copy()->endOfMonth();
            $loopDate = $startDate->copy();
            while($loopDate->lte($endDate)) {
                $category[] = $loopDate->format('m/d/Y');
                $graphData[] = BookingCheckinDetails::where('customer_id' ,$request->id)->whereDate('checked_at',$loopDate->toDateString())->count() ;
                $loopDate->addDay();
            }
        }

        $graphData = json_encode($graphData);
        $categoryData = json_encode($category);
        return View('personal.attendance_belt.graph',compact('graphData','categoryData')); 
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
