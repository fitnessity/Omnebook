<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\{UserBookingDetail,Recurring,Transaction,BookingCheckinDetails,CustomerPlanDetails,StripePaymentMethod,Announcement};
use DB;
use Carbon\Carbon;
use Stripe\Exception\InvalidRequestException;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\StripeCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('stripe:cron')->everyMinute();
        $schedule->call(function () {
            // var_dump('run transfer');
            $user_booking_details = UserBookingDetail::whereRaw("transfer_provider_status is NULL or transfer_provider_status !='paid'");
            foreach($user_booking_details->get() as $user_booking_detail){
                try {
                    $user_booking_detail->transfer_to_provider();
                }catch (Exception $e) {
                    $errormsg = $e->getError()->message;
                    var_dump('run transfer error');
                    var_dump($errormsg);
                }
            }
        })->daily();

        $schedule->call(function () {
            $recurringDetails = Recurring::whereDate('payment_date' ,'<=', date('Y-m-d'))->where('stripe_payment_id' ,'=' ,'')->where('status','!=','Completed')->where('attempt' ,'<' ,3)->orderBy('created_at','desc')->get();
            
            /*print_r($recurringDetails);exit();*/
            foreach($recurringDetails as $recurringDetail){
                $recurringDetail->createRecurringPayment();
            }
        })->daily();

        $schedule->call(function () {
            $userBookingDetails = UserBookingDetail::whereDate("expired_at", ">=" ,date('Y-m-d'))->get();
            foreach($userBookingDetails as $userBookingDetail){
                $userBookingDetail->membershipOrSessionAboutToExpireAlert('membership');
            }
        })->daily();

        $schedule->call(function () {
            $userBookingDetails = UserBookingDetail::select('user_booking_details.*', DB::raw('COUNT(booking_checkin_details.use_session_amount) as checkin_count') )->join('booking_checkin_details', 'user_booking_details.id', '=', 'booking_checkin_details.booking_detail_id')
            ->groupBy('user_booking_details.id')
            ->havingRaw('(user_booking_details.pay_session - checkin_count) between 0 and 2')
            ->whereDate('user_booking_details.expired_at', '>=', date('Y-m-d'))->get();
            //print_r($userBookingDetails);exit;
            foreach($userBookingDetails as $userBookingDetail){
                $userBookingDetail->membershipOrSessionAboutToExpireAlert('session');
            }
        })->daily();
        
        $schedule->call(function () {
            $userBookingDetails = UserBookingDetail::whereDate("expired_at", "=" ,date('Y-m-d'))->get();
            foreach($userBookingDetails as $userBookingDetail){
                $userBookingDetail->membershipExpiredAlert('membership');
            }
        })->daily();

        $schedule->call(function () {
            var_dump('run capture');
            $transactions = Transaction::where(['status' => 'requires_capture'])->get();
            foreach($transactions as $transaction){
                try {
                    $transaction->capture();
                }catch (InvalidRequestException $e) {
                    // Handle Stripe's InvalidRequestException
                    var_dump(response()->json(['error' => 'Invalid request: ' . $e->getMessage()], 400));
                } catch (\Exception $e) {
                    // Handle other exceptions
                    var_dump(response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500));
                }
            }
        })->daily();

        $schedule->call(function () {
            $today = Carbon::now()->format('Y-m-d');
            $checkinDateFiveDaysAfter = Carbon::now()->addDays(5)->format('Y-m-d');
            $checkinDateDayBefore = Carbon::now()->addDay()->format('Y-m-d');
            $checkinData = BookingCheckinDetails::whereDate('checkin_date', $checkinDateFiveDaysAfter)
                ->orWhereDate('checkin_date', $checkinDateDayBefore)
                ->orWhereDate('checkin_date', $today)
                ->get();
            foreach($checkinData as $cid){
                $cid->reminderaboutReservation();
            }
        })->daily();

        $schedule->call(function () {
            $today = Carbon::now()->format('Y-m-d');
            $autoPaymentUserDetails = CustomerPlanDetails::whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')->from('customer_plan_details')->groupBy('user_id');
            })->where('amount',0)->where('expire_date','<',date('Y-m-d'))->get();

            foreach($autoPaymentUserDetails as $d){
                $d->autoPayment();
            }
        })->daily();


        $schedule->call(function (){
            $expiredCreditCards = StripePaymentMethod::where(function ($query) {
                $query->where('exp_year', '<', Carbon::now()->year)->where('mail_status',0)
                    ->orWhere(function ($query) {
                        $query->where('exp_year', '=', Carbon::now()->year)
                            ->where('exp_month', '<', Carbon::now()->month)->where('mail_status',0);
                    });
            })->get();
            foreach($expiredCreditCards as $ecc){
                $ecc->checkExpiredCard();
            }
        })->daily();

        $schedule->call(function (){
            $expiringCreditCards = StripePaymentMethod::where('exp_year', '=', Carbon::now()->year)->where('exp_month', '=', Carbon::now()->month)->get();
            //print_r($expiringCreditCards);exit;
            foreach($expiringCreditCards as $ecc){
                $ecc->checkExpiringCard();
            }
        })->daily();

        $schedule->call(function (){
            $current_time = now()->format('H:i');
            $current_date = now()->format('Y-m-d');
            $announcements = Announcement::where('delivery_method_email' ,1)->whereDate('announcement_date' , '=' , $current_date)->whereRaw("announcement_time = '$current_time'")->get();
           // print_r($announcements);exit;
            foreach($announcements as $a){
                $a->sendAnnouncementMail();
            }
        })->everyMinute();

    }

    protected function scheduleTimezone()
    {
        return 'America/New_York';
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
