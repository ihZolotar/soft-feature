<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class NonexistentCustomersData
 *
 * @package App\Models
 * @property-read \App\Models\NonexistentCustomer $case
 * @method static \Illuminate\Database\Eloquent\Builder|NonexistentCustomersData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NonexistentCustomersData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NonexistentCustomersData query()
 * @mixin \Eloquent
 */
class NonexistentCustomersData extends Model
{
    /**
     * @var string
     */
    protected $table = 'nonexistent_customers_data';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function case(): BelongsTo
    {
        return $this->BelongsTo(NonexistentCustomer::class, 'id', 'cases_id');
    }
}
