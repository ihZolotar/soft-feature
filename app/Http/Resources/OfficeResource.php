<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
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
            'average' => $this['average'],
            'name' => $this['name'],
            'about' => $this['about'],
            'country_demonstrate' => $this['country_demonstrate'],
            'meta_description' => $this['meta_description'],
            'virtual_tour' => $this['virtual_tour'],
            'stick' => $this['stick'],
            'priority' => $this['priority'],
            'bonuses' => $this['bonuses'],
            'location' => $this['location'],
            'head' => new OfficeStaffResource($this['head']),
            'hr' => new OfficeStaffResource($this['hr']),
            'promo_img' => [
                'desktop' => $this['promo_bg'],
                'desktop_webp' => $this['promo_bg_webp'],
                'mobile' => $this['promo_bg_mobile'],
                'mobile_webp' => $this['promo_bg_mobile_webp'],
            ],
            'small_img' => [
                'desktop' => $this['small_image'],
                'desktop_webp' => $this['small_image_webp'],
            ],
        ];
    }
}
