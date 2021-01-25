<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CasesFeatureData
 *
 * @package App\Models
 * @property-read \App\Models\CaseInfo $case
 * @method static \Illuminate\Database\Eloquent\Builder|CasesFeatureData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CasesFeatureData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CasesFeatureData query()
 * @mixin \Eloquent
 */
class CasesFeatureData extends Model
{
    /**
     * @var string
     */
    protected $table = 'cases_feature_data';

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'value',
        'value_descriptio'
    ];

    public function case(): BelongsTo
    {
        return $this->BelongsTo(CaseInfo::class, 'cases_id');
    }

}
