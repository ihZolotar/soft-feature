<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewDesignerCustomerResource extends JsonResource
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
            'popup_type' => empty($this->popup_id) ? 'designer' : 'custom',
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'cases_id' => $this->cases_id,
            'general_priority' => $this->general_priority,
            'priority_group' => $this->priority_group,
            'country' => $this->country,
            'country_code' => $this->country_code,
            'popup_id' => $this->popup_id,
            'logo' => $this->customer->logo,
            'cooperation_time' => $this->customer->cooperation_time,
            'domain' => $this->customer->domains,
            'img' => [
                'desktop' => $this->img,
                'desktop_webp' => $this->img_webp,
                'mobile' => $this->img_mobile,
                'mobile_webp' => $this->img_mobile_webp
            ],
        ];
    }
}
