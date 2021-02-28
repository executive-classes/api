<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * Roles
     */
    
    public const ADMIN = 'admin';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_role';

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
     * Role privileges.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function privileges()
    {
        return $this->belongsToMany(UserPrivilege::class, 'role_x_privilege', 'user_role_id', 'user_privilege_id');
    }
}

