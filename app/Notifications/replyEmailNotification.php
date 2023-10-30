<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class replyEmailNotification extends Notification
{
    use Queueable;
    private $dataNotifEmail;

    /**
     * Create a new notification instance.
     */
    public function __construct($dataNotifEmail)
    {
        $this->dataNotifEmail = $dataNotifEmail;
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

            ->subject($this->dataNotifEmail['subject'])
            ->greeting('Halo, ' . $this->dataNotifEmail['nama_lengkap'])
            ->line($this->dataNotifEmail['content'])
            ->action('Lihat permohonan', route('detailPermohonan', Crypt::encrypt($this->dataNotifEmail['permohonan_id'])))
            ->line('Balasan permohonan: ' . $this->dataNotifEmail['balasan'])
            ->line('Terima kasih atas permohonan Anda,')
            ->salutation($this->dataNotifEmail['daskrimti_name']);
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
