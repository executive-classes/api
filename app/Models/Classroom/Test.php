<?php

namespace App\Models\Classroom;

use App\Filters\Filterable;
use App\Models\Billing\Student;
use App\Models\Billing\Teacher;
use App\Models\General\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
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

    /**
     * Category relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Courses relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'test_id', 'id');
    }

    /**
     * Modules relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function module()
    {
        return $this->hasMany(Module::class, 'test_id', 'id');
    }

    /**
     * Students relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'test_x_student', 'test_id', 'student_id');
    }

    /**
     * Teachers relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'test_x_student', 'test_id', 'teacher_id');
    }

    /**
     * Question relations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'test_x_question', 'test_id', 'question_id');
    }
}