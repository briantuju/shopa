<?php

namespace App\Notifications\Auth;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueuedVerifyEmail extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    //    /**
    //     * Get the mail representation of the notification.
    //     */
    //    public function toMail($notifiable): MailMessage
    //    {
    //        // For custom mail message, e.g. with frontend url
    //        /*$prefix = config('customconfig.app.frontend_url').'/auth/verify-email?url=';
    //        $verificationUrl = URL::temporarySignedRoute(
    //            'api.auth.email.verify',
    //            now()->addHours(2),
    //            ['user_id' => $notifiable->getKey()],
    //            false
    //        );
    //        // $verificationUrl = $this->verificationUrl($notifiable);
    //
    //        return (new MailMessage)
    //            ->greeting('Hello '.$notifiable->name.',')
    //            ->subject(Lang::get('Verify Email Address'))
    //            ->line(Lang::get('Please click the button below to verify your email address.'))
    //            ->action(Lang::get('Verify Email Address'), $prefix.$verificationUrl)
    //            ->line(Lang::get('If you did not create an account, no further action is required.'));*/
    //    }
}
