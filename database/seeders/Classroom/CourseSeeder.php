<?php

namespace Database\Seeders\Classroom;

use App\Models\Eloquent\Classroom\Course\Course;
use Database\Seeders\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creates a course with a test
        Course::factory()->persist()->create();
    }
}