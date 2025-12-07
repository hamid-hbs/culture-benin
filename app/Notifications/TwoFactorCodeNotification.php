<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TwoFactorCodeNotification extends Notification
{
    use Queueable;

    public $code;
    public $expiresAt;

    public function __construct($code, $expiresAt)
    {
        $this->code = $code;
        $this->expiresAt = $expiresAt;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre code de vérification')
            ->line("Votre code de vérification est : {$this->code}")
            ->line("Il expirera à {$this->expiresAt->format('H:i')}.");
    }
}
