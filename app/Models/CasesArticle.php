<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CasesArticle
 *
 * @package App\Models
 * @property-read \App\Models\CaseInfo $case
 * @method static \Illuminate\Database\Eloquent\Builder|CasesArticle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CasesArticle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CasesArticle query()
 * @mixin \Eloquent
 */
class CasesArticle extends Model
{
    /**
     * @var string
     */
    protected $table = 'cases_article';

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'article'
    ];

    public function case(): BelongsTo
    {
        return $this->BelongsTo(CaseInfo::class, 'cases_id');
    }

}
