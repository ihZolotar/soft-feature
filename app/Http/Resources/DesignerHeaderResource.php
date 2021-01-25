<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DesignerHeaderResource extends JsonResource
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
            'img' => [
                'desktop' => $this->desktop_img,
                'desktop_2x' => $this->desktop_img_2x,
                'desktop_webp' => $this->desktop_img_webp,
                'desktop_webp_2x' => $this->desktop_img_2x_webp,
                'mobile' => $this->mobile_img,
                'mobile_webp' => $this->mobile_img_webp,
            ],
            'content' => [
                'case-id' => $this->id,
                'popup_id' => $this->popup_id,
                'title' => $this->title,
                'description' => trans('app.' . $this->intro_description),
                'country' => $this->country,
                'cooperation_time' => $this->customer->cooperation_time ?? null,
                'domain' => $this->customer->domains ?? null,
                'country_code' => $this->country_code,
            ]
        ];
    }
}
