<?php

namespace App\Listeners;

use App\Events\ReviewMade;
use App\Notifications\ReviewDone;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReviewNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReviewMade  $event
     * @return void
     */
    public function handle($event)
    {
        $recipient = $event->review->user;
        $reviewer = $event->review->reviewer;

        $recipient->notify(new ReviewDone($event->review, $event->method));
    }
}
