<?php

namespace App\Http\Controllers;

// use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Auth,Response,Redirect,Validator,Input,Image,File,DB,DateTime,Config,Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Gate,Log};

use App\{PageAttachment,BusinessCompanyDetail,BusinessExperience,BusinessInformation,BusinessService,BusinessTerms,BusinessVerified,BusinessServices,BusinessServicesMap,BusinessPriceDetails,BusinessSubscriptionPlan,BusinessActivityScheduler,PageLike,Notification,Sports,BusinessReview,BusinessPostViews,UserFollow,UserBookingStatus,UserBookingDetail,MailService,User,UserService,UserProfessionalDetail,PagePost,PagePostComments,PagePostCommentsLike,PagePostLikes,PagePostSave,CompanyInformation,Miscellaneous,BusinessServiceReview,Transaction,CustomerPlanDetails,Customer,BusinessStaff,CompanyRevenueGoalTracker};

class BusinessController extends Controller
{
	protected $users;
    public function __construct(UserRepository $users)
    {
		$this->users = $users;
    }

    public function dashboard(Request $request ,$dates= null, $id= null){

        if(count(Auth::user()->company) == 0){
            return redirect('/personal/manage-account');
        }

        $bookingCount = $ptdata=  $evdata = $clsdata = $expdata = $prdata =$totalSales =  $in_person =$online = $customerCount = $remainingRecPercentage =$failedRecPercentage = $completedRecPercentage = $previousTotalSales = $totalsalePercentage =  $customerCountPercentage = $bookingCountPercentage = $totalRecurringPmt = $compltedpmtcnt = $remainigpmtcnt =$recurringAmount = $completeRecurringAmount = $reminingRecurringAmount = $failedRecurringAmount = $left_days = $currentMonthRevenue = $dayOfMonth = $revenuePerDay = $revenueShouldbeOnDay = $revenueAchivedPercentage = $reserveMembersCount = $reserveMembersCountPercentage = $revenuePerDayNeeded = 0;

        $ptdata1= $expiringMembership = $activitySchedule  = $businessServices =  $revenueDataAry = $revenueDataMonthAry= []; $revenueData  = $categoryMonthData= '';

        if($id != ''){
            User::where('id',Auth::user()->id)->update(['cid'=> $id]);
            return redirect(route('business_dashboard'));
        }

        $activePlan = Auth::user()->CustomerPlanDetails()->where('amount','!=',0)->whereDate('expire_date','>=',date('Y-m-d'))->whereDate('starting_date','<=',date('Y-m-d'))->latest()->first();

        $startDate = Carbon::now()->firstOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->lastOfMonth()->format('Y-m-d');

        
        $date = explode(' to ', @$dates);
        $startDate = @$date[0] != '' ? date('Y-m-d',strtotime($date[0])): $startDate;
        $endDate = array_key_exists(1,$date) ? date('Y-m-d',strtotime($date[1])): $endDate;

        $startDateCalendar =  @$date[0] != '' ?  $date[0]: Carbon::now()->firstOfMonth()->format('Y-m-d');
        $endDateCalendar = array_key_exists(1,$date) ? $date[1] : Carbon::now()->lastOfMonth()->format('Y-m-d');
        
        $startDateMonth = Carbon::parse($startDate)->format('m'); 
        $startDateYear = Carbon::parse($startDate)->format('Y'); 
        $endDateMonth =  Carbon::parse($endDate)->format('m');
        $endDateYear =  Carbon::parse($endDate)->format('Y');

        $business = Auth::user()->current_company;
        $business_id =  @$business->id;
        $dba_business_name =  @$business->dba_business_name ?? @$business->company_name;

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        if(@$business != ''){
            $customers= @$business->customers()->whereYear('created_at', '>=', $startDateYear)->whereMonth('created_at', '>=', $startDateMonth)->whereYear('created_at', '<=', $endDateYear)->whereMonth('created_at', '<=', $endDateMonth)->get();

            $customerCount = $customers->filter(function ($customer) {
                return $customer->is_active() == 'Prospect'; 
            })->count();

            $reserveMembersCount = $customers->filter(function ($customer) {
                return $customer->is_active() == 'Active'; 
            })->count();

            $bookingCount = $business->UserBookingDetails()->where('order_type' ,'Membership')->whereYear('created_at', '>=', $startDateYear)->whereMonth('created_at', '>=', $startDateMonth)->whereYear('created_at', '<=', $endDateYear)->whereMonth('created_at', '<=', $endDateMonth)->count();

            $startSubDate = Carbon::createFromDate($startDateYear, $startDateMonth, 1)->subMonth();
            $endSubDate = Carbon::createFromDate($endDateYear, $endDateMonth, 1)->subMonth()->endOfMonth();

            $priviousBookingCount = $business->UserBookingDetails()->where('order_type' ,'Membership')->whereDate('created_at', '>=', $startSubDate)->whereDate('created_at', '<=', $endSubDate)->count();

            $customersPrevious= @$business->customers()->whereDate('created_at', '>=', $startSubDate)->whereMonth('created_at', '<=', $endSubDate)->get();

            $priviousCustomerCount = $customersPrevious->filter(function ($customer) {
                return $customer->is_active() == 'Prospect'; 
            })->count();

            
            $previousReserveMembersCount = $customersPrevious->filter(function ($customer) {
                return $customer->is_active() == 'Active'; 
            })->count();
           
            $customerCountPercentage =  $priviousCustomerCount != 0 ? number_format(($customerCount - $priviousCustomerCount)*100/$priviousCustomerCount,2,'.','') : 0;

            $reserveMembersCountPercentage =  $previousReserveMembersCount != 0 ? number_format(($reserveMembersCount - $previousReserveMembersCount)*100/$previousReserveMembersCount,2,'.','') : 0;
           
            $bookingCountPercentage = $priviousBookingCount != 0 ? number_format(($bookingCount - $priviousBookingCount)*100/$priviousBookingCount,2,'.',''): 0; 

            $booking = @$business->UserBookingDetails();
          
            $totalSales = Transaction::select('transaction.*')
              ->where('item_type', 'UserBookingStatus')
              ->where('kind','!=' ,'comp')
              ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
              ->join('user_booking_details as ubd', function($join) use ($business_id) {
                  $join->on('ubd.booking_id', '=', 'ubs.id')->where('ubd.order_type', 'Membership')
                      ->where('ubd.business_id', '=', $business_id);
              })->whereDate('transaction.created_at', '>=', $startDate)->whereDate('transaction.created_at', '<=', $endDate)->sum('transaction.amount');

            $previousTotalSales = Transaction::select('transaction.*')
              ->where('item_type', 'UserBookingStatus')
              ->where('kind','!=' ,'comp')
              ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
              ->join('user_booking_details as ubd', function($join) use ($business_id) {
                  $join->on('ubd.booking_id', '=', 'ubs.id')->where('ubd.order_type', 'Membership')
                      ->where('ubd.business_id', '=', $business_id);
              })->whereDate('transaction.created_at','>=',Carbon::parse($startDate)->subMonth()->format('Y-m-d'))->whereDate('transaction.created_at', '<=', Carbon::parse($endDate)->subMonth()->format('Y-m-d'))->sum('transaction.amount');

            $totalSalesforRecurring = Transaction::select('transaction.*')
                ->where('item_type', 'Recurring')
                ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')
                ->where('rec.business_id', '=', $business_id)
                ->whereDate('transaction.created_at', '>=', $startDate)
                ->whereDate('transaction.created_at', '<=', $endDate)->sum('transaction.amount');

            $previousTotalSalesforRecurring = Transaction::select('transaction.*')
                ->where('item_type', 'Recurring')
                ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')
                ->where('rec.business_id', '=', $business_id)
                ->whereDate('transaction.created_at', '>=', Carbon::parse($startDate)->subMonth()->format('Y-m-d'))
                ->whereDate('transaction.created_at', '<=', Carbon::parse($endDate)->subMonth()->format('Y-m-d'))->sum('transaction.amount');

            $totalSales += $totalSalesforRecurring;
            $previousTotalSales += $previousTotalSalesforRecurring;

            if(!empty($booking->get())){
                foreach($booking->get() as $b){
                    /*if(!empty($b->BookingCheckinDetails()->get())){
                        foreach( $b->BookingCheckinDetails()->get() as $chkindata){
                            $ptdata += $chkindata->UserBookingDetail->business_services()->where('service_type' ,'individual')->count(); 
                            $evdata += $chkindata->UserBookingDetail->business_services()->where('service_type' ,'events')->count(); 
                            $clsdata += $chkindata->UserBookingDetail->business_services()->where('service_type' ,'classes')->count(); 
                            $expdata += $chkindata->UserBookingDetail->business_services()->where('service_type' ,'experience')->count();
                        }
                    }*/
                    
                    $in_person += $b->userBookingStatus->Transaction()->where(['user_type' =>'Customer'])->count();
                    $online +=  $b->userBookingStatus->Transaction()->where(['user_type' =>'user'])->count();
                }
            }

            $totalSales = number_format($totalSales,2,'.','');
            $totalsalePercentage =  $previousTotalSales != 0 ? number_format(($totalSales - $previousTotalSales)*100/$previousTotalSales,2,'.','') : 0;
    
            $expiringMembership = $booking->whereDate('expired_at', '>=', $startDate)->whereDate('expired_at', '<=', $endDate)->get();

            $activitySchedule = @$business->business_activity_schedulers()->whereDate('end_activity_date','>=', $startDate)->limit(4)->get();
            /*->whereDate('end_activity_date','<=', $endDate)*/

            $businessServices = $business->business_services()->whereDate('created_at', '>=', $startOfWeek)
                    ->whereDate('created_at', '<=', $endOfWeek)
                    ->get();

            //$recurringAmount = DB::table('recurring')->where('business_id',$business_id)->whereNull('payment_number')->whereDate('payment_date', '>=', $startDate)->whereDate('payment_date', '<=', $endDate)->select(DB::raw('sum(amount+tax) AS total_sales'))->get();

            $completeRecurringAmount = DB::table('recurring')
                ->where('business_id',$business_id)->whereNull('payment_number')->whereDate('payment_on', '>=', $startDate)->whereDate('payment_on', '<=', $endDate)
                ->select(DB::raw('sum(amount+tax) AS total_sales'))
                ->where('status' ,'Completed')->get();

            $recurringData = DB::table('recurring')->where('business_id',$business_id)->whereNull('payment_number')->whereDate('payment_date', '>=', $startDate)->whereDate('payment_date', '<=', $endDate)->select(DB::raw('sum(amount+tax) AS total_sales'));
            $reminingRecurringAmount = $recurringData->where('status' ,'!=','Scheduled')->get();

            $failedRecurringAmount = $recurringData->whereIn('status' ,['failed','Retry'])->get();

            $completeRecurringAmount = $completeRecurringAmount[0]->total_sales ?? 0;
            $reminingRecurringAmount = $reminingRecurringAmount[0]->total_sales ?? 0;
            $failedRecurringAmount = $failedRecurringAmount[0]->total_sales ?? 0;
           // $recurringAmount = $recurringAmount[0]->total_sales ?? 0;
            $recurringAmount = $completeRecurringAmount + $reminingRecurringAmount + $failedRecurringAmount;
            $completedRecPercentage = $recurringAmount != 0 ? ( $completeRecurringAmount / $recurringAmount)*100 : 0 ;
            $completedRecPercentage = number_format($completedRecPercentage,2,'.','');
            $completeRecurringAmount = number_format($completeRecurringAmount,2,'.','');

            $remainingRecPercentage = $recurringAmount != 0 ? ( $reminingRecurringAmount / $recurringAmount) *100 : 0   ;
            $remainingRecPercentage = number_format($remainingRecPercentage,2,'.','');
            $reminingRecurringAmount = number_format($reminingRecurringAmount,2,'.','');

            $failedRecPercentage = $recurringAmount != 0 ? ( $failedRecurringAmount / $recurringAmount) *100 : 0   ;
            $failedRecPercentage = number_format($failedRecPercentage,2,'.','');
            $failedRecurringAmount = number_format($failedRecurringAmount,2,'.','');
            
            $recurringAmount = number_format($recurringAmount,2,'.','');

            $revenueData = CompanyRevenueGoalTracker::where(['year' =>date('Y') ,'business_id' => $business_id])->first();
            $revenueDataPrivious = CompanyRevenueGoalTracker::where(['year' =>date('Y') - 1 ,'business_id' => $business_id])->first();

            $currentYear = date('Y');
            $previousYear =  date('Y') - 1;

            $months = range(1, 12);
            $monthYearArray = array_map(function($month) use ($currentYear) {
                return $currentYear . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
            }, $months);

            $premonthYearArray = array_map(function($month) use ($previousYear) {
                return $previousYear . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
            }, $months);

        
            foreach($premonthYearArray as $m){
                
                $totalSalesMonthly = Transaction::selectRaw('SUM(transaction.amount) as total_sales, DATE_FORMAT(transaction.created_at, "%Y-%m") as month_year')
                    ->where('item_type', 'UserBookingStatus')
                    ->where('kind', '!=', 'comp')
                    ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
                    ->join('user_booking_details as ubd', function ($join) use ($business_id) {
                        $join->on('ubd.booking_id', '=', 'ubs.id')
                            ->where('ubd.order_type', 'Membership')
                            ->where('ubd.business_id', '=', $business_id);
                    })
                    ->whereDate('transaction.created_at','>=', $m. '-01')
                    ->whereDate('transaction.created_at','<=', $m. '-31')
                    ->sum('transaction.amount');

                $totalSalesforRecurringMonthly = Transaction::selectRaw('SUM(transaction.amount) as total_sales, DATE_FORMAT(transaction.created_at, "%Y-%m") as month_year')
                    ->where('item_type', 'Recurring')
                    ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')
                    ->where('rec.business_id', '=', $business_id)
                    ->whereDate('transaction.created_at','>=', $m. '-01')
                    ->whereDate('transaction.created_at','<=', $m. '-31')
                    ->sum('transaction.amount');
                $tot = $totalSalesMonthly + $totalSalesforRecurringMonthly;
                
                $arrayPreYear[] = number_format($tot,2,'.','') ?? 0;
            }

            $arrayPreYear = array_map('floatval', $arrayPreYear);


            foreach($monthYearArray as $m){
                
                $totalSalesMonthly = Transaction::selectRaw('SUM(transaction.amount) as total_sales, DATE_FORMAT(transaction.created_at, "%Y-%m") as month_year')
                    ->where('item_type', 'UserBookingStatus')
                    ->where('kind', '!=', 'comp')
                    ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
                    ->join('user_booking_details as ubd', function ($join) use ($business_id) {
                        $join->on('ubd.booking_id', '=', 'ubs.id')
                            ->where('ubd.order_type', 'Membership')
                            ->where('ubd.business_id', '=', $business_id);
                    })
                    ->whereDate('transaction.created_at','>=', $m. '-01')
                    ->whereDate('transaction.created_at','<=', $m. '-31')
                    ->sum('transaction.amount');

                $totalSalesforRecurringMonthly = Transaction::selectRaw('SUM(transaction.amount) as total_sales, DATE_FORMAT(transaction.created_at, "%Y-%m") as month_year')
                    ->where('item_type', 'Recurring')
                    ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')
                    ->where('rec.business_id', '=', $business_id)
                    ->whereDate('transaction.created_at','>=', $m. '-01')
                    ->whereDate('transaction.created_at','<=', $m. '-31')
                    ->sum('transaction.amount');
                $tot = $totalSalesMonthly + $totalSalesforRecurringMonthly;
                
                $array3Year[] = number_format($tot,2,'.','') ?? 0;
            }

            $array3Year = array_map('floatval', $array3Year);

        
            $revenueDataAry = [

                $arrayPreYear,

                [$revenueData->jan_goal ?? 0 ,$revenueData->feb_goal ?? 0, $revenueData->mar_goal ?? 0, $revenueData->apr_goal ?? 0, $revenueData->may_goal ?? 0, $revenueData->jun_goal ?? 0, $revenueData->jul_goal ?? 0, $revenueData->aug_goal ?? 0, $revenueData->sep_goal ?? 0, $revenueData->oct_goal ?? 0, $revenueData->nov_goal ?? 0, $revenueData->dec_goal ?? 0 ], 

                $array3Year, 
            ];

            $currentMnth = strtolower( date('M')).'_goal';
            $currentMonthRevenue = @$revenueData->$currentMnth;
            $dayOfMonth = date('j');
            $countOfDaysInMonth = Carbon::now()->daysInMonth;
            $revenuePerDay =  $currentMonthRevenue != 0 ?  number_format(($currentMonthRevenue / $countOfDaysInMonth),2,'.',''): 0;

            $revenuePerDayNeeded =  $currentMonthRevenue != 0 ?  number_format((($currentMonthRevenue - $totalSales) / ($countOfDaysInMonth -  $dayOfMonth + 1)),2,'.',''): 0;
            $revenueShouldbeOnDay = $dayOfMonth != 0 ? number_format(($revenuePerDay * $dayOfMonth),2,'.','') :0;
     
            $revenueAchivedPercentage = $currentMonthRevenue != 0 ?  number_format(100 - (($currentMonthRevenue - $totalSales)/$currentMonthRevenue) * 100,2,'.','') :0;
            $category = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            $categoryData = json_encode($category);


            $lastYearCurrentMonth = @$revenueDataPrivious->$currentMnth;
            $lastYearRevenuePerDay =  $currentMonthRevenue != 0 ?  number_format(($lastYearCurrentMonth / $countOfDaysInMonth),2,'.',''): 0;

            $startDateR = Carbon::now()->startOfMonth();
            $endDateR  = Carbon::now()->endOfMonth();
            $loopDate = $startDateR->copy();
            $totalRe = 0;
            while($loopDate->lte($endDateR)) {
                $categoryMonth[] = $loopDate->format('m/d/Y');
            
                $totalSalesMonthly = Transaction::selectRaw('SUM(transaction.amount) as total_sales, DATE_FORMAT(transaction.created_at, "%Y-%m") as month_year')
                    ->where('item_type', 'UserBookingStatus')
                    ->where('kind', '!=', 'comp')
                    ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
                    ->join('user_booking_details as ubd', function ($join) use ($business_id) {
                        $join->on('ubd.booking_id', '=', 'ubs.id')
                            ->where('ubd.order_type', 'Membership')
                            ->where('ubd.business_id', '=', $business_id);
                    })
                    ->whereDate('transaction.created_at', $loopDate->format('Y-m-d'))
                    ->sum('transaction.amount');

                $totalSalesforRecurringMonthly = Transaction::selectRaw('SUM(transaction.amount) as total_sales, DATE_FORMAT(transaction.created_at, "%Y-%m") as month_year')
                    ->where('item_type', 'Recurring')
                    ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')
                    ->where('rec.business_id', '=', $business_id)
                    ->whereDate('transaction.created_at', $loopDate->format('Y-m-d'))
                    ->sum('transaction.amount');
                $tot = $totalSalesMonthly + $totalSalesforRecurringMonthly;
                $tot =  number_format($tot,2,'.','')  ?? 0;

                $totalRe += $tot ;
                $array3[] = $tot ;

                if($loopDate->format('Y-m-d') <= date('Y-m-d')){
                   
                    if ($loopDate->day == 1) {
                        $array1[] = $revenuePerDay;
                    }else{
                        $cR = number_format( ( ($currentMonthRevenue - $totalRe) / ($countOfDaysInMonth - $loopDate->day +1) ),2,'.','') ?? 0; 
                        $array1[] = $cR;
                    }
                }else{
                    $array1[] = $revenuePerDayNeeded;
                }
                $loopDate->addDay(); 
            }

            $startDateRP = Carbon::now()->startOfMonth()->subYear();
            $endDateRP  = Carbon::now()->endOfMonth()->subYear();
            $loopDateP = $startDateRP->copy();
            while($loopDateP->lte($endDateRP)) {
                $loopDateP->addDay();
                $totalSalesMonthlyP = Transaction::selectRaw('SUM(transaction.amount) as total_sales, DATE_FORMAT(transaction.created_at, "%Y-%m") as month_year')
                    ->where('item_type', 'UserBookingStatus')
                    ->where('kind', '!=', 'comp')
                    ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
                    ->join('user_booking_details as ubd', function ($join) use ($business_id) {
                        $join->on('ubd.booking_id', '=', 'ubs.id')
                            ->where('ubd.order_type', 'Membership')
                            ->where('ubd.business_id', '=', $business_id);
                    })
                    ->whereDate('transaction.created_at', $loopDateP->format('Y-m-d'))
                    ->sum('transaction.amount');

                $totalSalesforRecurringMonthlyP = Transaction::selectRaw('SUM(transaction.amount) as total_sales, DATE_FORMAT(transaction.created_at, "%Y-%m") as month_year')
                    ->where('item_type', 'Recurring')
                    ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')
                    ->where('rec.business_id', '=', $business_id)
                    ->whereDate('transaction.created_at', $loopDateP->format('Y-m-d'))
                    ->sum('transaction.amount');
                $totP = $totalSalesMonthlyP + $totalSalesforRecurringMonthlyP;
                
                $array2[] = number_format($totP,2,'.','')  ?? 0;
            }


            $revenueDataMonthAry = [ array_map('floatval', $array2) ,array_map('floatval', $array1),  array_map('floatval', $array3)];
            $categoryMonthData = json_encode($categoryMonth);
        }
               
        return view('business.dashboard',compact('customerCount','bookingCount','in_person' ,'online','expiringMembership','activitySchedule','ptdata','evdata','clsdata','expdata','prdata','totalSales','business_id','totalRecurringPmt','compltedpmtcnt','remainigpmtcnt','dba_business_name','remainingRecPercentage','failedRecPercentage','completedRecPercentage','totalsalePercentage','bookingCountPercentage','customerCountPercentage','startDate','endDate','startDateCalendar','endDateCalendar','completeRecurringAmount','reminingRecurringAmount','failedRecurringAmount','recurringAmount','left_days','activePlan','revenueData','revenueDataAry','revenuePerDay','revenueShouldbeOnDay','revenueAchivedPercentage','categoryData','categoryMonthData','revenueDataMonthAry','currentMonthRevenue' ,'reserveMembersCount','reserveMembersCountPercentage','revenuePerDayNeeded'));
    }

    public function getRevenueAjax(Request $request){
        //print_r($request->all());exit;
        $revenueData = CompanyRevenueGoalTracker::where(['year' =>date('Y') ,'business_id' => Auth::User()->cid])->first();
        $revenueDataPrivious = CompanyRevenueGoalTracker::where(['year' =>date('Y') - 1 ,'business_id' =>Auth::User()->cid])->first();

        if($request->type == 'Y'){
            $revenueDataAry = [
                [$revenueDataPrivious->jan_goal ?? 0,$revenueDataPrivious->feb_goal ?? 0,$revenueDataPrivious->mar_goal ?? 0,$revenueDataPrivious->apr_goal ?? 0,$revenueDataPrivious->may_goal ?? 0,$revenueDataPrivious->jun_goal ?? 0,$revenueDataPrivious->jul_goal ?? 0,$revenueDataPrivious->aug_goal ?? 0,$revenueDataPrivious->sep_goal ?? 0,$revenueDataPrivious->oct_goal ?? 0,$revenueDataPrivious->nov_goal ?? 0,$revenueDataPrivious->dec_goal  ?? 0],

                [$revenueData->jan_goal ?? 0 ,$revenueData->feb_goal ?? 0, $revenueData->mar_goal ?? 0, $revenueData->apr_goal ?? 0, $revenueData->may_goal ?? 0, $revenueData->jun_goal ?? 0, $revenueData->jul_goal ?? 0, $revenueData->aug_goal ?? 0, $revenueData->sep_goal ?? 0, $revenueData->oct_goal ?? 0, $revenueData->nov_goal ?? 0, $revenueData->dec_goal ?? 0 ], 
            ];

            $category = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        }else{
            $currentMnth = strtolower( date('M')).'_goal';
            $revenueDataAry = [
                [$revenueDataPrivious->$currentMnth ?? 0],

                [$revenueData->$currentMnth ?? 0], 
            ];
        }

        $graphData = json_encode($revenueDataAry);
        $categoryData = json_encode($category);
        return View('business.revenue_graph',compact('graphData','categoryData')); 
    }

    public function setRevenueGoal(Request $request){
        $input =  $request->except(['_token' ,'id','url']);
        CompanyRevenueGoalTracker::updateOrCreate(['id' => $request->id], $input);
        return redirect($request->url);
    }

    public function notification_delete(Request $request){
        $idsArray = explode(',', $request->id);
        Notification::whereIn('id',$idsArray)->delete();
    }

    public function getBookingList(Request $request){
       /* $programName = $this->businessservice->findById($request->sid)->program_name;
        $date = date('m-d-Y',strtotime($request->date));
        $data = $this->bookings->getbusinessbookingsdata($request->sid,date('Y-m-d',strtotime($request->date)) ,$request->type );
        return view('business.services.view_bookings_of_service', compact('data', 'date', 'programName', 'sid' ,'type'));
        return view('business.bookingListModal',compact('');*/
    }

    public function bookingchart(Request $request){
        $business = Auth::user()->current_company;
        $ptdata=  $evdata = $clsdata = $expdata = $prdata = $in_person_cnt= $online_cnt=0;
        $booking = $business->UserBookingDetails();
        $currentMonth = date('m');
        $startDateMonth = Carbon::parse($request->startDate)->format('m'); 
        $endDateMonth =  Carbon::parse($request->endDate)->format('m');
        foreach($booking->get() as $b){
            $chkdetail = $b->BookingCheckinDetails();
            $in_person = $b->userBookingStatus->Transaction()->where(['user_type' =>'Customer']);
            $online =  $b->userBookingStatus->Transaction()->where(['user_type' =>'user']);

            if($request->val == '1'){
                $chkdetail =  $chkdetail->whereMonth('checkin_date','>=' ,$startDateMonth)->whereMonth('checkin_date','<=' ,$endDateMonth);
                $in_person = $in_person->whereMonth('created_at','>=' ,$startDateMonth)->whereMonth('created_at','<=' ,$endDateMonth);
                $online = $online->whereMonth('created_at','>=' ,$startDateMonth)->whereMonth('created_at','<=' ,$endDateMonth);
            }
            $chkdetail =  $chkdetail->get();
            foreach($chkdetail as $chkindata){
                $ptdata += $chkindata->UserBookingDetail->business_services()->where('service_type','individual')->count(); 
                $evdata += $chkindata->UserBookingDetail->business_services()->where('service_type','events')->count(); 
                $clsdata += $chkindata->UserBookingDetail->business_services()->where('service_type','classes')->count(); 
                $expdata += $chkindata->UserBookingDetail->business_services()->where('service_type','experience')->count();
            }

            $in_person_cnt += count($in_person->get());
            $online_cnt += count($online->get());
        }
    
        if($request->type == 'revenue'){
            $data = array(
                'in_person' =>  $in_person_cnt,
                'online'   =>  $online_cnt,
            );
        }else{
            $data = array(
                'ptdata' => $ptdata,
                'clsdata' => $clsdata,
                'expdata' => $expdata,
                'evdata' => $evdata,
                'prdata' => $prdata,
            );
        }
        return json_encode($data);
    }

    public function getExpiringMembership(Request $request){
        $business = Auth::user()->current_company;
        $booking = $business->UserBookingDetails();
        $enddate = date('Y-m-d', strtotime("+".$request->days." days"));
        $expiringMembership = $booking->whereDate('expired_at', '>=', date('Y-m-d'))->whereDate('expired_at', '<=', $enddate)->get();
        $html = '';
        foreach($expiringMembership as $key=>$emp ){
            if($emp->Customer != '' && $emp->business_price_detail != ''){
                $Customer = $emp->Customer;
                $key = $key+1;
                $html .= '<tr>
                    <td>
                       <h5 class="fs-14 my-1 fw-normal">'. $key.'</h5>
                    </td> 

                    <td>
                       <h5 class="fs-14 my-1 fw-normal">'.@$Customer->full_name.'</h5>
                    </td>
                    <td>
                       <h5 class="fs-14 my-1 fw-normal">'.@$emp->business_price_detail->price_title.'</h5>
                    </td>
                    <td>
                       <h5 class="fs-14 my-1 fw-normal">'.date('m-d-Y', strtotime($emp->contract_date)).'</h5>  
                    </td>
                    <td>
                        <h5 class="fs-14 my-1 fw-normal">'.date('m-d-Y', strtotime($emp->expired_at)).'</h5>
                    </td>
                    <td>
                         <a href="'.route('personal.orders.index',['business_id'=>$emp->business_id]).'"> View </a>
                    </td>
                </tr>';
            }
        }
        return  $html;
    }
	
    public function getscheduleactivity(Request $request){

        if($request->type == 'Personal Training'){
            $request->type = 'individual';
        }
            
        $business = Auth::user()->current_company;

        if($request->date == ''){
            $date = date('Y-m-d');
        }else{
            $date =  date('Y-m-d' ,strtotime($request->date));
        }
        
        //$activitySchedule = $business->business_activity_schedulers()->whereDate('end_activity_date','>=',$date)->get();
        $activitySchedule = $business->business_activity_schedulers()->whereDate('end_activity_date','>=',$date)->get();

        $html = '';
        $inc = 0;
        if(!empty($activitySchedule) && count($activitySchedule)>0){
            foreach($activitySchedule as $as){
            
                $chk = ($as->business_service->service_type == strtolower($request->type) || $request->type == 'Show All Activities') ? 1 : 0;
                if($chk == 1 && $inc < 4){
                    $SpotsLeftdis = 0;
                    $bs = new  \App\Repositories\BookingRepository;
                    $bookedspot = $bs->gettotalbooking($as->id,date('Y-m-d')); 
                    $SpotsLeftdis = $as->spots_available - $bookedspot; 
                    $html .= '<div class="mini-stats-wid d-flex align-items-center mt-3">
                        <div class="flex-shrink-0 avatar-sm">
                            <span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4 multiple-activites">
                                '.$SpotsLeftdis.'/'.$as->spots_available.' 
                                <label>Spots left</label>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3 activity-info">
                            <h6 class="mb-1">'.@$as->business_service->program_name.'</h6>
                            <p class="text-muted mb-0">'.@$as->businessPriceDetailsAges->category_title.'</p>
                            <p class="text-muted mb-0">'.@$as->business_service->price_details()->first()->price_title.'</p>
                        </div>
                        <div class="flex-shrink-0 ms-3">
                            <p class="text-muted mb-0 color-black">'.date('h:i A', strtotime($as->shift_start)).'</p>
                            <p class="text-muted mb-0 color-black">'.date('h:i A', strtotime($as->shift_end)).'</p>
                        </div>
                    </div>';
                    $inc++;
                }
            }
        }
        return $html;
    }

    public function getClientModelData(Request $request){
        if(!$request->cDate){
            $request->cDate = date('Y-m-d');
        }
        $type = $request->type;
        $business = CompanyInformation::find($request->business_id);
        $currentDate = Carbon::now(); 
        switch ($type) {
            case 'date':
                $cDate = $request->cDate;
                break;

            case 'week':
                $cDate = $currentDate->startOfWeek()->format('Y-m-d');
                break;

            case 'month':
                $cDate = $currentDate->format('Y-m');
                break;
        }

        $customers = [];
       
        $cDate = $request->cDate;
        /* echo $cDate ;*//*exit;*/
        $customers = $business->customers()->where(function ($query) use ($cDate, $type) {
                $query->when($type == 'week', function ($q) use ($cDate) {
                    $weekStart = Carbon::parse($cDate)->startOfWeek();
                    $weekEnd = Carbon::parse($cDate)->endOfWeek();
                    $q->whereBetween('created_at', [$weekStart, $weekEnd]);
                })
                ->when($type == 'month', function ($q) use ($cDate) {
                    $timestamp = strtotime($cDate);
                     $year = date('Y', $timestamp);
                     $month = date('n', $timestamp);
                    $q->whereMonth('created_at', $month )->whereYear('created_at', $year);
                })
                ->when($type === 'date', function ($q) use ($cDate) {
                    $q->whereDate('created_at', $cDate);
                });
                $query->orderBy('created_at', 'desc');
            })->orderBy('created_at', 'desc')->get();

        //print_r($customers);exit;
       
        $data = $customers->filter(function ($customer) {
            return $customer->is_active() != 'Active'; 
        })->all();
    
        return view('business.view_new_client_modal', compact('data', 'cDate' ,'type'));
    }

	public function pagePost(Request $request) {
		$images=array();
        $loggedinUser = Auth::user(); 
		$page_id = $request->page_id;
        if($request->hasFile('image_post')){  
			$files=$request->file('image_post'); 
			foreach($files as $file){
                $name=$file->getClientOriginalName();               
                $images[]=$name;
                $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR, $name);
            }
           
            $data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "images" => implode("|",$images),
				"page_id" => $page_id,
            );
            PagePost::create($data);
        }
        else if($request->hasFile('video')){
            $this->validate($request, [
                'video' => 'required|mimes:mp4,mov,ogg,qt | max:10000',            
            ]);
            $imagebanner = $request->file('video');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'video'.DIRECTORY_SEPARATOR, $name); 
            $data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "video" => $name,
				"page_id" => $page_id,
            );
			PagePost::create($data);
        }
		else if($request->hasFile('music_post')){ 
			$imagebanner = $request->file('music_post');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'music'.DIRECTORY_SEPARATOR, $name); 
            $data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "music" => $name,
				"page_id" => $page_id,
            );
           PagePost::create($data);
        }
		else if( $request->selfieimg !='' ){ 
			$data = $request->selfieimg;
			
			list($type, $data) = explode(';', $data);
			list(, $data) = explode(',', $data);
			$data = base64_decode($data);
			$imgname= 'selfie_image'.date('dmYHis');
			
			file_put_contents(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id.DIRECTORY_SEPARATOR.$imgname.'.png', $data);
			
			$data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "images" => $imgname.'.png',
				"page_id" => $page_id,
            );
            PagePost::create($data);
		}
		else if($request->post_text != '' && !$request->hasFile('music_post') && !$request->hasFile('video') && !$request->hasFile('image_post') && !$request->selfieimg ){
			$data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
				"page_id" => $page_id,
            );
           PagePost::create($data);
		}
        return Redirect::back()->with('success', 'Post created succesfully!');
    }
	
	public function pagePostcomment($id,Request $request) { 
       $data=array(
       		"user_id" => Auth::user()->id,
            "post_id" => $id,
            "comment" => $request->comment,
       );
        $data = PagePostComments::create($data);
        $comment =  PagePostComments::where('id',$data->id)->first();
        $username = User::find($comment->user_id);
		$cmntlike=''; $cmntUlike='';
		$cmntlike = PagePostCommentsLike::where('comment_id', $comment->id)->count();
		// $cmntUlike = PostCommentLike::where('comment_id',$comment->id)->where('user_id',Auth::user()->id)->count();
		$commentLiked='';
		if($cmntUlike>0){ $commentLiked='commentLiked'; }
        $html = '<li>
                    <div class="comet-avatar">';
						if(File::exists(public_path("/uploads/profile_pic/thumb/".$username->profile_pic ))){
                        	$html.= '<img src="/public/uploads/profile_pic/thumb/'.$username->profile_pic.'" alt="pic">';
                        }else{ 
							$pf=substr($username->firstname, 0, 1).substr($username->lastname, 0, 1);
                            $html.= '<div class="admin-img-text"><p>'.$pf.'</p></div>';
						}
                     $html.= '</div>
                    <div class="we-comment">
                        <h5><a href="javascript:void(0);" title="">'.$username->firstname.' '.$username->lastname.'</a></h5>
                        <p>'.$comment->comment.'</p>
                        <div class="inline-itms">
                            <span>'.$comment->created_at->diffForHumans().'</span>
							<a href="javascript:void(0);" class="commentlike" id="'.$comment->id.'" post-id="'.$id.'" ><i class="fa fa-heart '.$commentLiked.'" id="comlikei'.$comment->id.'"></i><span id="comlikecounter'.$comment->id.'">'.$cmntlike.'</span></a>
                        </div>
                    </div>
                </li>';

        return response()->json(array("success"=>'success','html'=>$html));
    }

	public function pageshowcomments($id,Request $request) { 
        $commentdisplay = $request->commentdisplay; 
        
        if($commentdisplay == 5){
            $commentdisplay = $commentdisplay+2;
            $commentData =  PagePostComments::where('post_id',$id)->limit($commentdisplay)->get();
        }else{           
            $commentData =  PagePostComments::where('post_id',$id)->limit($commentdisplay)->get();
        }
        $html ='';
        foreach ($commentData as $comment) {
            $username = User::find($comment->user_id);
			$cmntlike = PagePostCommentsLike::where('comment_id', $comment->id)->count();
			$cmntUlike = PagePostCommentsLike::where('comment_id',$comment->id)->where('user_id',Auth::user()->id)->count();
			$commentLiked='';
			if($cmntUlike>0){ $commentLiked='commentLiked'; }
            $html .= '<li>
                    <div class="comet-avatar">
                        <img src="/public/uploads/profile_pic/thumb/'.$username->profile_pic.'" alt="">
                    </div>
                    <div class="we-comment">
                        <h5><a href="javascript:void(0);" title="">'.$username->firstname.' '.$username->lastname.'</a></h5>
                        <p>'.$comment->comment.'</p>
                        <div class="inline-itms">
                            <span>'.$comment->created_at->diffForHumans().'</span>
                            <a href="javascript:void(0);" class="commentlike" id="'.$comment->id.'" post-id="'.$id.'" ><i class="fa fa-heart '.$commentLiked.'" id="comlikei'.$comment->id.'"></i><span id="comlikecounter'.$comment->id.'">'.$cmntlike.'</span></a>
                        </div>
                    </div>
                </li>';           
        }        
        return response()->json(array("success"=>'success','html'=>$html));
    }

	public function commentLike($id,Request $request) {
		$like = PagePostCommentsLike::where('user_id',Auth::user()->id)->where('comment_id',$id)->first();
		$status='';
		if(!empty($like)){
			PagePostCommentsLike::find($like->id)->delete();
			$status='unlike';
		}
		else
		{
			$data=array(
                "user_id" => Auth::user()->id,
                "post_id" => $request->postId,
				"comment_id" => $id,
            );
            PagePostCommentsLike::create($data);
			$status='like';
		}
		$likecount = PagePostCommentsLike::where('post_id',$request->postId)->where('comment_id',$id)->count();
		return response()->json(array("success"=>'success','count'=>$likecount,'status'=>$status));
	}

    public function updatebusinesspostviewcount(Request $request)
    {
        $ppviews =  BusinessPostViews::where(['post_id'=>$request->post_id,'user_id' => Auth::user()->id])->first();
        if( $ppviews == ''){
            $data=array(
                "user_id" => Auth::user()->id,
                "post_id" => $request->post_id,
            );
           /* print_r($data);*/
            BusinessPostViews::create($data);
        }
    }

	public function likepost($id,Request $request) {
      $like = PagePostLikes::where('user_id',Auth::user()->id)->where('post_id',$id)->first();
      
      if(!empty($like)){
        /* already like any post */
			$saved='0';
			if($like->is_like=='0'){ $saved='1'; }else{ $saved='0'; }
            $like->is_like = $saved;
            $like->update(); 
			$likecount = PagePostLikes::where('post_id',$id)->where('is_like',1)->count();
			return response()->json(array("success"=>'success','count'=>$likecount,'saved'=>$saved));
                     
        }else{
             /*new post like */
			 $saved='1';
            $data=array(
                "user_id" => Auth::user()->id,
                "post_id" => $id,
                "is_like" => $request->is_like,
            );
            PagePostLikes::create($data);
			$likecount = PagePostLikes::where('post_id',$id)->where('is_like',1)->count();
        	return response()->json(array("success"=>'success','count'=>$likecount,'saved'=>$saved));
        }
       // return response()->json(array("success"=>'success','count'=>$like->is_like));
    }
	
	public function savePost(Request $request)
    {
		$postid=$request->postid;
		$pageid=$request->pageid;
		$postsaved = PagePostSave::where('post_id',$postid)->where('user_id',Auth::user()->id)->first();
		if( !empty($postsaved) ) {
			PagePostSave::find($postsaved->id)->delete();
			return response()->json(array("success"=>'delsave'));
		}
		else
		{
			$array = array(
				"post_id" => $postid,
				"page_id" => $pageid,
				"user_id" => Auth::user()->id
			);
			PagePostSave::create($array);
			return response()->json(array("success"=>'success'));
		} 
    }

	public function DelPost(Request $request)
    {
		PagePostSave::where('post_id', $request->postid )->delete();
		PagePostLikes::where('post_id', $request->postid )->delete();
		PagePostComments::where('post_id', $request->postid )->delete();
		PagePostCommentsLike::where('post_id', $request->postid )->delete();
		PagePost::find( $request->postid )->delete();
        return response()->json(array("success"=>'success'));
	}

	public function viewGalleryList($page_id) {
        $galleryPic = [];
        $gallery = DB::select('select id, attachment_name, cover_photo from users_add_attachment where page_id = ? and cover_photo = 1 order by cover_order ASC', [$page_id]);
        if (!empty($gallery) && $gallery[0]->id > 0) {
            foreach ($gallery as $pic) {
                $filename = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR . $pic->attachment_name;
                $obj['id'] = $pic->id;
                $obj['cover'] = $pic->cover_photo;
                $obj['name'] = $pic->attachment_name;
                $obj['size'] = @filesize($filename);
                $galleryPic[] = $obj;
            }
        }
        //return Response::json($galleryPic);
        return $galleryPic;
    }

    public function savegallarypics(Request $request)
    {   
        //echo "string"; print_r($request->all());exit;
        $loggedinUser = Auth::user();
        $pageid=$request->pageid;
        $id = $request->imgId;
        $this->validate($request, [
            'galaryphoto' => 'required|dimensions:min_width=800,min_height=450',
        ]);
        $imageName = '';
        if ($request->hasFile('galaryphoto')) {
            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'page-cover-photo' . DIRECTORY_SEPARATOR;
            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'page-cover-photo' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('galaryphoto'), $file_upload_path, 1, $thumb_upload_path, '247', '266');
            $imageName = $image_upload['filename'];
        }
        
        $affected= PageAttachment::where(['user_id' =>$loggedinUser->id ,'page_id' => $pageid ,'id'=>$id])->update(["attachment_name" => $imageName]);
        if ($affected) {
            return Redirect::back()->with('success', 'Cover photo updated successfully.');
        } else {
            return Redirect::back()->with('error', 'Problem in updating cover photo.');
        } 
    }

	public function savepagecoverphoto(Request $request) {
       /* print_r($request->all());exit();*/
        if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
		$pageid=$request->page_id;
		$pageinfo = CompanyInformation::where('id', $pageid )->first();
        $loggedinUser = Auth::user();
        $cat = User::find($loggedinUser['id']);
        $user = User::where('id', Auth::user()->id)->first();
        $this->validate($request, [
            'coverphoto' => 'required|dimensions:min_width=800,min_height=450',
        ]);

        $imageName = '';
        if ($request->hasFile('coverphoto')) {
            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'page-cover-photo' . DIRECTORY_SEPARATOR;
            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'page-cover-photo' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('coverphoto'), $file_upload_path, 1, $thumb_upload_path, '247', '266');
            $imageName = $image_upload['filename'];
        }
		$array = array(
			"page_id" => $pageid,
			"user_id" => Auth::user()->id,
			"attachment_name" => $imageName,
			"attachment_status" => '1',
			"cover_photo" => "1",
		);
		$affected=PageAttachment::create($array);
        if ($affected) {
            return Redirect::back()->with('success', 'Cover photo updated successfully.');
        } else {
            return Redirect::back()->with('error', 'Problem in updating cover photo.');
        }         
    }
	
	public function editPageProPic(Request $request) {
        $validator = Validator::make($request->all(), [ 'profile_pic' => '|required|image|mimes:jpeg,jpg,png'], [ 'required' => 'The :attribute is required.']);
        if ($validator->fails()) {
            $errMsg = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            return Response::json($response);
        }
        // save profile pic
        $image = new Image();
        $request->profile_pic = '';
        if (!$request->hasFile('profile_pic')) {
            $response = array(
                'type' => 'danger',
                'msg' => 'No image found to upload',
            );
            return Response::json($response);
        }
        $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR;
        $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
        $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('profile_pic'), $file_upload_path, 1, $thumb_upload_path, '415', '354');
        //Store thumb of 150x150
        if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {
            mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);
        }
        $thumb_upload_path150 = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb150' . DIRECTORY_SEPARATOR;
        Image::make($request->file('profile_pic'))->resize(150, 150)->save($thumb_upload_path150 . $image_upload['filename']);
        // save new profile pic
		$page_id = $request->page_id;
        $userObj = CompanyInformation::find($page_id);
        // delete existing image
        if (isset($userObj->logo)) {
            @unlink(public_path('uploads/profile_pic/thumb150') . DIRECTORY_SEPARATOR . $userObj->logo);
            @unlink(public_path('uploads/profile_pic/thumb') . DIRECTORY_SEPARATOR . $userObj->logo);
            @unlink(public_path('uploads/profile_pic') . DIRECTORY_SEPARATOR . $userObj->logo);
        }
        $userObj->logo = $image_upload['filename'];
        if (!$userObj->save()) {
            $response = array(
                'type' => 'danger',
                'msg' => 'Some error while updating profile picture.',
            );
            return Response::json($response);
        } else {
            $image_path = asset('/images') . '/' . 'user.png';
            if ($userObj->profile_pic != '' && file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . $userObj->logo)) {
                $image_path = secure_asset('/public/uploads/profile_pic/thumb') . '/' . $userObj->logo;
            }
            $response = array(
                'type' => 'success',
                'msg' => 'Profile picture updated succesfully!',
                'returndata' => array(
                    'profile_pic' => $image_path
                )
            );
          return Redirect::back()->with('success', 'Profile picture updated succesfully!');
        }
    }
	
	public function editpagepost(Request $request) {
		$loggedinUser = Auth::user(); 
		$id = $request->id;
		$data = PagePost::find($id);      
		$count = count(explode("|",$data->images));        
		$countimg = $count-5;
		$getimages = explode("|",$data->images);
		$html = '<input type="hidden" name="postId" id="postId" value="'.$data->id.'">'; 
      	$html .='<figure>';
       	if($data->video != ''){
        	$html .= '<input id="video" name="video" type="file"/><a href="#" title="" data-toggle="modal" data-target="#img-comt"><video width="320" height="240" src="/public/uploads/gallery/'.$loggedinUser->id.'/video/'.$data->video.'" controls>Your browser does not support the video tag.</video></a>';
       }elseif($data->music != ''){
			$html .= '<input id="music_post" name="music_post" type="file"/><audio src="/public/uploads/gallery/'.$loggedinUser->id.'/music/'.$data->music.'" controls></audio>';
       }elseif( isset($getimages[4]) && !empty($getimages[4]) ){
			$html .=' <div class="img-bunch">
        		<input id="image_post" type="file" name="image_post[]" multiple  />
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">';
						if(isset($getimages[0])){
							$html .=' <figure>
								<i class="delimgpost5 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'" aria-hidden="true" title="Delete photo"></i>
                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[0].'" alt="">
                            	</a>
                        	</figure>';
						}
						if(isset($getimages[1])){
							$html .=' <figure>
								<i class="delimgpost5 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[1].'" aria-hidden="true" title="Delete photo"></i>
								<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[1].'" alt="">
                            	</a>
							</figure>';
						}
                    	$html .='</div>
                    	<div class="col-lg-6 col-md-6 col-sm-6">';
						if(isset($getimages[2])){
							$html .=' <figure>
								<i class="delimgpost5 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[2].'" aria-hidden="true" title="Delete photo"></i>
                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[2].'" alt="">
                            	</a>
                        	</figure>';
                       	}
						if(isset($getimages[3])){
                        	$html .='<figure>
                        		<i class="delimgpost5 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[3].'" aria-hidden="true" title="Delete photo"></i>
                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[3].'" alt="">
                            	</a>
                        	</figure>';
                       }
                       if(isset($getimages[4])){
							$html .='<figure>
                        		<i class="delimgpost5 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[4].'" aria-hidden="true" title="Delete photo"></i>
                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[4].'" alt="">
                            	</a>
                            	<div class="more-photos">
                                	<span>+'.$countimg.'</span>
                            	</div>
                        	</figure>';
						}
                    	$html .='</div>
                	</div>
				</div>
			</div>';
       }
	   elseif( isset($getimages[3]) && !empty($getimages[3]) ){
			$html .='<div class="img-bunch">
        		<input id="image_post" type="file" name="image_post[]" multiple />
					<div class="row">                   
						<div class="col-lg-12 col-md-12 col-sm-12">
                        	<figure>
								<i class="delimgpost4 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'" aria-hidden="true" title="Delete photo"></i>
                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[0].'" alt="">
                            	</a>
							</figure>
                    	</div>
                	</div>
                	<div class="row">   
                		<div class="col-lg-4 col-md-4 col-sm-4"> 
                			<figure>
                				<i class="delimgpost4 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[1].'" aria-hidden="true" title="Delete photo"></i>
                    			<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                    				<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[1].'" alt="" height="170">
                    			</a>
                			</figure>
                		</div>
                		<div class="col-lg-4 col-md-4 col-sm-4"> 
                			<figure>
                				<i class="delimgpost4 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[2].'" aria-hidden="true" title="Delete photo"></i>
                    			<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                    				<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[2].'" alt="" height="170">
                    			</a>
               				</figure>
						</div>
					 	<div class="col-lg-4 col-md-4 col-sm-4">  
                			<figure>
								<i class="delimgpost4 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[3].'" aria-hidden="true" title="Delete photo"></i>
                    			<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                    				<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[3].'" alt="" height="170">
                    			</a>
							</figure>
						</div>
                	</div>
			</div>';
       }
	   elseif( isset($getimages[2]) && !empty($getimages[2]) ){
			$html .='<div class="img-bunch">
				<input id="image_post" type="file" name="image_post[]" multiple  />
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">                
						<figure>
                     		<i class="delimgpost3 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[0].'" alt="" width="100" height="335">
							</a>
                    	</figure>
                	</div>
                	<div class="col-lg-6 col-md-6 col-sm-6">
                    	<figure>                    
                     		<i class="delimgpost3 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[1].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[1].'" alt="" width="100" height="165">
							</a>
                    	</figure>
                    	<figure>
                     		<i class="delimgpost3 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[2].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[2].'" alt="" width="100" height="165">
                        	</a>
                    	</figure>
                	</div>
                </div>
			</div>';
       }
	   elseif( isset($getimages[1]) && !empty($getimages[1]) ) {
			$html .='<div class="img-bunch-two">
				<input id="image_post" type="file" name="image_post[]" multiple  />
				<div class="row">
                	<div class="col-lg-6 col-md-6 col-sm-6">
                    	<figure>                   
                      		<i class="delimgpost2 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[0].'" alt="" height=200>
                        	</a>
                    	</figure>
                	</div>
                	<div class="col-lg-6 col-md-6 col-sm-6">
                    	<figure>
                    		<i class="delimgpost2 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[1].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[1].'" alt="" height=200>
                        	</a>
                    	</figure>
                	</div>
				</div>
			</div>';
       }
	   elseif( isset($getimages[0]) && !empty($getimages[0]) ){
			$html .='<div class="img-bunch">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<figure>
                    		<input id="image_post" type="file" name="image_post[]" multiple  />
                    		<i class="delimgpost1 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<span class="error" id="err_image_sign">
								<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[0].'" alt="">
                        	</a>
						</figure>
					</div>
				</div>
			</div>';
       }
       $html .= '</figure>';
       $html .= '';  
       return response()->json(array("success"=>'success','html'=>$html,'data_textarea'=>$data->post_text));
	}

	public function pagePostupdate(Request $request) { 
		$id = $request->postId;        
		$data = PagePost::find($id);
		if($request->post_text_upd != ''){
        	$postText = $request->post_text_upd;
       	}else{
        	$postText = $data->post_text;
       	}
		$data->post_text = $postText;
        $loggedinUser = Auth::user();
		if($files=$request->file('image_post')) {            
			foreach($files as $file)
			{
                $name=$file->getClientOriginalName();               
                $images[]=$name;
                $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR, $name);
            }
            $imgpost = implode("|",$images);
            $imgpost = $data->images."|".$imgpost;  
        }else{
            $imgpost = $data->images;
        }
		if($request->hasFile('video')){
            $this->validate($request, [
                'video' => 'required|mimes:mp4,mov,ogg,qt | max:10000',            
            ]);
            $imagebanner = $request->file('video');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'video'.DIRECTORY_SEPARATOR, $name);
            $videopost = $name;
        }else{
            $videopost = $data->video;
        }
		if($request->hasFile('music_post')){
            $this->validate($request, [
                'video' => 'required|mimes:mp4,mov,ogg,qt | max:10000',            
            ]);
            $imagebanner = $request->file('music_post');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'music'.DIRECTORY_SEPARATOR, $name);
           $musicpost = $name;
        }else{
            $musicpost = $data->music;
        }
		$data->video = $videopost;
        $data->music = $musicpost;
        $data->images = $imgpost;
        $data->update();
        return redirect()->back()->with('success', 'Post updated succesfully!');
	}
	
	public function viewbusinessprofileofOther($user_name,$id)
	{
		$page_id = $id;
		$company = CompanyInformation::where('id',$id)->first();
        $compare = 'null';
        $loggedinUser = '';
        if($company != ''){
            $loggedinUser = User::where('id',$company->user_id)->first();
            $loggedinUserid = @$loggedinUser->id;
        }
		
       /* echo $loggedinUser; exit();*/
		// $loggedinUser = Auth::user();
        /*if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }*/
		$user_professional_detail = $terms = $business_details = $business_exp = $business_term = $business_spec = $business_service = $business_price = $gallery = [];
        $companyData = $serviceData = $servicePrice = $businessSpec = $services = $max_price = $min_price = [];
        $company['company_images'] = [];
		
		if(!empty($company)) {
            $userId = @$company->user_id;
        	
            $business_details = BusinessCompanyDetail::where('cid', $page_id)->get();
            $business_details = isset($business_details[0]) ? $business_details[0] : [];

            $business_exp = BusinessExperience::where('cid', $page_id)->get();
            $business_exp = isset($business_exp[0]) ? $business_exp[0] : [];
            
            $business_term = BusinessTerms::where('cid', $page_id)->get();
            $business_term = isset($business_term[0]) ? $business_term[0] : [];

            $business_spec = BusinessService::where('cid', $page_id)->get();
            $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
       
            $gallery = $this->galleryList($userId);
           
            $serviceData = BusinessServices::where('cid', $page_id)->where('instant_booking', 1)->get();
            if (isset($serviceData)) {
                foreach ($serviceData as $service) {
                    $company = CompanyInformation::where('id', $service['cid'])->get();
                    $company = isset($company[0]) ? $company[0] : [];
                    if(!empty($company)) {
                    	$companyData[@$company['id']][] = $company;
                    }

                    $price = BusinessPriceDetails::where('cid', $service['cid'])->get();
                    $price = isset($price[0]) ? $price[0] : [];
                    if(!empty($company)) {
                    	$servicePrice[@$company['id']][] = $price;
                    }

                    $business_spec = BusinessService::where('cid', $service['cid'])->get();
                    $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
                    if(!empty($company)) {
                    	$businessSpec[@$company['id']][] = $business_spec;
                    }
                }
            }
			
            if(isset($company['company_images']) && $company['company_images'] != null) {
            	$company['company_images'] = json_decode($company['company_images']);
            }
            $max_price = UserService::where('company_id', @$company['id'])->max('price');
            $min_price = UserService::where('company_id', @$company['id'])->min('price');

            $user_professional_detail = UserProfessionalDetail::where('company_id', $page_id)->first();
			
            $terms = [];
            if (!empty($user_professional_detail)) {
                $user_professional_detail->availability = $user_professional_detail->availability != null ? json_decode(json_decode($user_professional_detail->availability)) : null;
                $terms = BusinessTerms::where('userid', $user_professional_detail->user_id)->get();
            }
			$services = UserService::where('company_id', $company['id'])->get();
		    foreach ($services as $key2 => $value2) {
                $sport = Sports::where('id', $value2['sport'])->first();
                $value2['amenties'] = $sport['sport_name'];
            }
        }
		
		//$UserProfileDetail = $this->users->getUserProfileDetail($company['user_id'], array('professional_detail', 'history', 'education', 'certification', 'service'));
		//$PagePost = PagePost::limit(5)->orderBy('id','desc')->get();
		$UserProfileDetail ='';
		
		$PagePost = PagePost::where('page_id', $page_id)->limit(1)->orderBy('id','desc')->get();
		
        $postsave = [];
        $photos = [];
        $videos = [];
        if( $loggedinUser != ''){
            $postsave = PagePostSave::where('user_id',$loggedinUser->id)->orderBy('id','desc')->get();
            $photos = PagePost::select('images','user_id')->where('images','!=',null)->where('user_id',$loggedinUser->id)->orderBy('id','desc')->limit(10)->get();
            $videos = PagePost::select('video','user_id')->where('video','!=',null)->where('user_id',$loggedinUser->id)->orderBy('id','desc')->limit(1)->get();
        }
		
		
		$viewgallery = $this->viewPageGalleryList($page_id);
		$cart = []; $profile_posts=[]; $family=[];
        /*if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }*/
		return view('profiles.viewBusinessProfile', [
            'cart' => $cart,
			'company' => $company,
            'claim' =>'Claimed',
			'user_professional_detail' => $user_professional_detail,
			'services' => $services,
			'max_price' => $max_price,
			'min_price' => $min_price,
			'terms' => $terms,
			'business_exp' => $business_exp,
			'business_term' => $business_term,
			'business_spec' => $business_spec,
			'gallery' => $gallery,
			'serviceData' => $serviceData,
			'companyData' => $companyData,
			'servicePrice' => $servicePrice,
			'businessSpec' => $businessSpec,
			'UserProfileDetail' => $UserProfileDetail,
			'page_posts' => $PagePost,
			'family' =>$family,
			'postsave' => $postsave,
			'photos' => $photos,
            'videos' => $videos,
			'viewgallery' => $viewgallery,
        ]);
		//$view = 'profiles.viewBusinessProfile';
		//return view($view);
	}

	public function viewbprofiletimelineofOther($user_name,$id)
	{
		$page_id = $id;
        $loggedinUserid = '';
		$company = CompanyInformation::where('id',$id)->first();
        if($company != ''){
            $loggedinUser = User::where('id',$company->user_id)->first();
            $loggedinUserid = @$loggedinUser->id;
        }
		
		$user_professional_detail = $terms = $business_details = $business_exp = $business_term = $business_spec = $business_service = $business_price = $gallery = [];
        $companyData = $serviceData = $servicePrice = $businessSpec = $services = $max_price = $min_price = [];
        $company['company_images'] = [];
		
		if($company) {
            $userId = $company->user_id;
        
            $business_details = BusinessCompanyDetail::where('cid', $page_id)->get();
            $business_details = isset($business_details[0]) ? $business_details[0] : [];

            $business_exp = BusinessExperience::where('cid', $page_id)->get();
            $business_exp = isset($business_exp[0]) ? $business_exp[0] : [];
            
            $business_term = BusinessTerms::where('cid', $page_id)->get();
            $business_term = isset($business_term[0]) ? $business_term[0] : [];

            $business_spec = BusinessService::where('cid', $page_id)->get();
            $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
       
            $gallery = $this->galleryList($userId);
            
            $serviceData = BusinessServices::where('cid', $page_id)->where('instant_booking', 1)->get();
            if (isset($serviceData)) {
                foreach ($serviceData as $service) {
                    $company = CompanyInformation::where('id', $service['cid'])->get();
                    $company = isset($company[0]) ? $company[0] : [];
                    if(!empty($company)) {
                    	$companyData[$company['id']][] = $company;
                    }

                    $price = BusinessPriceDetails::where('cid', $service['cid'])->get();
                    $price = isset($price[0]) ? $price[0] : [];
                    if(!empty($company)) {
                    	$servicePrice[$company['id']][] = $price;
                    }

                    $business_spec = BusinessService::where('cid', $service['cid'])->get();
                    $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
                    if(!empty($company)) {
                    	$businessSpec[$company['id']][] = $business_spec;
                    }
                }
            }

            if(isset($company['company_images']) && $company['company_images'] != null) {
            	$company['company_images'] = json_decode($company['company_images']);
            }
            $max_price = UserService::where('company_id', $company['id'])->max('price');
            $min_price = UserService::where('company_id', $company['id'])->min('price');

            $user_professional_detail = UserProfessionalDetail::where('company_id', $page_id)->first();
            $terms = [];
            if (!empty($user_professional_detail)) {
                $user_professional_detail->availability = $user_professional_detail->availability != null ? json_decode(json_decode($user_professional_detail->availability)) : null;
                $terms = BusinessTerms::where('userid', $user_professional_detail->user_id)->get();
            }
			$services = UserService::where('company_id', $company['id'])->get();
		    foreach ($services as $key2 => $value2) {
                $sport = Sports::where('id', $value2['sport'])->first();
                $value2['amenties'] = $sport['sport_name'];
            }
        }
		$UserProfileDetail = $this->users->getUserProfileDetail($company['user_id'], array('professional_detail', 'history', 'education', 'certification', 'service'));
		//$PagePost = PagePost::limit(5)->orderBy('id','desc')->get();
		
		$PagePost = PagePost::where('page_id', $page_id)->orderBy('id','desc')->get();
		
		$postsave = PagePostSave::where('user_id',@$loggedinUserid)->orderBy('id','desc')->get();

		$images = PagePost::select('images','user_id')->where('images','!=',null)->where('user_id',$company['user_id'])->orderBy('id','desc')->limit(10)->get();

        $videos = PagePost::select('video','user_id')->where('video','!=',null)->where('user_id',$company['user_id'])->orderBy('id','desc')->get();
       
        $postsavedtab = PagePostSave::where('user_id',$company['user_id'])->orderBy('id','desc')->get();
		$cart = []; $profile_posts=[]; $family=[];
		$viewgallery = $this->viewPageGalleryList($page_id);
		return view('profiles.viewBusinessProfileTimeline', [
            'cart' => $cart,
			'company' => $company,
			'user_professional_detail' => $user_professional_detail,
            'images'=> $images,
            'videos'=> $videos,
            'postsavedtab'=> $postsavedtab,
			'services' => $services,
			'max_price' => $max_price,
			'min_price' => $min_price,
			'terms' => $terms,
			'business_exp' => $business_exp,
			'business_term' => $business_term,
			'business_spec' => $business_spec,
			'gallery' => $gallery,
			'serviceData' => $serviceData,
			'companyData' => $companyData,
			'servicePrice' => $servicePrice,
			'businessSpec' => $businessSpec,
			'UserProfileDetail' => $UserProfileDetail,
			'page_posts' => $PagePost,
			'family' =>$family,
			'postsave' => $postsave,
            'viewgallery' => $viewgallery,
        ]);
	}
	
	public function galleryList($user_id) {
        $galleryPic = [];
        $gallery = DB::select('select id, attachment_name, cover_photo from users_add_attachment where user_id = ? order by id DESC', [$user_id]);
        if (!empty($gallery) && $gallery[0]->id > 0) {
            foreach ($gallery as $pic) {
                $filename = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR . $pic->attachment_name;
                $obj['id'] = $pic->id;
                $obj['cover'] = $pic->cover_photo;
                $obj['name'] = $pic->attachment_name;
                $obj['size'] = @filesize($filename);
                $galleryPic[] = $obj;
            }
        }
        //return Response::json($galleryPic);
        return $galleryPic;
    }

	public function viewPageGalleryList($page_id) {
        $galleryPic = [];
        $gallery = DB::select('select id, attachment_name, cover_photo,user_id from page_attachment where page_id = ? and cover_photo = 1 order by cover_order ASC', [$page_id]);
        if (!empty($gallery) && $gallery[0]->id > 0) {
            foreach ($gallery as $pic) {
                $filename = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'page-cover-photo' . DIRECTORY_SEPARATOR . $pic->attachment_name;
                $obj['id'] = $pic->id;
                $obj['cover'] = $pic->cover_photo;
                $obj['name'] = $pic->attachment_name;
                $obj['user_id'] = $pic->user_id;
                $obj['size'] = @filesize($filename);
                $galleryPic[] = $obj;
            }
        }
        //return Response::json($galleryPic);
        return $galleryPic;
    }

	public function followPage(Request $request) {
		$userid = $request->userid;
		$pageid = $request->pageid;
		$follow_id = 0;
		$followpro = PageLike::create([
        	'pageid' => $pageid,
            'follower_id' => $userid,
        ]);
		if($followpro){
			$noti = Notification::create([
				'user_id' => $pageid,
				'sender_id' => $userid,
				'type' => '1',
				//'notification_type' => '1',
				'status' => 0,
			]);
			$response = array( 'type' => 'success' );
		}
		else{
			$response = array( 'type' => 'fail' );
		}
		return Response::json($response);
	}
	
	public function loadmorepagepostview(Request $request) {
		$page=$request->page;
		$userid=$request->userid;
		$pageid=$request->pageid;
        $limit = 5;
        $offset = $limit * $page;
		$AllFollowing = UserFollow::where('user_id', Auth::user()->id)->get();
		$followingarr=array();
		$followingarr[]=$userid;
		foreach($AllFollowing as $farr)
		{
			$followingarr[]=$farr->follower_id;
		}
	}

	public function Businessact_detail_filter(Request $request){
		$actoffer = $request->actoffer;
		$actloc = $request->actloc;
		$actfilmtype = $request->actfilmtype;
		$actfilgreatfor = $request->actfilgreatfor;
		$actfilparticipant=$request->actfilparticipant;
		$btype = $request->btype;
		$actdate = $request->actdate;
		$serviceid = $request->serviceid;
		$companyid = $request->companyid;
		
		$searchData = DB::table('business_services')->where('business_services.cid', $companyid)->where('business_services.is_active', 1)->where('business_services.id', '!=' , $serviceid);
		if( !empty($actoffer) )
		{
			$searchData->Where('sport_activity', $actoffer);
		}
		
		$activity = $searchData->get()->toArray();
		
		$activity = json_decode(json_encode($activity), true);
		$actbox='';
		if (!empty($activity)) { 
			foreach ($activity as  $act) {
				//echo $act['id'].'--'.$act['program_name'].'<br>';
				//DB::enableQueryLog();
				$servicePrice = BusinessPriceDetails::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
				//dd(\DB::getQueryLog());
				//print_r($servicePrice);
				$pay_session1=''; $pay_price1='';
				if( !empty($servicePrice) )
				{
					if(@$servicePrice[0]['pay_session']!=''){
						$pay_session1 = @$servicePrice[0]['pay_session'];
					}
					if(@$servicePrice[0]['pay_price']!=''){
						$pay_price1 = @$servicePrice[0]['pay_price'];
					}
				}
				$SpotsLeft = UserBookingDetail::where('sport', @$act['id'] )->count();
				if( !empty($act['group_size']) )
					$SpotsLeftdis = $act['group_size']-$SpotsLeft;
				$servicePr = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->toArray();
				$fun_para="'".$act['id']."',this.value,'".@$act['group_size']."','bookajax'";
				$actbox .= '<div class="text-book show-more-height" id="kickboxing'.$act['id'].'">
                    		<div class="row">
                        		<div class="col-md-6 col-lg-6">
                            		<div class="bookinfo-title">
										<h4>'.$act['program_name'].'</h4>
										<div class="bookinfo">
											<h4>Booking Info</h4>
										</div>
										<div class="booking-detail">
											<span>Friday, May 7th, 2021</span>
										</div>
										<div class="booking-detail">
											<span>09:00 am - 10:00 am</span>
										</div>
										<div class="booking-detail">
											<span>Service Type: </span> <span>'.@$act['service_type'].'</span>
										</div>
										<div class="booking-detail">
											<span>Duration: </span> <span>1 hour</span>
										</div>
										<div class="booking-detail">
											<span>Activity Location: </span> <span>'.@$act['activity_location'].'</span>
										</div>	
										<div class="booking-detail">
											<span>Spots Left: </span>
											<span><?php echo $SpotsLeftdis; ?>/'.@$act['group_size'].'</span>
										</div>
										<div class="booking-detail">
											<span>Service For: </span> <span>'.@$act['activity_for'].'</span>
										</div>
										<div class="booking-detail">
											<span>Age: </span> <span>'.@$act['age_range'].'</span>
										</div>
										<div class="booking-detail">
											<span>Language: </span> <span>-</span>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-lg-6">
                            		<div class="price-part">
										<h4>Choose Price Option</h4>
										<select id="selprice'.$act['id'].'" name="selprice'.$act['id'].'" class="price-select-control" onchange="changeactpr('.$fun_para.')">
                                            <option>Select Price Option</option>';
											if (!empty($servicePr)) { 
												foreach ($servicePr as  $pr) {
													$actbox .= '<option value="'.$pr['pay_session'].'~~'.$pr['pay_price'].'">
													'.$pr['pay_session'].' Sessions/$'.$pr['pay_price'].'</option>';
												}
											}
                                        $actbox .= '</select>
										<label>Booking Details</label>
										<div id="bookajax'.@$act["id"].'">
											<p>Price Option: '.$pay_session1 .' Session</p>
											<p>Participants: '.@$act['group_size'].'</p>
											<p>Total: $'.$pay_price1.'/person</p>
										</div>
                                        <form method="post" action="/addtocart">
											<input name="_token" type="hidden" value="'.csrf_token().'">
											<input type="hidden" name="pid" value="'.@$act["id"].'" size="2" />
											<input type="hidden" name="quantity" value="1" class="product-quantity" size="2" />
											<input type="hidden" name="price" id="pricebookajax'.$act['id'].'" value="'.$pay_price1.'" class="product-price" size="2" />
                                        	<input type="submit" value="Add to Cart" class="btn btn-addtocart mt-10" />
                                        </form>
									</div>
                                </div>
									
                            </div>
							<div class="viewmore_links">
                            	<a id="viewmore'.$act['id'].'" style="display:block">View More <img src="public/img/arrow-down.png" alt=""></a>
                                <a id="viewless'.$act['id'].'" style="display:none">View Less <img src="public/img/arrow-down.png" alt=""></a>
                            </div>
                        </div>';
						$actbox .='<script>
							$("#viewmore'.$act['id'].'").click(function () {
								$("#kickboxing'.$act['id'].'").addClass("intro");
								$("#viewless'.$act['id'].'").show();
								$("#viewmore'.$act['id'].'").hide();
							});
						   	$("#viewless'.$act['id'].'").click(function () {
								$("#kickboxing'.$act['id'].'").removeClass("intro");
								$("#viewless'.$act['id'].'").hide();
								$("#viewmore'.$act['id'].'").show();
							});
						</script>';
				
				
			}//for
		}//if
		echo $actbox;
		exit;	
	}
	
	public function save_business_reviews(Request $request)
	{
		$page_id = $request->page_id;
		$rating = $request->rating;
		$review = $request->review;
		$title = $request->rtitle;
		
		$ip=$request->ip();
		$loggedId = Auth::user()->id;
		
		if($page_id!='' && $rating!='' && $review !='')
		{ 
			$chk=BusinessReview::where('user_id',Auth::user()->id)->where('page_id',$page_id)->first();
			if(empty($chk))
			{
				$images=array(); $imgpost='';
				if($request->TotalFiles > 0)
				{
					for ($x = 0; $x < $request->TotalFiles; $x++) 
					{
						if ($request->hasFile('rimg'.$x)) 
						{
							$file = $request->file('rimg'.$x);
							$name = date('His').$file->getClientOriginalName();
							$file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'review'.DIRECTORY_SEPARATOR,$name);
							if( !empty($name) ){
								$images[]=$name;
							}
						}
					}
					$imgpost = implode("|",$images);
				}
				
				$data=array(
				   	"rating"=>$rating,
				   	"title"=>$title,
					"review"=>$review,
					"images"=>$imgpost,
					"user_id" => Auth::user()->id,
					"page_id" => $page_id,
					"ip" => $ip,
				);
				BusinessReview::create($data);
				echo 'submitted';
				exit;
			}
			else
			{
				echo 'already';
				exit;
			}
		}
		else
		{
			echo 'addreview';
			exit;
		}
	}

    public function addbusinesscustomer() {
        return view('business.addbusinesscustomer');
    }

    public function add_business_customer(Request $request)
    {   
       /* print_r($request->all());exit;*/
        $comdata = CompanyInformation::where('dba_business_name' , $request->Companyname)->first();

        if($request->add_status == 'yes'){
            $comdata =  '';
        }
        
        if($comdata != ''){
            $modelbody = '';
            if ($comdata->logo !="") {
                if (file_exists( public_path() . '/uploads/profile_pic/thumb/' . $comdata->logo)) {
                   $profilePic = url('/public/uploads/profile_pic/thumb/' . $comdata->logo);
                }else {
                   $profilePic = url('/public/images/service-nofound.jpg');
                }
            }else{ $profilePic = '/public/images/service-nofound.jpg'; }

            $address = '';
            if($comdata->address != ''){
                $address = $comdata->address.', ';
            }
            if($comdata->city != ''){
                $address .= $comdata->city.', ';
            }
            if($comdata->state != ''){
                $address .= $comdata->state.', ';
            }
            if($comdata->country != ''){
                $address .= $comdata->country.', ';
            }
            if($comdata->zip_code != ''){
                $address .= $comdata->zip_code;
            }
            $redlink = str_replace(" ","-",$comdata->dba_business_name)."/".$comdata->id;
           /* $var = "matched";*/
            $var = '<div class="row">
                            <div class="col-md-4">
                                <div class="modal-imgs">
                                    <img src="'.$profilePic.'">
                                </div>
                            </div>
                            <div class="col-md-6 txt-space">
                                <div class="modal-img-title">
                                    <a href="'.Config::get('constants.SITE_URL') .'/businessprofile/'.$redlink.'">'.$comdata->dba_business_name.'</a>
                                    <p>'.$address.'</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="modal-links">
                                    <a href="'.Config::get('constants.SITE_URL') .'/businessprofile/'.$redlink.'#reviews">Write a Review</a>
                                    <input type="file" name="rimg[]" id="files" class="hidden" multiple="multiple">
                                </div>
                            </div>
                        </div>';
        } else{

            $images=array(); $imgpost='';
            if ($request->hasFile('rimg')) {
                if(count($request->rimg) > 0)
                {
                    foreach($request->rimg as $img){
                        $file = $img;
                       /* echo $file;exit;*/
                        $name = date('His').$file->getClientOriginalName();
                        $name = str_replace(' ', '', $name);
                        $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'review'.DIRECTORY_SEPARATOR,$name);
                        if( !empty($name) ){
                            $images[]=$name;
                        }
                    }
                    $imgpost = implode("|",$images);
                }
            }

            $data['lat'] = $request->lat;
            $data['lon'] = $request->lon;

            $companyData = [
                "user_id" => null,
                "is_verified" => 0,
                "status"=>1,
                "business_added_by_cust_name" =>$request->business_added_by_cust_name,
                "first_name" => $request->Firstnameb,
                "last_name" => '',
                "email" => $request->email,
                "contact_number" => '',
                "logo" =>'',
                "company_name" => $request->Companyname,
                "dba_business_name" => $request->Companyname,
                "address" => $request->Address,
                "state" => $request->State,
                "country" => $request->Country,
                "zip_code" => $request->ZipCode,
                "city" => $request->City,
                "ein_number" => '',
                "establishment_year" => '',
                "business_user_tag" => '',
                "about_company" => $request->Shortdescription,
                "short_description" => '',
                "embed_video" => '',
                "latitude" => $data['lat'],
                "longitude" => $data['lon'],
                'dba_business_name' => $request->Companyname,
                'additional_address' => $request->additional_address,
                'neighborhood' => $request->neighborhood,
                'business_phone' => $request->business_phone,
                'business_email' => $request->business_email,
                'business_website' => $request->business_website,
                'business_type' => $request->business_type,
            ];

            $data = CompanyInformation::create($companyData);

            $businessData = [
                "cid" => $data->id,
                "userid" => null,
                "Companyname" => $request->Companyname,
                "Address" => $request->Address,
                "City" => $request->City,
                "State" => $request->State,
                "ZipCode" => $request->ZipCode,
                "Country" => $request->Country,
                "EINnumber" => '',
                "Businessusername" => '',
                "Profilepic" => '',
                "Firstnameb" => $request->Firstnameb,
                "Lastnameb" => '',
                "Emailb" => $request->email,
                "Phonenumber" => '',
                "Aboutcompany" => $request->Shortdescription,
                "Shortdescription" => '',
                "EmbedVideo" => '',
                "showstep" => 2            
            ];

            BusinessCompanyDetail::create($businessData);

            $ip=$request->ip();

            $createbus_review = array(
                "rating"=>$request->rating,
                "title"=>$request->re_title,
                "review"=>$request->re_detail,
                "images"=> $imgpost,
                "user_id" => Auth::user()->id,
                "page_id" => $data->id,
                "ip" => $ip,
            );

            $bus_re = BusinessReview::create($createbus_review);
            $var = "added";

            $detail_data_com=  [];
            $detail_data_rev =  [];
            $detail_data_user =  [];
            $detail_data_com['company_data'] = CompanyInformation::where('id',$data->id)->first();
            $det_com  = json_decode(json_encode($detail_data_com), true); 

            $detail_data_rev['review'] = BusinessReview::where('id',$bus_re->id)->first();
            $det_rev  = json_decode(json_encode($detail_data_rev), true); 

            $detail_data_user['user'] = User::where('id',Auth::user()->id)->first();
            $det_user  = json_decode(json_encode($detail_data_user), true); 

            $allDetail = array_merge($det_com,$det_rev,$det_user);
            /*print_r($allDetail);exit;*/
            MailService::sendEmailBusinesslist($allDetail);
        }

        echo $var;
        exit;
    } 
}