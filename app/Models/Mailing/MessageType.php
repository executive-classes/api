<?php

namespace App\Models\Mailing;

use Illuminate\Database\Eloquent\Model;

class MessageType extends Model
{
    /**
     * Message Types
     */

    public const BILLING = 'billing';
    public const WARNING = 'warning';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_type';

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
     * @var string[]
     */
    protected $fillable = [];
}
