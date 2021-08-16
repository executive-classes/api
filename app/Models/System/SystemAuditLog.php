<?php

namespace App\Models\System;

use App\Models\Billing\User;
use Illuminate\Database\Eloquent\Model;

class SystemAuditLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'system_auditlog';

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
        'relations',
        'agent',
        'method',
        'url',
        'route',
        'ajax',
        'type',
        'table',
        'before',
        'after'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ajax' => 'boolean',
        'before' => 'object',
        'after' => 'object'
    ];

    /**
     * User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cross_user()
    {
        return $this->belongsTo(User::class, 'cross_user_id');
    }
}