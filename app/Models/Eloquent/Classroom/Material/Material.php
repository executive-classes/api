<?php

namespace App\Models\Eloquent\Classroom\Material;

use App\Models\Eloquent\Classroom\Material\MaterialRelations;
use App\Support\QueryFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\HasFactory;

class Material extends Model
{
    use MaterialRelations;
    use Filterable;
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'material';

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
        'name',
        'title',
        'content',
        'style',
        'active',
        'category_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean'
    ];
}