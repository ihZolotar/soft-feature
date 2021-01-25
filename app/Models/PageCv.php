<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PageCv
 *
 * @package App\Models
 * @property-read \App\Models\CvData|null $resume
 * @method static \Illuminate\Database\Eloquent\Builder|PageCv newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageCv newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageCv query()
 * @mixin \Eloquent
 */
class PageCv extends Model
{
    /**
     * @var string
     */
    protected $table = 'page_cv';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resume()
    {
        return $this->hasOne(CvData::class, 'id', 'cv_data_id');
    }
}
