<?php

namespace App\Http\Resources;

use App\Notifications\ReviewAlert;
use App\Review;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Notification extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = $this->data;
        $is_new = !$this->read_at;
        $this->markAsRead();
        return [
            'posted' => [
                'date' => $this->created_at->format('M jS, Y'),
                'time' => $this->created_at->format('H:ia'),
            ],
            'new' => $is_new,
            $this->mergeWhen($this->type == ReviewAlert::class, function() use ($data){
                $reviewer = User::find($data['reviewer_id']);
                $user = User::find($data['user_id']);
                $review = Review::find($data['review_id']);
                $system = $data['system'];

                $reviewer_name = $reviewer->profile->full_name;
                switch ($system) {
                    case 'created':
                        $note = "$reviewer_name gave a review about you";
                        $type = "notif-create";
                        break;

                    case 'updated':
                        $note = "$reviewer_name updated his review about you";
                        $type = "notif-update";
                        break;

                    case 'deleted':
                        $note = "$reviewer_name deleted his review of you";
                        $type = "notif-delete";
                        break;

                    default:
                        $note = "";
                        break;
                }
                return [
                    'notif' => $note,
                    'type' => $system
                ];
            })
        ];
        return parent::toArray($request);
    }
}
