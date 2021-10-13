<?php

namespace App\Models\Eloquent\Billing\Employee;

use App\Enums\Billing\EmployeeStatusEnum;
use App\Support\QueryFilter\Filterable;
use App\Traits\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use EmployeeRelations;
    use EmployeeScopes;
    use Filterable;
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee';

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
        'employee_status_id',
        'employee_position_id'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'employee_status_id' => EmployeeStatusEnum::ACTIVE,
    ];
}