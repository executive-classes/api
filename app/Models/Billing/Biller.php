<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'biller';

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
        'inactive_at',
        'reactive_at'
    ];

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
     * Biller Status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(BillerStatus::class, 'biller_status_id');
    }

    /**
     * Building relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
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