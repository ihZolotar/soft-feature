<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CasesData
 *
 * @package App\Models
 * @property-read \App\Models\CaseInfo $case
 * @method static \Illuminate\Database\Eloquent\Builder|CasesData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CasesData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CasesData query()
 * @mixin \Eloquent
 */
class CasesData extends Model
{
    /**
     * @var string
     */
    protected $table = 'cases_data';

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'unit',
        'name',
        'value'
    ];

    public function case(): BelongsTo
    {
        return $this->BelongsTo(CaseInfo::class, 'cases_id');
    }
}
