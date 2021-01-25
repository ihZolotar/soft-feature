<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImportOfficeResource extends JsonResource
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
            "employees" => $this['qSotrAll'],
            "projects" => $this['qprojectall'],
            "ongoing_projects" => $this['qprojectTec'],
            "closed_projects" => $this['qprojectZac'],
            "offices_info" => ImportOfficeDataResource::collection($this['Office']),
        ];
    }
}
