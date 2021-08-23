<?php

namespace App\Models\Eloquent\Billing\Invoice;

use App\Traits\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use InvoiceRelations;
    use InvoiceFunctions;
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoice';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_status_id',
        'xml',
        'receipt',
        'error_message'
    ];
}