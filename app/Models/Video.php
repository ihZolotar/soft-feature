<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Video
 *
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video query()
 * @mixin \Eloquent
 */
class Video extends Model
{
    /**
     * @var string
     */
    protected $table = 'video';

    /**
     * @var bool
     */
    public $timestamps = false;
}
