<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class NonexistentCustomer
 *
 * @package App\Models
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\NonexistentCustomersData[] $data
 * @property-read int|null $data_count
 * @property-read \App\Models\Review $review
 * @method static \Illuminate\Database\Eloquent\Builder|NonexistentCustomer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NonexistentCustomer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NonexistentCustomer query()
 * @mixin \Eloquent
 */
class NonexistentCustomer extends Model
{
    /**
     * @var string
     */
    protected $table = 'nonexistent_customers';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function data()
    {
        return $this->hasMany(NonexistentCustomersData::class, 'cases_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function review(): BelongsTo
    {
        return $this->BelongsTo(Review::class, 'review_id', 'id');
    }
}
