<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\{UserBookingDetail,Recurring};
use DB;

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
            $user_booking_details = UserBookingDetail::whereRaw("transfer_provider_status is NULL or transfer_provider_status !='paid'");

            foreach($user_booking_details->get() as $user_booking_detail){
                $user_booking_detail->transfer_to_provider();
            }
        })->everyTenMinutes();

        $schedule->call(function () {
            $recurringDetails = Recurring::whereDate('payment_date' ,'=', date('Y-m-d'))->where('stripe_payment_id' ,'=' ,'')->where('status','Scheduled')->get();
            foreach($recurringDetails as $recurringDetail){
                $recurringDetail->createRecurringPayment();
            }
        })->everyMinute();

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
           /* print_r($userBookingDetails);exit;*/
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
       // $schedule->command('stripe:cron')->everyMinute()->appendOutputTo('/storage/logs/getlogContent.log'));

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
