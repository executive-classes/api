<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\ModuleStatusEnum;
use App\Models\Classroom\ModuleStatus\ModuleStatus;
use Illuminate\Database\Seeder;

class ModuleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(ModuleStatusEnum::NEW, 'Novo');
        $this->create(ModuleStatusEnum::IN_PROGRESS, 'Em andamento');
        $this->create(ModuleStatusEnum::FINISHED, 'Finalizado');
        $this->create(ModuleStatusEnum::APPROVED, 'Aprovado');
        $this->create(ModuleStatusEnum::DISAPPROVED, 'Desaprovado');
        $this->create(ModuleStatusEnum::ABANDONED, 'Abandonado');
    }

    /**
     * Create a Module Status entry.
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name)
    {
        $moduleStatus = new ModuleStatus(compact('id', 'name'));
        $moduleStatus->save();
    }
}