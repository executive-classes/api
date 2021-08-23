<?php

namespace App\Models\Eloquent\Billing\Address;

use App\Support\QueryFilter\Filterable;
use App\Traits\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use AddressRelations;
    use AddressMutators;
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
}
