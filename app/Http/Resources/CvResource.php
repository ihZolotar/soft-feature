<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CvResource extends JsonResource
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
            'photo' => $this->photo,
            'name' => $this->name,
            'position' => $this->position,
            'experience' => $this->experience,
            'project' => $this->projects,
            'summary' => $this->summary,
            'pdf' => $this->pdf,
            'link_social_network' => $this->link_social_network,
        ];
    }
}
