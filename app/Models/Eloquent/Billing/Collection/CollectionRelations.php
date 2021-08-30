<?php

namespace App\Models\Eloquent\Billing\Collection;

use App\Models\Eloquent\Billing\Invoice\Invoice;
use App\Models\Eloquent\Billing\Customer\Customer;
use App\Models\Eloquent\Billing\Biller\Biller;
use App\Models\Eloquent\Billing\PaymentMethod\PaymentMethod;
use App\Models\Eloquent\Billing\CollectionItem\CollectionItem;
use App\Models\Eloquent\Billing\PaymentInterval\PaymentInterval;
use App\Models\Eloquent\Billing\CollectionStatus\CollectionStatus;

trait CollectionRelations
{
    /**
     * Customer relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function customer()
    {
        return $this->hasOneThrough(Customer::class, Biller::class, 'id', 'id', 'biller_id', 'customer_id');
    }

    /**
     * Biller relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function biller()
    {
        return $this->belongsTo(Biller::class, 'biller_id');
    }

    /**
     * Collection Status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(CollectionStatus::class, 'collection_status_id');
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
     * Payment Method relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    /**
     * Invoices relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'collection_id');
    }

    /**
     * Collection Itens relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function itens()
    {
        return $this->hasMany(CollectionItem::class, 'collection_id');
    }
}