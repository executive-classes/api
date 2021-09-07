<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\TestStatusEnum;
use App\Models\Eloquent\Classroom\TestStatus\TestStatus;
use Database\Seeders\Seeder;

class TestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(TestStatusEnum::NEW);
        $this->create(TestStatusEnum::READY);
        $this->create(TestStatusEnum::STARTED);
        $this->create(TestStatusEnum::FINISHED);
        $this->create(TestStatusEnum::GRADED);
        $this->create(TestStatusEnum::CANCELED);
    }

    /**
     * Create a Test Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $testStatus = new TestStatus(compact('id'));
        $testStatus->save();
    }
}