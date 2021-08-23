<?php

namespace App\Models\Eloquent\Billing\AddressCity;

use App\Models\Eloquent\Billing\AddressState\AddressState;

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