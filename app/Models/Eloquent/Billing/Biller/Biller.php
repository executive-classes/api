<?php

namespace App\Models\Eloquent\Billing\Biller;

use App\Support\QueryFilter\Filterable;
use App\Models\Eloquent\Billing\Biller\BillerRelations;
use App\Traits\Models\Billing\HasPhone;
use App\Traits\Models\Billing\HasTax;
use App\Traits\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{
    use BillerRelations;
    use Filterable;
    use HasFactory;
    use HasTax;
    use HasPhone;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'biller_status_id',
        'name',
        'tax_type_id',
        'tax_code',
        'tax_type_alt_id',
        'tax_code_alt',
        'address_id',
        'email',
        'phone',
        'phone_alt',
        'payment_interval_id',
        'payment_method_id'
    ];

}