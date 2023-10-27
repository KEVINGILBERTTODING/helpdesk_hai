<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class EmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($data): MailMessage
    {
        return (new MailMessage)
            ->subject('Reset Kata Sandi')
            ->line('Jika Anda menerima email ini, berarti Anda sedang berusaha untuk mengganti kata sandi akun Anda')
            ->action('klik tautan berikut', route('reset_password', Crypt::encrypt($data['user_id'])))
            ->line('Jika Anda tidak merasa melakukan tindakan ini, hiraukan saja pesan ini.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
