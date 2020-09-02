<?php

namespace App\Observers;

use App\Notifications\ReviewAlert;
use App\Review;

class ReviewObserver
{
    public $recipient, $reviewer;

    public function __construct(Review $review)
    {
        $this->recipient = $review->user;
        $this->reviewer = $review->reviewer;
    }
    /**
     * Handle the review "created" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
        $recipient = $review->user;
        $reviewer = $review->reviewer;

        $msg = <<<MSG_
Agent {$reviewer->profile->full_name} has just submitted a review about you
MSG_;

        $recipient->notify(new ReviewAlert($review, 'created', $msg));

    }

    /**
     * Handle the review "updated" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
        $recipient = $review->user;
        $reviewer = $review->reviewer;

        $msg = <<<MSG_
Agent {$reviewer->profile->full_name} has has modified his review about you
MSG_;

        $recipient->notify(new ReviewAlert($review, 'updated', $msg));
    }

    /**
     * Handle the review "deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        $recipient = $review->user;
        $reviewer = $review->reviewer;

        $msg = <<<MSG_
Agent {$reviewer->profile->full_name} has has removed his review about you
MSG_;

        $recipient->notify(new ReviewAlert($review, 'deleted', $msg));
    }

    /**
     * Handle the review "restored" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function restored(Review $review)
    {
        //
    }

    /**
     * Handle the review "force deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function forceDeleted(Review $review)
    {
        //
    }
}
