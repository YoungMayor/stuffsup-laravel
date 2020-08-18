<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Offer extends JsonResource
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
            'from' => [
                'name' => $this->user->profile->full_name,
                'link' => $this->user->user_link,
                'avatar' => $this->user->profile->avatar_url
            ],
            'posted' => [
                'date' => $this->created_at->format('M jS, Y'),
                'time' => $this->created_at->format('H:ia'),
            ],
            'offer' => $this->offer,
            'link' => $this->offer_link,
            'responses' => '12',
            'closed' => $this->closed,
            $this->mergeWhen($this->i_am_seller && $this->closed, function(){
                return [
                    'reason' => $this->reason_for_close
                ];
            })
        ];
        return parent::toArray($request);
    }
}
