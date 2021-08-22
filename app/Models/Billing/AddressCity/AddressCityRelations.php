<?php

namespace App\Models\Billing\AddressCity;

use App\Models\Billing\AddressState\AddressState;

trait AddressCityRelations
{
    /**
     * State relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(AddressState::class, 'state_id');
    }
}