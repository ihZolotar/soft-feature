<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DesignerCaseDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $subgroup = !empty($this['subgroup']) ? $this->collection($this['subgroup']) : null;
        $additional = !empty($this['additional']) ? $this->collection($this['additional']) : null;

        return [
            'title' => $this['title'] ?? null,
            'description' => $this['description'] ?? null,
            'img' => [
                'desktop' => $this['img_link'] ?? null,
                'desktop_webp' => $this['img_webp_link'] ?? null,
                'desktop_2x' => $this['img_2x_link'] ?? null,
                'desktop_webp_2x' => $this['img_webp_2x_link'] ?? null,
            ],
            $this->mergeWhen((bool)$subgroup, ['subgroup' => $subgroup]),
            $this->mergeWhen((bool)$additional, ['additional' => $additional]),
        ];
    }
}
