<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Instrument
 *
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Instrument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Instrument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Instrument query()
 * @mixin \Eloquent
 */
class Instrument extends Model
{
    /**
     * @var string
     */
    protected $table = 'instruments';

    /**
     * @var bool
     */
    public $timestamps = false;
}
