<?php

namespace App\Models\Billing\Teacher;

use App\Models\Classroom\Test\Test;
use App\Models\Classroom\Lesson\Lesson;
use App\Models\Classroom\Question\Question;
use Illuminate\Foundation\Auth\User;
use App\Models\Billing\TeacherStatus\TeacherStatus;
use App\Models\Billing\Student\Student;

trait TeacherScopes
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
     * Status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(TeacherStatus::class, 'teacher_status_id');
    }

    /**
     * Students relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'lesson_x_student', 'teacher_id', 'student_id');
    }

    /**
     * Lessons relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_x_student', 'teacher_id', 'lesson_id');
    }

    /**
     * Lesson Questions relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function lessonQuestions()
    {
        return $this->belongsToMany(Question::class, 'lessonQuestion_x_student', 'teacher_id', 'question_id');
    }

    /**
     * Test Questions relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function testQuestions()
    {
        return $this->belongsToMany(Question::class, 'testQuestion_x_student', 'teacher_id', 'question_id');
    }

    /**
     * Test Questions relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_x_student', 'teacher_id', 'test_id');
    }
}