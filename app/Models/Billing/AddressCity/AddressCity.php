<?php

namespace App\Models\Billing\AddressCity;

use Illuminate\Database\Eloquent\Model;

class AddressCity extends Model
{
    use AddressCityRelations;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_city';

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