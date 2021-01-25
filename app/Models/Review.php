<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Review
 *
 * @package App\Models
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaseCV[] $cases
 * @property-read int|null $cases_count
 * @property-read \App\Models\CaseInfo|null $currentCase
 * @property-read \App\Models\ReviewVideo|null $video
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @mixin \Eloquent
 */
class Review extends Model
{
    /**
     * @var string
     */
    protected $table = 'reviews';

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name',
        'position',
        'description',
        'linkedin',
        'photo',
        'photo_webp',
        'domain',
        'country',
        'duration',
        'budget',
        'summary',
        'priority',
        'country_icon',
        'technology',
        'case_id'
    ];

    public function cases(): BelongsToMany
    {
        return $this->belongsToMany(
            CaseCV::class,
            'case_reviews',
            'review_id',
            'cases_id'
        )->withPivot('priority');
    }

    /**
     * @return HasOne
     */
    public function currentCase()
    {
        return $this->hasOne(CaseInfo::class, 'id', 'case_id');
    }

    /**
     * @return HasOne
     */
    public function video()
    {
        return $this->hasOne(ReviewVideo::class, 'review_id', 'id');
    }
}
