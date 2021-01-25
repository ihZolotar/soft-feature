<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'country' => $this['country'],
            'city' => $this['city'],
            'coordinates' => is_array($this['coordinates']) ? implode(",", $this['coordinates']) : $this['coordinates'],
            'is_capital' => $this['is_capital'],
        ];
    }
}
