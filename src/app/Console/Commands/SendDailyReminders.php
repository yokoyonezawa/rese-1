<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\ReservationReminder;
use Carbon\Carbon;

class SendDailyReminders extends Command
{
    protected $signature = 'send:daily-reminders';
    protected $description = 'Send daily reservation reminders to users';

    public function handle()
    {
        $today = Carbon::today(); // 今日の日付を取得

        // 当日の予約を取得
        $reservations = Reservation::whereDate('date', $today)
                            ->where('time', '>=', Carbon::now()->format('H:i'))
                            ->get();

        // ユーザーごとに予約情報をグループ化
        $reservations->groupBy('user_id')->each(function ($userReservations, $userId) {
            $user = User::find($userId);

            if ($user) {
                // ユーザーにリマインダー通知を送信
                $user->notify(new ReservationReminder($userReservations));
            }
        });

        $this->info('Daily reminders sent successfully.');
    }
}
