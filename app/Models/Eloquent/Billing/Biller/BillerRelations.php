<?php

namespace App\Models\Eloquent\Billing\Biller;

use App\Models\Eloquent\Billing\Student\Student;
use App\Models\Eloquent\Billing\TaxType\TaxType;
use App\Models\Eloquent\Billing\Customer\Customer;
use App\Models\Eloquent\Billing\Collection\Collection;
use App\Models\Eloquent\Billing\BillerStatus\BillerStatus;
use App\Models\Eloquent\Billing\PaymentMethod\PaymentMethod;
use App\Models\Eloquent\Billing\Address\Address;
use App\Models\Eloquent\Billing\PaymentInterval\PaymentInterval;

trait BillerRelations
{
    /**
     * Customer relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Tax Type relation.
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
     * Biller Status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(BillerStatus::class, 'biller_status_id');
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
     * Payment Method relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    /**
     * Payment Interval relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interval()
    {
        return $this->belongsTo(PaymentInterval::class, 'payment_interval_id');
    }

    /**
     * Students relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'biller_id');
    }

    /**
     * Collections relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function collections()
    {
        return $this->hasMany(Collection::class, 'biller_id');
    }
}