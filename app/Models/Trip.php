<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trip
 *
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Trip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip query()
 * @mixin \Eloquent
 */
class Trip extends Model
{
    const DEFAULT_IMAGE_HEADER = 'header-holder-businessTrip-bg.jpg';

    /**
     * @var string
     */
    protected $table = 'trips';

    /**
     * @var bool
     */
    public $timestamps = false;
}
