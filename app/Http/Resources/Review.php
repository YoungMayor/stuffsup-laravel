<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Review extends JsonResource
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
                'name' => $this->reviewer->profile->full_name,
                'link' => $this->reviewer->user_link,
                'avatar' => $this->reviewer->profile->avatar_url
            ],
            'posted' => [
                'date' => $this->created_at->format('M jS, Y'),
                'time' => $this->created_at->format('H:ia'),
            ],
            'review' => $this->review,
            'rating' => $this->rating,
            $this->mergeWhen($this->i_am_author, function(){
                return [
                    'edit' => $this->edit_review_link,
                    'delete' => $this->delete_review_link
                ];
            })
        ];
        return parent::toArray($request);
    }
}
