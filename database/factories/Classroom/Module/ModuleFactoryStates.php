<?php

namespace Database\Factories\Classroom\Module;

use App\Models\Eloquent\Classroom\Test\Test;
use App\Models\Eloquent\Classroom\Course\Course;

trait ModuleFactoryStates
{
    /**
     * Indicate that the module has a course.
     *
     * @param boolean $hasCourse
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
}