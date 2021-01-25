<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImportOfficeDataResource extends JsonResource
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
            "name" => $this['OfficeName'],
            "id" => $this['OfficeID'],
            "employees" => $this['QSotrOffice'],
            "projects" => $this['QProjOffice'],
        ];
    }
}
