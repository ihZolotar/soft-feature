<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class ReviewVideo
 *
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewVideo query()
 * @mixin \Eloquent
 */
class ReviewVideo extends Model
{
    /**
     * @var string
     */
    protected $table = 'reviews_video';

    /**
     * @var bool
     */
    public $timestamps = false;
}
