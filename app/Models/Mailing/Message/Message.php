<?php

namespace App\Models\Mailing\Message;

use App\Models\Mailing\Message\MessageRelations;
use App\Traits\Models\Mailing\MessageVerifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use MessageRelations;
    use MessageVerifications;
    use HasFactory;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'should_proccess_at',
        'message_status_id',
        'reply_to',
        'to',
        'cc',
        'bcc',
        'subject',
        'content',
        'message_template_id',
        'params',
        'retries',
        'error_message'
    ];
}