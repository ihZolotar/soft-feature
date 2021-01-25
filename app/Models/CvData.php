<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CvData
 *
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|CvData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CvData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CvData query()
 * @mixin \Eloquent
 */
class CvData extends Model
{
    /**
     * @var string
     */
    protected $table = 'cv_data';

    /**
     * @var bool
     */
    public $timestamps = false;
}
