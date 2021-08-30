<?php

namespace Database\Seeders\Classroom;

use App\Models\Eloquent\Classroom\Lesson\Lesson;
use Database\Seeders\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        
        // Creates a lesson without course and module
        Lesson::factory()->persist()->create();

        // Creates a lesson with a course
        Lesson::factory()->persist()->course()->create();

        // Creates a lesson with a module
        Lesson::factory()->persist()->module()->create();

        // Creates a lesson with course and module
        Lesson::factory()->persist()->course()->module()->create();
    }
}