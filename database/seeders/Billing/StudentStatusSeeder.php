<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\StudentStatusEnum;
use App\Models\Eloquent\Billing\StudentStatus\StudentStatus;
use Database\Seeders\Seeder;

class StudentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(StudentStatusEnum::ACTIVE);
        $this->create(StudentStatusEnum::SUSPENDED);
        $this->create(StudentStatusEnum::CANCELED);
    }

    /**
     * Create a Student Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $studentStatus = new StudentStatus(compact('id'));
        $studentStatus->save();
    }
}