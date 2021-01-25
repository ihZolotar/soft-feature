<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaseCV
 *
 * @package App\Model
 * @method static \Illuminate\Database\Eloquent\Builder|CaseCV newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseCV newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseCV query()
 * @mixin \Eloquent
 */
class CaseCV extends Model
{
    /**
     * @var string
     */
    protected $table = 'case_cv';

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'link'
    ];
}
