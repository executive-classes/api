<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\TeacherStatusEnum;
use App\Models\Eloquent\Billing\TeacherStatus\TeacherStatus;
use Database\Seeders\Seeder;

class TeacherStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(TeacherStatusEnum::ACTIVE);
        $this->create(TeacherStatusEnum::SUSPENDED);
        $this->create(TeacherStatusEnum::CANCELED);
    }

    /**
     * Create a Teacher Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $teacherStatus = new TeacherStatus(compact('id'));
        $teacherStatus->save();
    }
}