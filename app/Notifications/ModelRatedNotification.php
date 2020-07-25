<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ModelRatedNotification extends Notification
{
    use Queueable;

    private string $rateableName;
    private float $score;
    private string $qualifierName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $qualifierName, string $rateableName, float $score)
    {
        $this->qualifierName = $qualifierName;
        $this->rateableName = $rateableName;
        $this->score = $score;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line("¡{$this->qualifierName} ha calificado tu producto
                    {$this->rateableName}! con {$this->score} estrellas");
    }
}