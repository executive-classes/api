<?php

namespace App\Models\Eloquent\Classroom\Course;

use App\Models\Eloquent\Classroom\Test\Test;
use App\Models\Eloquent\Classroom\Lesson\Lesson;
use App\Models\Eloquent\Classroom\Module\Module;
use App\Models\Eloquent\General\Category\Category;
use App\Models\Eloquent\Billing\Student\Student;

trait CourseRelations
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