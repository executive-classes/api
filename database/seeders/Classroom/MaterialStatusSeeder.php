<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\MaterialStatusEnum;
use App\Models\Eloquent\Classroom\MaterialStatus\MaterialStatus;
use Database\Seeders\Seeder;

class MaterialStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(MaterialStatusEnum::NEW, 'Novo');
        $this->create(MaterialStatusEnum::VIEWED, 'Visto');
    }

    /**
     * Create a Material Status entry.
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name)
    {
        $materialStatus = new MaterialStatus(compact('id', 'name'));
        $materialStatus->save();
    }
}