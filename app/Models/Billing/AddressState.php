<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

class AddressState extends Model
{
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

    /**
     * Cities relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function cities()
    {
        return $this->hasMany(AddressCity::class, 'state_id');
    }
}