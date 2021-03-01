<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    /**
     * Positions
     */

    public const ADMINISTRATOR = 'administrator';
    public const FINANCIAL = 'financial';
    public const DEVELOPER = 'developer';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee_position';

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

    /**
     * Privileges relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function privileges()
    {
        return $this->belongsToMany(UserPrivilege::class, 'privilege_x_position', 'position_id', 'privilege_id');
    }

    /**
     * Employees relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'employee_position_id');
    }
}