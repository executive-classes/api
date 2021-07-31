<?php

namespace App\Models\Classroom;

use App\Models\Billing\Student;
use App\Models\Billing\Teacher;
use App\Models\General\Category;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question';

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
        'question',
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
     * Test Students relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function testStudents()
    {
        return $this->belongsToMany(Student::class, 'test_question_x_student', 'question_id', 'student_id');
    }

    /**
     * Lesson Students relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function lessonStudents()
    {
        return $this->belongsToMany(Student::class, 'lesson_question_x_student', 'question_id', 'student_id');
    }

    /**
     * Test Teachers relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function testTeachers()
    {
        return $this->belongsToMany(Teacher::class, 'test_question_x_student', 'question_id', 'teacher_id');
    }

    /**
     * Lesson Teachers relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function lessonTeachers()
    {
        return $this->belongsToMany(Teacher::class, 'lesson_question_x_student', 'question_id', 'teacher_id');
    }

    /**
     * Lessons relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_x_question', 'question_id', 'lesson_id');
    }

    /**
     * Tests relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_x_question', 'question_id', 'test_id');
    }
}