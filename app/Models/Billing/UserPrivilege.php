<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    /**
     * Auth privileges.
     */
    const CROSS_AUTH = 'auth:cross';

    /**
     * Message privileges.
     */
    const MESSAGE_GET    = 'message:get';
    const MESSAGE_CREATE = 'message:create';
    const MESSAGE_CANCEL = 'message:cancel';
    const MESSAGE_DELETE = 'message:delete';

    /**
     * Message template privileges
     */

    const MESSAGE_TEMPLATE_GET    = 'message_template:get';
    const MESSAGE_TEMPLATE_CREATE = 'message_template:create';
    const MESSAGE_TEMPLATE_UPDATE = 'message_template:update';
    const MESSAGE_TEMPLATE_DELETE = 'message_template:delete';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_privilege';

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
     * Privilege roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'role_x_privilege', 'user_privilege_id', 'user_role_id');
    }
}

