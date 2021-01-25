<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'id' => $this->reviews->id,
            'name' => $this->reviews->name,
            'position' => $this->reviews->position,
            'description' => $this->reviews->description,
            'linkedin' => $this->reviews->linkedin,
            'domain' => $this->reviews->domain,
            'country' => $this->reviews->country,
            'duration' => $this->reviews->duration,
            'budget' => $this->reviews->budget,
            'summary' => $this->reviews->summary,
            'technology' => $this->reviews->technology,
            'case_id' => $this->reviews->case_id,
            'team_size' => $this->reviews->team_size,
            'clutch_link' => $this->reviews->clutch_link,
            'photo' => $this->reviews->photo,
            'photo_webp' => $this->reviews->photo_webp,
            'country_icon' => $this->reviews->country_icon,
            'video' => $this->video,
            'case_url' => empty($this->reviews->currentCase->name) ? null
                : '/our-projects/' . $this->reviews->currentCase->name,
        ];
    }
}
