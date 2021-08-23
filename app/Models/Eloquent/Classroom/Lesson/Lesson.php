<?php

namespace App\Models\Eloquent\Classroom\Lesson;

use App\Support\QueryFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\HasFactory;

class Lesson extends Model
{
    use LessonRelations;
    use Filterable;
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson';

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