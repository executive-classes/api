<?php

namespace App\Models\Billing\Customer;

use App\Support\QueryFilter\Filterable;
use App\Traits\Models\Billing\HasPhone;
use App\Traits\Models\Billing\HasTax;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}