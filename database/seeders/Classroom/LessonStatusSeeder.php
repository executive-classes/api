<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\LessonStatusEnum;
use App\Models\Eloquent\Classroom\LessonStatus\LessonStatus;
use Database\Seeders\Seeder;

class LessonStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(LessonStatusEnum::NEW);
        $this->create(LessonStatusEnum::IN_PROGRESS);
        $this->create(LessonStatusEnum::FINISHED);
        $this->create(LessonStatusEnum::ABANDONED);
    }

    /**
     * Create a Lesson Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $lessonStatus = new LessonStatus(compact('id'));
        $lessonStatus->save();
    }
}