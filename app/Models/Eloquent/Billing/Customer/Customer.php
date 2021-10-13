<?php

namespace App\Models\Eloquent\Billing\Customer;

use App\Traits\Models\HasFactory;
use App\Traits\Models\Billing\HasTax;
use App\Support\QueryFilter\Filterable;
use App\Traits\Models\Billing\HasPhone;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Billing\CustomerStatusEnum;

class Customer extends Model
{
    use CustomerRelations;
    use Filterable;
    use HasFactory;
    use HasTax;
    use HasPhone;
    
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_status_id',
        'name',
        'tax_type_id',
        'tax_code',
        'tax_type_alt_id',
        'tax_code_alt',
        'address_id',
        'email',
        'phone',
        'phone_alt'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'customer_status_id' => CustomerStatusEnum::ACTIVE,
    ];
}