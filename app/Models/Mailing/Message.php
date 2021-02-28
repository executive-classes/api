<?php

namespace App\Models\Mailing;

use App\Traits\Models\Mailing\MessageVerifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use MessageVerifications, HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
    protected $guarded = [
        'id',
        'created_at',
        'sent_at'
    ];

    /**
     * Message status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(MessageStatus::class, 'message_status_id');
    }

    /**
     * Message type relation by the message template.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function type()
    {
        return $this->hasOneThrough(MessageType::class, MessageTemplate::class);
    }

    /**
     * Message template relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function template()
    {
        return $this->belongsTo(MessageTemplate::class, 'message_template_id', 'id');
    }
}
