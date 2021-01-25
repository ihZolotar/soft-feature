<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectsMap
 *
 * @package App\Models
 * @property-read \App\Models\ProjectsMapSpecialist|null $specialists
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectsMapTeam[] $team
 * @property-read int|null $team_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectsMap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectsMap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectsMap query()
 * @mixin \Eloquent
 */
class ProjectsMap extends Model
{
    /**
     * @var string
     */
    protected $table = 'projects_map';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function specialists()
    {
        return $this->hasOne(ProjectsMapSpecialist::class, 'projects_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function team()
    {
        return $this->hasMany(ProjectsMapTeam::class, 'projects_id', 'id');
    }
}
