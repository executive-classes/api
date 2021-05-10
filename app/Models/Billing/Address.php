<?php

namespace App\Models\Billing;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use Filterable;
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address';

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
        return $this->hasOne(Biller::class, 'address_id');
    }

    /**
     * Zip attribute mutator.
     *
     * @param string $value
     * @return void
     */
    public function setZipAttribute(string $value)
    {
        $this->attributes['zip'] = preg_replace('/-/', '', $value);
    }
}
