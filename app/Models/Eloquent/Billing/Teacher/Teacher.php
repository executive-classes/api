<?php

namespace App\Models\Eloquent\Billing\Teacher;

use App\Traits\Models\HasFactory;
use App\Support\QueryFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Billing\TeacherStatusEnum;

class Teacher extends Model
{
    use TeacherRelations;
    use TeacherScopes;
    use TeacherFunctions;
    use Filterable;
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teacher';

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
        'user_id',
        'teacher_status_id'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'teacher_status_id' => TeacherStatusEnum::ACTIVE,
    ];
}