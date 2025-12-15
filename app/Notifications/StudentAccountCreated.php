<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentAccountCreated extends Notification
{
    use Queueable;

    public $password;

    /**
     * Create a new notification instance.
     */
    public function __construct($password)
    {
        $this->password = $password;
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
                    ->subject('Akun Pendaftaran PMB UNU Kaltim Anda Telah Dibuat')
                    ->greeting('Selamat Datang, '.$notifiable->name.'!')
                    ->line('Akun pendaftaran PMB Anda telah berhasil dibuat oleh staf kami.')
                    ->line('Berikut adalah kredensial login Anda:')
                    ->line('**Email:** '.$notifiable->email)
                    ->line('**Password:** '.$this->password)
                    ->action('Login Sekarang', route('login'))
                    ->line('**PENTING:** Harap ubah password Anda setelah login pertama kali untuk keamanan akun Anda.')
                    ->line('Jika Anda memiliki pertanyaan, silakan hubungi kami.')
                    ->salutation('Terima kasih, Tim PMB UNU Kaltim');
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
