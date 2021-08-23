<?php

namespace App\Models\Eloquent\Billing\CollectionItem;

use App\Traits\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionItem extends Model
{
    use CollectionItemRelations;
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'collection_item';

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
        'amount'
    ];
}