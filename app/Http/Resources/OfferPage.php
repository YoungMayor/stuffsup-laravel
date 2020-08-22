<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class OfferPage extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'item' => [
                'title' => $this->item->title,
                'link' => $this->item->item_link
            ],
            'author' => [
                'name' => $this->user->profile->full_name,
                'link' => $this->user->user_link,
                'avatar' => $this->user->profile->avatar_url
            ],
            'posted' => [
                'date' => $this->created_at->format('M jS, Y'),
                'time' => $this->created_at->format('H:ia'),
            ],
            'offer' => $this->offer,
            'closed' => $this->closed,
            $this->mergeWhen(!$this->closed, [
                'get_replies' => $this->offer_replies_link,
                $this->mergeWhen(Auth::check(), [
                    'new_reply' => $this->create_reply_link
                ])
            ]),
            $this->mergeWhen($this->item->i_am_seller, [
                $this->mergeWhen($this->closed, [
                    'terminated' => $this->reason_for_close,
                    'get_replies' => $this->offer_replies_link,
                ]),
                $this->mergeWhen(!$this->closed, [
                    'terminate' => $this->close_offer_link,
                ])
            ])
        ];
    }
}
