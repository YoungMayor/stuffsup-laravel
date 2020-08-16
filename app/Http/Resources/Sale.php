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
            'image_count' => $this->images()->count(),
            'phone' => $this->phone,
            'posted' => [
                'date' => $this->created_at->format('M jS, Y'),
                'time' => $this->created_at->format('H:ia'),
            ],
            'locations' => $locations,
            'seller' => [
                'name' => $this->seller->profile->full_name,
                'link' => '#'
                #User Link not yet built
                # @todo Build User Profile Page
            ],
            'link' => '#',
            $this->mergeWhen($this->is_public, [
                'offers' => 12
            ]),
            $this->mergeWhen(Auth::check(), [
                'quick' => '#'
                # Offer system not yet built
                # @todo build offers system
            ])
        ];
    }
}
