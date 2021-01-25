<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NonexistentCustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'logo' => $this->logo,
            'priority' => $this->priority,
            'tab_priority' => $this->tab_priority,
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
