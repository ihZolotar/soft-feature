<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeStaffResource extends JsonResource
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
            'name' => $this['name'],
            'alt' => $this['alt'],
            'specialization' => $this['specialization'],
            'link_social_network' => $this['link_social_network'],
            'img' => [
                'desktop' => $this['photo'],
                'desktop_small' => $this['small_photo'],
                'desktop_small_webp' => $this['small_photo_webp']
            ]
        ];
    }
}
