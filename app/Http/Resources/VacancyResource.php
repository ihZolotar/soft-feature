<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
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
            'title' => $this['title'],
            'project_guid' => $this['ProjektGUID'],
            'distant_work' => $this['DistantWork'],
            'presentation_url' => $this['PresentationURL'],
            'location' => $this['location'],
            'technologies' => $this['technologies'],
            'is_hot' => $this['isHot'],
            'description' => $this['description'],
            'requirements' => $this['requirements'],
            'nice_to_have' => $this['niceToHave'],
            'we_offer' => $this['weOffer'],
            'opening_date' => $this['requirements'],
            'hr' => $this['hr'],
            'client_languages' => $this['ClientLanguages'],
            'client_points' => $this['ClientPoints'],
            'project_statistics' => $this['ProjectStatistics'],
            'tech_key' => $this['tech_key'],
        ];
    }
}
