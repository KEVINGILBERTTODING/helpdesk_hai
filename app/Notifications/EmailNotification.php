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
    private $dataUser;

    /**
     * Create a new notification instance.
     */
    public function __construct($dataUser)
    {
        $this->dataUser = $dataUser;
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
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Halo, ' . $this->dataUser['name'])
            ->subject('Reset Kata Sandi')
            ->line('Jika Anda menerima email ini, berarti Anda sedang berusaha untuk mengganti kata sandi akun Anda. Klik tombol dibawah ini untuk mereset kata sandi akun Anda.')
            ->action('klik tautan berikut', route('reset_password', Crypt::encrypt($this->dataUser['user_id'])))
            ->line('Abaikan jika Anda merasa tidak melakukan aksi ini.')
            ->salutation('Terima kasih');
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
