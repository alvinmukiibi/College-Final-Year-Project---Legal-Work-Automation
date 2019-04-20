<?php

namespace App\Console;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Mail\RemindersMail;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Proceeding;
use App\LegalCase_Staff;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // we want to check all messages in the db and if there are unread messages and the recipients are offline, we send them an email to inform them that they have n unread direct messages on the system
        $schedule->call(function(){
            $users = DB::table('replies')->where(['status' => 'unread'])->select('recipient_id')->distinct()->get();
            foreach($users as $user){
                $user_data = User::where(['account_status' => 'active', 'id' => $user->recipient_id])->first();
                $count = DB::table('replies')->where(['recipient_id' => $user->recipient_id, 'status' => 'unread'])->get()->count();
                $msg = "Hello " . $user_data->fname . ", you have " . $count . " unread messages on your L-WAT account";
                Mail::to($user_data->email)->send(new RemindersMail($msg));
            }
        })->weekdays()->twiceDaily(9, 12)->timezone('Africa/Nairobi'); //test is everyMinute()

        // we want to check from the proceedings table, all next proceeding dates to see which are still in the future,
        // then for each, check if we are exactly a day earlier, send reminder to case members

        $schedule->call(function(){
            $proceedings = DB::table('proceedings')->where('date_of_next_proceeding', '>', date('Y-m-d'))->get();
            foreach ($proceedings as $proceeding) {
                $cur_date = date("Y-m-d H:i");
                $timestamp = strtotime($cur_date);
                $diff_in_secs = strtotime($proceeding->date_of_next_proceeding) - $timestamp;
                $diff_in_days = $diff_in_secs / 86400;
                if($diff_in_days <= 1){
                    //fetch all email addresses of people on case and email them a reminder
                    $caseStaff = new LegalCase_Staff;
                    $caseStaff->id = $proceeding->case_id;
                    $myRecipients = $caseStaff->getAllStaffonCase();
                    $msg = "Hello bro";
                    foreach($myRecipients as $recipient){
                        foreach($recipient as $rec){
                            Mail::to($rec->email)->send(new RemindersMail($msg));
                        }
                    }
                }
            }
        })->everyMinute();
        $schedule->call(function(){



        })->everyMinute();

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
