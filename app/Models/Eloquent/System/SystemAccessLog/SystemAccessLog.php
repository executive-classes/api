<?php

namespace App\Models\Eloquent\System\SystemAccessLog;

use App\Traits\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemAccessLog extends Model
{
    use SystemAccessLogRelations;
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'system_accesslog';

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
        'date',
        'user_id',
        'cross_user_id',
        'agent',
        'method',
        'url',
        'route',
        'ajax',
        'allowed',
        'code'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ajax' => 'boolean',
        'allowed' => 'boolean'
    ];
}