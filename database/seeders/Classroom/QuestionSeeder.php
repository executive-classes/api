<?php

namespace Database\Seeders\Classroom;

use App\Models\Eloquent\Classroom\Question\Question;
use Database\Seeders\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        Question::factory(5)->persist()->create();
    }
}