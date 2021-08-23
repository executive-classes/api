<?php

namespace App\Models\Eloquent\Billing\Collection;

use App\Traits\Models\Billing\HasPayGo;
use App\Traits\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use CollectionRelations;
    use HasFactory;
    use HasPayGo;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'collection';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expire_at',
        'amount',
        'description',
        'truncatedDescription',
        'payment_interval_id',
        'payment_method_id',
        'token_id'
    ];
}