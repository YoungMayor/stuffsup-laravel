<?php

namespace App\Events;

use App\Review;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReviewMade
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $review;
    public $method;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Review $review)
    {
        $this->review = $review;
        $this->method = "created";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
