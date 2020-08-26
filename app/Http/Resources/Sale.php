<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Sale extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $locations = [];
        foreach ($this->locations as $location) {
            $locations[] = [
                'state' => $location->state_name,
                'region' => $location->location
            ];
        }
        return [
            'title' => $this->title,
            'desc' => substr($this->description, 0, 128),
            'image' => $this->main_image['links']['preview'],
            'image_count' => $this->images_count,
            'phone' => $this->phone,
            'posted' => [
                'date' => $this->created_at->format('M jS, Y'),
                'time' => $this->created_at->format('H:ia'),
            ],
            'locations' => $locations,
            'seller' => [
                'name' => $this->seller->profile->full_name,
                'link' => $this->seller->user_link
            ],
            'price' => $this->price,
            'link' => $this->item_link,
            'offers' => $this->offers_count,
            'public' => $this->is_public,
            $this->mergeWhen(Auth::check(), [
                'quick' => $this->create_offer_link
            ])
        ];
    }
}
