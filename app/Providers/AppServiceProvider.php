<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Auth\Notifications\VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Verifikasi Alamat Email Anda')
                ->greeting('Halo!')
                ->line('Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda.')
                ->action('Verifikasi Alamat Email', $url)
                ->line('Jika Anda tidak membuat akun ini, tidak ada tindakan lebih lanjut yang diperlukan.');
        });

        \Illuminate\Auth\Notifications\ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Notifikasi Reset Password')
                ->greeting('Halo!')
                ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.')
                ->action('Reset Password', route('password.reset', $token . '?email=' . urlencode($notifiable->email)))
                ->line('Link reset password ini akan kadaluarsa dalam 60 menit.')
                ->line('Jika Anda tidak meminta reset password, abaikan email ini.');
        });
    }
}
