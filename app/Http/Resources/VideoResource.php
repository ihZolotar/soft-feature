<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'group' => $this->group,
            'link' => $this->link,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'priority' => $this->priority,
            'img' => [
                'desktop' => $this->big_image,
                'desktop_webp' => $this->small_image,
                'mobile' => $this->small_image,
                'mobile_webp' => $this->small_image_webp,
            ],
        ];
    }
}
