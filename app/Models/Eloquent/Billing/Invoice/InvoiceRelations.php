<?php

namespace App\Models\Eloquent\Billing\Invoice;

use App\Models\Eloquent\Billing\InvoiceItem\InvoiceItem;
use App\Models\Eloquent\Billing\Biller\Biller;
use App\Models\Eloquent\Billing\Collection\Collection;
use App\Models\Eloquent\Billing\InvoiceStatus\InvoiceStatus;

trait InvoiceRelations
{
    /**
     * Biller relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function biller()
    {
        return $this->hasOneThrough(Biller::class, Collection::class, 'id', 'id', 'collection_id', 'biller_id');
    }

    /**
     * Collection relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id', 'id');
    }

    /**
     * Status relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(InvoiceStatus::class, 'invoice_status_id', 'id');
    }

    /**
     * Invoice itens relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function itens()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }
}