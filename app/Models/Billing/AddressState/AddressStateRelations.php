<?php

namespace App\Models\Billing\AddressState;

use App\Models\Billing\AddressCity\AddressCity;

trait AddressStateRelations
{
    /**
     * Cities relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function cities()
    {
        return $this->hasMany(AddressCity::class, 'state_id');
    }
}