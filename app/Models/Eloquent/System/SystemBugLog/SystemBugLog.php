<?php

namespace App\Models\Eloquent\System\SystemBugLog;

use App\Support\QueryFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class SystemBugLog extends Model
{
    use SystemBugLogRelations;
    use Filterable;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'system_buglog';

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
        'url',
        'method',
        'ajax',
        'app_id',
        'route',
        'data',
        'error'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ajax' => 'boolean',
        'data' => 'object',
        'error' => 'object'
    ];
}