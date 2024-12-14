<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use App\{BusinessServices,Customer,BookingCheckinDetails,CompanyInformation,Transaction,Recurring,SGMailService,BusinessStaff,User,UserBookingStatus};
use Auth;
use DB;
use Request as resAll;

class DesignController extends Controller {
	public function orders(Request $request){
        return view('design.order');
	}
	public function add_family_for_customer(Request $request){
        return view('design.add_family_for_customer');
	}
    public function add_family(Request $request){
        return view('design.add_family');
    } 
    public function dashboard(Request $request){
        return view('design.dashboard');
    }
    public function staff_login(Request $request){
        return view('design.staff_login');
    }
    public function createNewBusinessProfile(Request $request){
        return view('design.createNewBusinessProfile');  //d
    }
    public function createNewBusinessProfileone(Request $request){
        return view('design.createNewBusinessProfileone'); //d
    }
    public function createNewBusinessProfiletwo(Request $request){
        return view('design.createNewBusinessProfiletwo'); //d
    }
    public function manage_activity(Request $request){
        return view('design.manage_activity'); //d
    }
    public function manage_booking(Request $request){
        return view('design.manage_booking'); //d
    }
    public function schedule_create(Request $request){
        return view('design.schedule_create'); //d
    }
    public function manage_company(Request $request){
        return view('design.manage_company'); //d
    }
    public function company_setup(Request $request){
        return view('design.company_setup');
    }
    public function checkin_details(Request $request){
        return view('design.checkin_details');
    }
    public function clients(Request $request){
        return view('design.clients');
    }
	public function clientsview(Request $request){
        return view('design.clientsview');
    }
    public function calendar(Request $request){
        return view('design.calendar');
    }
	public function addfamily(Request $request){
        return view('design.addfamily');
    }
	public function manage_staff(Request $request){
        return view('design.manage_staff');
    }
	public function view_staff(Request $request){
        return view('design.view_staff');
    }
	public function manage_product(Request $request){
        return view('design.manage_product');
    }
	public function add_product(Request $request){
        return view('design.add_product');
    }
	public function sales_report(Request $request){
        return view('design.sales_report');
    }
	public function shopping_cart(Request $request){
        return view('design.shopping_cart');
    }
	public function book_multi_times(Request $request){
        return view('design.book_multi_times');
    }
	public function instant_activity_details(Request $request){
        return view('design.instant_activity_details');
    }
	public function member_expirations(Request $request){
        return view('design.member_expirations');
    }
	public function chat_inbox(Request $request){
        return view('design.chat_inbox');
    }
	public function edit_profile(Request $request){
        return view('design.edit_profile');
    }
	public function personal_profile(Request $request){
        return view('design.personal_profile');
    }
	public function provider_profile_calendar(Request $request){
		 $user = User::where('id', Auth::user()->id)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $data = UserBookingStatus::selectRaw('chkdetails.id, ser.program_name as title, ser_sche.shift_start, ser_sche.shift_end, ser_sche.set_duration,chkdetails.checkin_date as start,bdetails.user_id')
                ->join("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                ->join("booking_checkin_details as chkdetails", DB::raw('chkdetails.booking_detail_id'), '=', 'bdetails.id')
                ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                ->join("business_activity_scheduler as ser_sche", DB::raw('ser_sche.id'), '=', 'bdetails.act_schedule_id')
                ->where('user_booking_status.user_id', Auth::user()->id)
                ->get();
        $fullary= [];
        foreach($data as $dt){
            $full_name = "N/A";
            if(@$dt->user_id != ''){
                $customerdata = Customer::where('id',$dt->user_id)->first();
                if($customerdata != ''){
                    $full_name = $customerdata->full_name;
                }
                $full_name = ucwords($full_name);
            }
            if(@$dt->set_duration != ''){
                $tm = explode(' ',$dt->set_duration);
                $hr=''; $min=''; $sec='';
                if($tm[0]!=0){ $hr=$tm[0].' hr '; }
                if($tm[2]!=0){ $min=$tm[2].' min '; }
                if($tm[4]!=0){ $sec=$tm[4].' sec'; }
                if($hr!='' || $min!='' || $sec!='')
                { $time =  $hr.$min.$sec; } 
            }
            $title = $dt['title'];
            $shift_start = $dt['shift_start'];
            $shift_end = $dt['shift_end'];
            $id = $dt['id'];
            $start =  date('Y-m-d').'T'.$dt['shift_start'];
            $end =  date('Y-m-d').'T'.$dt['shift_end'];
            $fullary[] =array(
                "id"=>$id,
                "title"=>$title,
                "shift_start"=>$shift_start,
                "shift_end"=>$shift_end,
                "time"=>$time,
                "start"=>$dt['start'],
                "full_name"=>$full_name);
        }
        return view('design.provider_profile_calendar' ,['fullary'=>$fullary ]);
    }
	public function add_family_provider(Request $request){
        return view('design.add_family_provider');
    }
	public function followers(Request $request){
        return view('design.followers');
    }
	public function following(Request $request){
        return view('design.following');
    }
	public function favorite(Request $request){
        return view('design.favorite');
    }
	public function booking_info(Request $request){
        return view('design.booking_info');
    }
	public function price_plan(Request $request){
        return view('design.price_plan');
    }
	public function payment_info(Request $request){
        return view('design.payment_info');
    }
	public function booking_details(Request $request){
        return view('design.booking_details');
    }
	public function creditcard_info(Request $request){
        return view('design.creditcard_info');
    }
	public function o_card_info(Request $request){
        return view('design.o_card_info');
    }
	public function o_payment_info(Request $request){
        return view('design.o_payment_info');
    }
	public function providers_onboarded(Request $request){
        return view('design.providers_onboarded');
    }
	public function onboarded_steps(Request $request){
        return view('design.onboarded_steps');
    }
	public function home(Request $request){
        return view('design.home');
    }
	public function reports(Request $request){
        return view('design.reports');
    }
	public function settings(Request $request){
        return view('design.settings');
    }
	public function subscriptions_payments(Request $request){
        return view('design.subscriptions_payments');
    }
	public function documents_contracts(Request $request){
        return view('design.documents_contracts');
    }
	public function invoice_details(Request $request){
        return view('design.invoice_details');
    }
	public function announcement_news(Request $request){
        return view('design.announcement_news');
    }
	public function task(Request $request){
        return view('design.task');
    }
	public function attendance_belt(Request $request){
        return view('design.attendance_belt');
    }
	public function announcements_provider(Request $request){
        return view('design.announcements_provider');
    }
	public function announcements_provider_category(Request $request){
        return view('design.announcements_provider_category');
    }
	public function customer_dashboard(Request $request){
        return view('design.customer_dashboard');
    }
	public function notes_alerts(Request $request){
        return view('design.notes_alerts');
    }
	public function pdf_booking(Request $request){
        return view('design.pdf_booking');
    }
    public function provider_adds_belt_rank_skills(Request $request){
        return view('design.provider_adds_belt_rank_skills');
    }
    public function provider_edit_belt_rank_skills(Request $request){
        return view('design.provider_edit_belt_rank_skills');
    }
    public function client_promote_belt(Request $request){
        return view('design.client_promote_belt');
    }
    public function manually_promote(Request $request){
        return view('design.manually_promote');
    }
    public function register_ep(Request $request){
        return view('design.register_ep');
    }
    public function check_in_settings(Request $request){
        return view('design.check_in_settings');
    }
    public function check_in_portal(Request $request){
        return view('design.check_in_portal');
    }
    public function task_list(Request $request){
        return view('design.task_list');
    }
    public function integration_portal(Request $request){
        return view('design.integration_portal');
    }
    public function registration_widget(Request $request){
        return view('design.registration_widget');
    }
    public function schedule_widget(Request $request){
        return view('design.schedule_widget');
    }
    public function deploy_widget(Request $request){
        return view('design.deploy_widget');
    }
    public function confirmation(Request $request){
        return view('design.confirmation');
    }
    public function selfcheck_in_welcome(Request $request){
        return view('design.selfcheck_in_welcome');
    }
    public function engage_clients(Request $request){
        return view('design.engage_clients');
    }
    public function engage_clients_sidebar(Request $request){
        return view('design.engage_clients_sidebar');
    }
    public function customer_contact_list(Request $request){
        return view('design.customer_contact_list');
    }
    public function gift_card(Request $request){
        return view('design.gift_card');
    }
    public function manage_gift_card(Request $request){
        return view('design.manage_gift_card');
    }
    public function automation_campaigns(Request $request){
        return view('design.automation_campaigns');
    }
    public function alerts_details(Request $request){
        return view('design.alerts_details');
    }
    public function email_blast(Request $request){
        return view('design.email_blast');
    }
    public function email_blast_step1(Request $request){
        return view('design.email_blast_step1');
    }
    public function email_blast_step2(Request $request){
        return view('design.email_blast_step2');
    }
    public function email_blast_blanktemp(Request $request){
        return view('design.email_blast_blanktemp');
    }
    public function email_blast_temp2(Request $request){
        return view('design.email_blast_temp2');
    }
    public function email_blast_temp3(Request $request){
        return view('design.email_blast_temp3');
    }
    public function email_blast_temp4(Request $request){
        return view('design.email_blast_temp4');
    }
    public function email_blast_schedule(Request $request){
        return view('design.email_blast_schedule');
    }
    public function email_blast_temp5(Request $request){
        return view('design.email_blast_temp5');
    }
    public function email_blast_temp6(Request $request){
        return view('design.email_blast_temp6');
    }
    public function email_blast_temp7(Request $request){
        return view('design.email_blast_temp7');
    }
    public function email_blast_temp8(Request $request){
        return view('design.email_blast_temp8');
    }
    public function email_blast_temp9(Request $request){
        return view('design.email_blast_temp9');
    }
    public function email_blast_temp10(Request $request){
        return view('design.email_blast_temp10');
    }
    public function email_blast_temp11(Request $request){
        return view('design.email_blast_temp11');
    }
    public function email_blast_temp12(Request $request){
        return view('design.email_blast_temp12');
    }
    public function email_blast_temp13(Request $request){
        return view('design.email_blast_temp13');
    }
    public function email_blast_temp14(Request $request){
        return view('design.email_blast_temp14');
    }
    public function email_blast_temp15(Request $request){
        return view('design.email_blast_temp15');
    }
    public function email_blast_temp16(Request $request){
        return view('design.email_blast_temp16');
    }
    public function email_blast_temp17(Request $request){
        return view('design.email_blast_temp17');
    }
    public function online_profile_post(Request $request){
        return view('design.online_profile_post');
    }
    public function manage_services(Request $request){
        return view('design.manage_services');
    }
    public function manage_services_sidebar(Request $request){
        return view('design.manage_services_sidebar');
    }
    public function bookings_appointments_sidebar(Request $request){
        return view('design.bookings_appointments_sidebar');
    }
    public function appointments_booking_history(Request $request){
        return view('design.appointments_booking_history');
    }
    public function bookings_appointments_scheduler(Request $request){
        return view('design.bookings_appointments_scheduler');
    }
    public function bookings_appointments_calendar(Request $request){
        return view('design.bookings_appointments_calendar');
    }
    public function bookings_appointments(Request $request){
        return view('design.bookings_appointments');
    }
    public function marketplace(Request $request){
        return view('design.marketplace');
    }
}