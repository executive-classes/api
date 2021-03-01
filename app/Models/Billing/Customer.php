<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The model's default values for attributes.
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
     * Tax type relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxType()
    {
        return $this->belongsTo(TaxType::class, 'tax_type_id');
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
     * Building relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
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