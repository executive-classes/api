<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

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

    /**
     * Parent relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(EmployeePosition::class, 'parent_id', 'id');
    }

    /**
     * Children relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function children()
    {
        return $this->hasMany(EmployeePosition::class, 'parent_id', 'id');
    }
}