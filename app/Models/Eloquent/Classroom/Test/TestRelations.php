<?php

namespace App\Models\Eloquent\Classroom\Test;

use App\Models\Eloquent\General\Category\Category;
use App\Models\Eloquent\Billing\Student\Student;
use App\Models\Eloquent\Billing\Teacher\Teacher;
use App\Models\Eloquent\Classroom\Course\Course;
use App\Models\Eloquent\Classroom\Module\Module;
use App\Models\Eloquent\Classroom\Question\Question;

trait TestRelations
{
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