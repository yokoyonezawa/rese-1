<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Reservation;
use App\Notifications\ReservationReminder;
use Carbon\Carbon;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
protected function schedule(Schedule $schedule)
{
    // 予約当日の予約を取得
    $schedule->call(function () {
        $reservations = Reservation::whereDate('date', Carbon::today()->format('Y-m-d'))
                            ->where('time', '>=', Carbon::now()->format('H:i'))
                            ->get();

        foreach ($reservations as $reservation) {
            $reservation->user->notify(new ReservationReminder($reservation)); // ユーザーに通知
        }
    })->dailyAt('08:00'); // 毎朝8時に実行
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
