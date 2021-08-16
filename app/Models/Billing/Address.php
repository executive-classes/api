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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zip',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'country'
    ];

    /**
     * Customer relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function customer()
    {
        return $this->hasOne(Customer::class, 'address_id');
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
     * Country relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function countryModel()
    {
        return $this->belongsTo(AddressCountry::class, 'country', 'short_name');
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
