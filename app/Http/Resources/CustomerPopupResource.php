<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerPopupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'team' => $this->team,
            'team_description' => $this->team_description,
            'logo' => $this->logo,
            'link' => $this->link,
            'img' => [
                'desktop' => $this->big_image,
                'mobile' => $this->small_image,
                'card' => $this->card_image,
            ],
        ];
    }
}
