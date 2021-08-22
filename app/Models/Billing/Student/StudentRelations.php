<?php

namespace App\Models\Billing\Student;

use App\Models\Billing\User\User;
use App\Models\Classroom\Test\Test;
use App\Models\Billing\Teacher\Teacher;
use App\Models\Classroom\Course\Course;
use App\Models\Classroom\Lesson\Lesson;
use App\Models\Classroom\Question\Question;
use App\Models\Billing\Biller\Biller;
use App\Models\Billing\StudentStatus\StudentStatus;
use App\Models\Billing\Customer\Customer;

trait StudentRelations
{
    /**
     * User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Customer relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Biller relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function biller()
    {
        return $this->belongsTo(Biller::class, 'biller_id');
    }

    /**
     * Status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(StudentStatus::class, 'student_status_id');
    }

    /**
     * Teachers relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'lesson_x_student', 'student_id', 'teacher_id');
    }

    /**
     * Lessons relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_x_student', 'student_id', 'lesson_id');
    }

    /**
     * Modules relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function modules()
    {
        return $this->belongsToMany(Lesson::class, 'module_x_student', 'student_id', 'module_id');
    }

    /**
     * Courses relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_x_student', 'student_id', 'course_id');
    }

    /**
     * Lesson Questions relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function lessonQuestions()
    {
        return $this->belongsToMany(Question::class, 'lessonQuestion_x_student', 'student_id', 'question_id');
    }

    /**
     * Test Questions relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function testQuestions()
    {
        return $this->belongsToMany(Question::class, 'testQuestion_x_student', 'student_id', 'question_id');
    }

    /**
     * Test Questions relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_x_student', 'student_id', 'test_id');
    }
}