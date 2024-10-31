<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends BaseResetPasswordNotification
{
    public function toMail($notifiable)
    {
        $url = url('/reset-password/' . $this->token);

        return (new MailMessage)
            ->subject('إعادة تعيين كلمة المرور')
            ->line('لقد تلقينا طلبًا لإعادة تعيين كلمة المرور الخاصة بك.')
            ->action('إعادة تعيين كلمة المرور', $url)
            ->line('إذا لم تطلب إعادة تعيين كلمة المرور، فلا حاجة إلى أي إجراء إضافي.');
    }
}