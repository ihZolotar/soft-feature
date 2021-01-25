<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewNonexistentCustomerResource extends JsonResource
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
            'popup_type' => 'not-designer',
            'title' => $this->title,
            'description' => $this->description,
            'logo' => $this->logo,
            'general_priority' => $this->priority,
            'priority_group' => $this->tab_priority,
            'img' => [
                'desktop' => $this->img,
                'desktop_2x' => $this->img_2x,
                'desktop_webp' => $this->img_webp,
                'mobile' => $this->img_mobile,
                'mobile_webp' => $this->img_mobile_webp
            ]
        ];
    }
}
