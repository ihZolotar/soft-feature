<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectMapResource extends JsonResource
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
            'id' => $this['id'],
            'name' => $this['name'],
            'type' => $this['type_project'],
            'country_code' => $this['country_short'],
            'description' => $this['description'],
            'employee' => $this['project_team'],
            'domain' => $this['domain'],
            'country' => $this['country_name'],
            'technology' => $this['technology'],
            'city' => $this['city'],
            'progress_status' => $this['progress_status'],
            'budget' => $this['budget'],
            'duration' => $this['duration'],
            'specialists' => $this['specialists'],
            'team' => empty($this['team']) ? null : $this['team'],
        ];
    }
}
