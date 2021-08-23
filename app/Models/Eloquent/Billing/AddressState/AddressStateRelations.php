<?php

namespace App\Models\Eloquent\Billing\AddressState;

use App\Models\Eloquent\Billing\AddressCity\AddressCity;

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