<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Item extends JsonResource
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
                'location' => $location->location
            ];
        }

        $images = [];
        foreach ($this->images as $image) {
            $images[] = $image->image_meta;
        }
        return [
            'title' => $this->title,
            'description' => substr($this->description, 0, 128),
            'images' => $images,
            'phone' => $this->phone,
            'posted' => [
                'date' => $this->created_at->format('M jS, Y'),
                'time' => $this->created_at->format('H:ia'),
            ],
            'locations' => $locations,
            'seller' => [
                'name' => $this->seller->profile->full_name,
                'link' => $this->seller->user_link
                #User Link not yet built
                # @todo Build User Profile Page
            ],
            'is_public' => $this->is_public,
            $this->mergeWhen(Auth::check(), [
                'new_offer' => $this->create_offer_link
            ]),
            $this->mergeWhen(Auth::check() && ($this->is_public || $this->i_am_seller), [
                'get_offers' => $this->item_offers_link
            ])
        ];
    }
}
