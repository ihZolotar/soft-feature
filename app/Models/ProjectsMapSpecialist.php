<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectsMapSpecialist
 *
 * @package App\Models
 * @property-read \App\Models\ProjectsMap $projects
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectsMapSpecialist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectsMapSpecialist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectsMapSpecialist query()
 * @mixin \Eloquent
 */
class ProjectsMapSpecialist extends Model
{
    /**
     * @var string
     */
    protected $table = 'projects_map_specialists';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the project associated with the specialist.
     */
    public function projects()
    {
        return $this->belongsTo(ProjectsMap::class, 'id', 'projects_id');
    }
}
