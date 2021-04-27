<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as LaravelCollection;

class Invoice extends Model
{
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
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'collection_id'
    ];

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
     * Invoice itens relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function itens()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }

    /**
     * Return the users authorized to access the invoice.
     *
     * @return LaravelCollection
     */
    public function getAuthorizedUsers(): LaravelCollection
    {
        /** @todo Pegar usuários do customer */
        /** @todo Pegar funcionario administrador */
        /** @todo Pegar funcionario financeiro */
    }
}