<?php

namespace App\Models\Eloquent\Billing\Student;

use App\Support\QueryFilter\Filterable;
use App\Traits\Models\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use StudentRelations;
    use StudentScopes;
    use StudentFunctions;
    use Filterable;
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student';

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
        'customer_id',
        'biller_id',
        'user_id',
        'student_status_id'
    ];
}