<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    /**
     * General privileges.
     */
    public const ALL = '*';

    /**
     * Auth privileges.
     */
    public const CROSS_AUTH = 'auth:cross';

    /**
     * Message privileges.
     */
    public const MESSAGE_GET    = 'message:get';
    public const MESSAGE_CREATE = 'message:create';
    public const MESSAGE_CANCEL = 'message:cancel';
    public const MESSAGE_DELETE = 'message:delete';

    /**
     * Message template privileges
     */

    public const MESSAGE_TEMPLATE_GET    = 'message_template:get';
    public const MESSAGE_TEMPLATE_CREATE = 'message_template:create';
    public const MESSAGE_TEMPLATE_UPDATE = 'message_template:update';
    public const MESSAGE_TEMPLATE_DELETE = 'message_template:delete';

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'teacher_can' => 'boolean',
        'student_can' => 'boolean'
    ];
}

