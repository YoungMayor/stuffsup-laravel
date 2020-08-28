<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Reply extends JsonResource
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
            'reply' => $this->reply,
            $this->mergeWhen($this->i_am_author, function(){
                return [
                    'edit' => $this->edit_reply_link,
                    'delete' => $this->delete_reply_link
                ];
            })
        ];
        return parent::toArray($request);
    }
}
