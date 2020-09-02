<?php

namespace App\Notifications;

use App\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewAlert extends Notification
{
    use Queueable;
    protected $review, $method, $msg;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Review $review, $method, $msg)
    {
        $this->review = $review;
        $this->method = $method;
        $this->msg = $msg;
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
        return (new MailMessage)
                    ->subject('Review Action on your account')
                    ->greeting("Hello Agent {$this->review->user->profile->full_name}")
                    ->line($this->msg)
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
            'review_id' => $this->review->id,
            'user_id' => $this->review->user_id,
            'reviewer_id' => $this->review->reviewer_id,
            'system' => $this->method,
        ];
    }
}
