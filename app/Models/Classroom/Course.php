<?php

namespace App\Models\Classroom;

use App\Models\Billing\Student;
use App\Models\General\Category;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course';

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
     * Students relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_x_student', 'course_id', 'student_id');
    }

    /**
     * Module relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function modules()
    {
        return $this->hasMany(Module::class, 'course_id', 'id');
    }

    /**
     * Lesson relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    /**
     * Test relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id', 'id');
    }
}