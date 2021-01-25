<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OfficeCustomer
 * @package App\Models
 */
class OfficeCustomer extends Model
{
    /**
     * @var string
     */
    protected $table = 'offices_customer';

    /**
     * @var bool
     */
    public $timestamps = false;

    public function customers()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
