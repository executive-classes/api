<?php

namespace App\Models\Eloquent\Classroom\Module;

use App\Models\Eloquent\Classroom\Test\Test;
use App\Models\Eloquent\General\Category\Category;
use App\Models\Eloquent\Billing\Student\Student;
use App\Models\Eloquent\Classroom\Course\Course;
use App\Models\Eloquent\Classroom\Lesson\Lesson;

trait ModuleRelations
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
        return $this->belongsToMany(Student::class, 'module_x_student', 'module_id', 'student_id');
    }

    /**
     * Lessons relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'module_id', 'id');
    }

    /**
     * Course relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
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