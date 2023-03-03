<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\UserBookingDetail;
use App\Recurring;

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
