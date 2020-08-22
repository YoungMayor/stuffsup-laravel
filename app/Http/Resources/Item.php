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
        if (!$this->is_open && !$this->i_am_seller){
            return [
                'sale_closed' => true
            ];
        }

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
            'price' => $this->price,
            'is_public' => $this->is_public,
            $this->mergeWhen(Auth::check(), [
                'new_offer' => $this->create_offer_link
            ]),
            $this->mergeWhen($this->i_am_seller, [
                $this->mergeWhen($this->is_public, [
                    'get_offers' => $this->item_offers_link
                ]),
                $this->mergeWhen($this->is_open, [
                    'terminate' => $this->close_sale_link
                ]),
                $this->mergeWhen(!$this->is_open, [
                    'terminated' => $this->reason_for_close
                ])
            ])
        ];
    }
}
