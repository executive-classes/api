<?php

namespace App\Models\Eloquent\Billing\Address;

use App\Models\Eloquent\Billing\Biller\Biller;
use App\Models\Eloquent\Billing\Customer\Customer;
use App\Models\Eloquent\Billing\AddressCountry\AddressCountry;

trait AddressRelations
{
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
    
}