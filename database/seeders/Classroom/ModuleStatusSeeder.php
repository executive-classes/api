<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\ModuleStatusEnum;
use App\Models\Eloquent\Classroom\ModuleStatus\ModuleStatus;
use Database\Seeders\Seeder;

class ModuleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(ModuleStatusEnum::NEW);
        $this->create(ModuleStatusEnum::IN_PROGRESS);
        $this->create(ModuleStatusEnum::FINISHED);
        $this->create(ModuleStatusEnum::APPROVED);
        $this->create(ModuleStatusEnum::DISAPPROVED);
        $this->create(ModuleStatusEnum::ABANDONED);
    }

    /**
     * Create a Module Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $moduleStatus = new ModuleStatus(compact('id'));
        $moduleStatus->save();
    }
}