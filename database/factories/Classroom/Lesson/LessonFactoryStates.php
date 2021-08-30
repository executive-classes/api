<?php

namespace Database\Factories\Classroom\Lesson;

use App\Models\Eloquent\Classroom\Course\Course;
use App\Models\Eloquent\Classroom\Module\Module;

trait LessonFactoryStates
{
    /**
     * Indicate that the lesson has a course.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function course(bool $hasCourse = true)
    {
        $course = $hasCourse
            ? $this->relation(Course::class)
            : null;

        return $this->state(function (array $attributes) use ($course) {
            return [
                'course_id' => $course
            ];
        });
    }

    /**
     * Indicate that the lesson has a module.
     *
     * @param boolean $hasModule
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function module(bool $hasModule = true)
    {
        $module = $hasModule
            ? $this->relation(Module::class)
            : null;

        return $this->state(function (array $attributes) use ($module) {
            return [
                'module_id' => $module
            ];
        });
    }
}