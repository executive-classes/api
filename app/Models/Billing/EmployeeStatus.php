<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    /**
     * Status
     */

    public const ACTIVE = 'active';
    public const SUSPENDED = 'suspended';
    public const CANCELED = 'canceled';
    public const INACTIVE = 'inactive';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee_status';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}