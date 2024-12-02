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

    protected $reservations;

    public function __construct($reservations) // 配列またはコレクションを受け取る
    {
        $this->reservations = $reservations; // 当日の予約情報を保存
    }

    public function via($notifiable)
    {
        return ['mail']; // メールで通知
    }

    public function toMail($notifiable)
    {
        // メールの初期設定
        $mail = (new MailMessage)
                ->greeting('こんにちは！')
                ->line('以下はご予約いただいた内容のリマインダーです。');

        // $reservationsがコレクションの場合、ループして情報を追加
        foreach ($this->reservations as $reservation) {
            // 予約日のフォーマット
            $formattedDate = $reservation->date->format('Y年m月d日');  // 例: 2024年12月31日
            // 予約時間のフォーマット（timeカラムをDateTimeオブジェクトとしてフォーマット）
            $formattedTime = $reservation->time; // 例: 17:00

            // メールに予約情報を追加
            $mail->line('店舗名: ' . $reservation->shop->name)
                ->line('予約日: ' . $formattedDate)
                ->line('予約時間: ' . $formattedTime)
                ->line('人数: ' . $reservation->number . '名')
                ->line(''); // 空行を追加
        }

        $mail->line('ご来店をお待ちしております！');
        return $mail;
    }
}
