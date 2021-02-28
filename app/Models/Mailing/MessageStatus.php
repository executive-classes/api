<?php

namespace App\Models\Mailing;

use Illuminate\Database\Eloquent\Model;

class MessageStatus extends Model
{
    /**
     * Message Status
     */
    public const SENT = 'sent';
    public const SCHEDULED = 'scheduled';
    public const CANCELED = 'canceled';
    public const ERROR = 'error';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_status';

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
