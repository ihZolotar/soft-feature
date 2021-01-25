<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectsMapTeam
 *
 * @package App\Models
 * @property-read \App\Models\ProjectsMap $projects
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectsMapTeam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectsMapTeam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectsMapTeam query()
 * @mixin \Eloquent
 */
class ProjectsMapTeam extends Model
{
    /**
     * @var string
     */
    protected $table = 'projects_map_team';

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
