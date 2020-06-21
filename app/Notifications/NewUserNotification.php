<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;
  
    /**
     * Create a new notification instance.
     *
     * @return void
     */
     private $message;
    public function __construct($message)
    {
        $this->message = $message;
    }
    public function via($notifiable)
        {
            return ['database'];
        }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return[

          'message'=>$this->message
        ];
    }
}
