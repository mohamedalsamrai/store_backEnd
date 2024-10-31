<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = route('verification.verify', ['id' => $this->user->id, 'hash' => sha1($this->user->email)]);

        return (new MailMessage)
            ->subject('تحقق من بريدك الإلكتروني')
            ->greeting('مرحباً!')
            ->line('نحن سعداء بانضمامك إلينا! يرجى النقر على الزر أدناه لتأكيد بريدك الإلكتروني.')
            ->action('تأكيد البريد الإلكتروني', $url)
            ->line('إذا لم تقم بالتسجيل، يمكنك تجاهل هذه الرسالة.')
            ->salutation('مع تحياتنا، فريق العمل');
    }
}