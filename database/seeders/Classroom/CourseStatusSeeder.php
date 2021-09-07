<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\CourseStatusEnum;
use App\Models\Eloquent\Classroom\CourseStatus\CourseStatus;
use Database\Seeders\Seeder;

class CourseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(CourseStatusEnum::NEW);
        $this->create(CourseStatusEnum::IN_PROGRESS);
        $this->create(CourseStatusEnum::FINISHED);
        $this->create(CourseStatusEnum::APPROVED);
        $this->create(CourseStatusEnum::DISAPPROVED);
        $this->create(CourseStatusEnum::ABANDONED);
    }

    /**
     * Create a Course Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $courseStatus = new CourseStatus(compact('id'));
        $courseStatus->save();
    }
}