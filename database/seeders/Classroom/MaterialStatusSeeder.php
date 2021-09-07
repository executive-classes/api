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
        $this->create(MaterialStatusEnum::NEW);
        $this->create(MaterialStatusEnum::VIEWED);
    }

    /**
     * Create a Material Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $materialStatus = new MaterialStatus(compact('id'));
        $materialStatus->save();
    }
}