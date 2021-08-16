<?php

namespace App\Models\Billing;

use App\Traits\Models\Billing\HasPayGo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    use HasPayGo;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'collection';

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
        'expire_at',
        'amount',
        'description',
        'truncatedDescription',
        'payment_interval_id',
        'payment_method_id',
        'token_id'
    ];

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