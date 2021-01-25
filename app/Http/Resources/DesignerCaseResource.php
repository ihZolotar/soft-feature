<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DesignerCaseResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'cases_id' => $this->cases_id,
            'general_priority' => $this->general_priority,
            'country' => $this->country,
            'priority_group' => $this->priority_group,
            'country_code' => $this->country_code,
            'popup_id' => $this->popup_id,
            'img' => [
                'desktop' => $this->img,
                'desktop_webp' => $this->img_webp,
                'mobile' => $this->img_mobile,
                'mobile_webp' => $this->img_mobile_webp
            ],
            'customer' => [
                'logo' => $this->customer->logo,
                'cooperation_time' => $this->customer->cooperation_time,
                'domain' => $this->customer->domains,
            ]
        ];
    }
}
