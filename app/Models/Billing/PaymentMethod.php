<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /**
     * Payment Methods
     */

    public const CREDIT_CARD = 'credit_card';
    public const BOLETO = 'boleto';
    public const PIX = 'pix';
    public const DEPOSIT = 'deposit';
    public const TRANSFER = 'transfer';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_method';

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
}