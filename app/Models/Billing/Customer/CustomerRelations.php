<?php

namespace App\Models\Billing\Customer;

use App\Models\Billing\Student\Student;
use App\Models\Billing\TaxType\TaxType;
use App\Models\Billing\Biller\Biller;
use App\Models\Billing\Address\Address;
use App\Models\Billing\CustomerStatus\CustomerStatus;

trait CustomerRelations
{
    /**
     * Tax type relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxType()
    {
        return $this->belongsTo(TaxType::class, 'tax_type_id');
    }

    /**
     * Tax type relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxTypeAlt()
    {
        return $this->belongsTo(TaxType::class, 'tax_type_alt_id');
    }

    /**
     * Customer Status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(CustomerStatus::class, 'customer_status_id');
    }

    /**
     * Address relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    /**
     * Biller relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function billers()
    {
        return $this->hasMany(Biller::class, 'customer_id');
    }

    /**
     * Students relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'customer_id');
    }
}