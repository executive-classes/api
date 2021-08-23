<?php

namespace App\Models\Eloquent\General\Category;

use App\Support\QueryFilter\Filterable;
use App\Traits\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CategoryRelations;
    use Filterable;
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

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
        'name',
        'description',
        'category_type_id',
        'parent_id'
    ];
}