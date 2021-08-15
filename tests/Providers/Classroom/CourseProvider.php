<?php

namespace Tests\Providers\Classroom;

use App\Models\Classroom\Course;
use Tests\Providers\General\CategoryProvider;

trait CourseProvider
{
    use CategoryProvider;

    /**
     * Make a course for test.
     *
     * @param bool $persist
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function course(bool $persist = false)
    {
        return $this->courses(1, $persist)->first();
    }

    /**
     * Make courses for test.
     *
     * @param integer $count
     * @param bool $persist
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function courses(int $count = 2, bool $persist = false)
    {
        $factory = Course::factory()
            ->persist($persist)
            ->count($count);
        
        return $persist
            ? $factory->create()
            : $factory->make();
    }
}