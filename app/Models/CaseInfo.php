<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CaseInfo
 *
 * @package App\Models
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CasesArticle[] $articles
 * @property-read int|null $articles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaseCV[] $cvs
 * @property-read int|null $cvs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CasesData[] $datas
 * @property-read int|null $datas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CasesFeatureData[] $features
 * @property-read int|null $features_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Instrument[] $instuments
 * @property-read int|null $instuments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @method static \Illuminate\Database\Eloquent\Builder|CaseInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseInfo query()
 * @mixin \Eloquent
 */
class CaseInfo extends Model
{
    /**
     * @var string
     */
    protected $table = 'cases';

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name',
        'title',
        'title_description',
        'feature_title',
        'about_project',
        'solution',
        'results',
        'hd_img',
        'meta_title',
        'meta_description',
        'icon',
        'video',
        'video_img'
    ];

    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(
            Review::class,
            'case_reviews',
            'cases_id',
            'review_id'
        )->withPivot('priority');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(CasesArticle::class, 'cases_id');
    }

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(
            Customer::class,
            'cases_customers',
            'case_id',
            'customer_id'
        )->withPivot('priority');
    }

    public function instuments(): BelongsToMany
    {
        return $this->belongsToMany(
            Instrument::class,
            'case_instrument',
            'cases_id',
            'instrument_id'
        );
    }

    public function datas()
    {
        return $this->hasMany(CasesData::class, 'cases_id');
    }

    public function features()
    {
        return $this->hasMany(CasesFeatureData::class, 'cases_id');
    }

    public function cvs()
    {
        return $this->hasMany(CaseCV::class, 'cases_id');
    }
}
