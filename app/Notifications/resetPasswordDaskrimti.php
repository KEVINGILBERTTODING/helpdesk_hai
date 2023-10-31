<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class resetPasswordDaskrimti extends Notification
{
    use Queueable;
    private $dataDaskrimti;

    /**
     * Create a new notification instance.
     */
    public function __construct($dataDaskrimti)
    {
        $this->dataDaskrimti = $dataDaskrimti;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Halo, ' . $this->dataDaskrimti['name'])
            ->subject('Reset Kata Sandi')
            ->line('Jika Anda menerima email ini, berarti Anda sedang berusaha untuk mengganti kata sandi akun Anda. Klik tombol dibawah ini untuk mereset kata sandi akun Anda.')
            ->action('klik tautan berikut', route('reset_password', Crypt::encrypt($this->dataDaskrimti['daskrimti_id'])))
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
