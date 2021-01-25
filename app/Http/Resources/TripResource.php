<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
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
            'start' => $this->start,
            'end' => $this->end,
            'title' => $this->title_description,
            'description' => $this->description,
            'person' => $this->person,
            'about_trip' => $this->about_trip,
            'subjects' => $this->subjects,
            'country' => $this->country,
            'country_code' => $this->country_code,
            'photo' => empty(trim($this->photo_links)) ? null : explode(';', $this->photo_links),
            'video' => $this->video_links,
            'video_img' => $this->video_img,
            'coordinates' => $this->coordinates,
            'zoom' => $this->zoom,
            'status' => $this->status,
            'img' => $this->img_link,
        ];
    }
}
