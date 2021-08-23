<?php

namespace App\Models\Eloquent\Billing\AddressState;

use Illuminate\Database\Eloquent\Model;

class AddressState extends Model
{
    use AddressStateRelations;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_state';

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
    protected $fillable = [];

}