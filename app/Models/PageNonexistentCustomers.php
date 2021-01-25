<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PageNonexistentCustomers
 *
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|PageNonexistentCustomers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageNonexistentCustomers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageNonexistentCustomers query()
 * @mixin \Eloquent
 */
class PageNonexistentCustomers extends Model
{
    /**
     * @var string
     */
    protected $table = 'page_nonexistent_customers';

    protected $fillable = [
        'page',
        'nonexistent_customers_id',
        'priority'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
