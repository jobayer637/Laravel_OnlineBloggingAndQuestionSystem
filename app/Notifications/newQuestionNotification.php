<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newQuestionNotification extends Notification
{
    use Queueable;

    public $que;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($que)
    {
        $this->que=$que;
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
                    ->greeting('Hello subscriber!')
                    ->line('A new question by '.$this->que->user->name)
                    ->line('From online Blogging and Question system')
                    ->line('Question: '.$this->que->title)
                    ->line('Category: '.$this->que->category)
                    ->action('View Question', url(route('question',$this->que->id)))
                    ->line('Thank you for viewing this question!')
                    ->line('Developed by Jobayer hossain');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
