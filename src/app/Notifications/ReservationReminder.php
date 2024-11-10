<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Notifications\Notification as NotificationContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;


class ReservationReminder extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail']; // メールで通知
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('ご予約いただいたレストランのリマインダーです。')
                    ->line('店舗名: ' . $this->reservation->shop->name)
                    ->line('日時: ' . $this->reservation->date . ' ' . $this->reservation->time)
                    ->line('ご来店お待ちしております。')
                    ->action('予約詳細', route('mypage', ['reservation' => $this->reservation->id])); // 予約IDを渡す
    }
}