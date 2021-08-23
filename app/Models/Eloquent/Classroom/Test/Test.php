<?php

namespace App\Models\Eloquent\Classroom\Test;

use App\Support\QueryFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\HasFactory;

class Test extends Model
{
    use TestRelations;
    use Filterable;
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'test';

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