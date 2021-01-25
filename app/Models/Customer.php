<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Customer
 *
 * @package App\Models
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaseInfo[] $cases
 * @property-read int|null $cases_count
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @mixin \Eloquent
 */
class Customer extends Model
{
    /**
     * @var string
     */
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'description',
        'technology',
        'team',
        'team_description',
        'cooperation_time',
        'logo',
        'big_image',
        'small_image',
        'card_image',
        'link',
        'placeholder',
        'domain'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function cases(): BelongsToMany
    {
        return $this->belongsToMany(
            CaseInfo::class,
            'cases_customers',
            'customer_id',
            'case_id'
        );
    }

}
