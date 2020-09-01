<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewDone extends Notification implements ShouldQueue
{
    use Queueable;
    protected $review;
    protected $method;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($review, $method = "created")
    {
        $this->review = $review;
        $this->method = $method;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $reviewer = $this->review->reviewer;
        $msg = $this->method == "updated"
            ? "{$reviewer->profile->full_name} has updated his review on your account"
            : "{$reviewer->profile->full_name} has created a new review about you";

        return (new MailMessage)
            ->subject("New Review on your Account")
            ->greeting('Hello Agent')
            ->line($msg)
            ->action('View Your Reviews', $this->review->user->received_reviews_link)
            ->line('Thank you for using our application!');
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
            'user_id' => $this->review->user_id,
            'reviewer_id' => $this->review->reviewer_id,
            'system' => $this->method,
            'review_id' => $this->review->id
        ];
    }
}
