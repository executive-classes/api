<?php

namespace App\Models\Eloquent\Billing\InvoiceItem;

use App\Models\Eloquent\Billing\Student\Student;
use App\Models\Eloquent\Billing\Invoice\Invoice;
use App\Models\Eloquent\Billing\Collection\Collection;

trait InvoiceItemRelations
{
    /**
     * Collection relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function collection()
    {
        return $this->hasOneThrough(Collection::class, Invoice::class, 'id', 'id', 'invoice_id', 'collection_id');
    }

    /**
     * Invoice relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    /**
     * Student relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}