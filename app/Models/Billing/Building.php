<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'building';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    /**
     * Customer relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function customer()
    {
        return $this->hasOne(Customer::class, 'bulding_id');
    }

    /**
     * Biller relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function biller()
    {
        return $this->hasOne(Biller::class, 'building_id');
    }
}
