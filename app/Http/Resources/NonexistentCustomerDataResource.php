<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class NonexistentCustomerDataResource
 * @package App\Http\Resources
 */
class NonexistentCustomerDataResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'first_about_project' => $this->first_about_project,
            'second_about_project' => $this->second_about_project,
            'technical_solution' => $this->technical_solution,
            'project_results' => $this->project_results,
            'type' => $this->type,
            'app_functionality' => $this->app_functionality,
            'app_functionality_title' => $this->app_functionality_title,
            'img' => [
                'desktop' => $this->vc_img,
                'desktop_2x' => $this->vc_img_2x,
                'mobile' => $this->vc_img_mobile,
            ],
            'groups' => $this->data,
            'review' => $this->review,
        ];
    }
}
