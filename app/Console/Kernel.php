<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Birthday;
use App\Mail\BirthdayReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     * This is email schedule for reminding user about upcoming birthday
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            try {
                $dateToCompare = now()->addDays(1)->format('m-d');
                $birthdays = Birthday::whereRaw("DATE_FORMAT(birthdate, '%m-%d') = ?", [$dateToCompare])->get();
                
                foreach ($birthdays as $birthday) {
                    Mail::to($birthday->user->email)->queue(new BirthdayReminderMail($birthday->name));
                }

                Log::info('Birthday reminders sent successfully for date: ' . $dateToCompare);
            } catch (\Exception $e) {
                Log::error('Error sending birthday reminders: ' . $e->getMessage());
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
