<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

class PaymentInterval extends Model
{
    /**
     * Intervals
     */

    public const MENSAL = 1;
    public const BIMESTRAL = 2;
    public const TRIMESTRAL = 3;
    public const SEMESTRAL = 6;
    public const ANUAL = 12;
    public const BIANUAL = 24;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_interval';

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
    protected $keyType = 'int';
    
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
    protected $guarded = [];
}