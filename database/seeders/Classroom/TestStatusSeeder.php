<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\TestStatusEnum;
use App\Models\Classroom\TestStatus;
use Illuminate\Database\Seeder;

class TestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(TestStatusEnum::NEW, 'Nova');
        $this->create(TestStatusEnum::READY, 'Pronta');
        $this->create(TestStatusEnum::STARTED, 'Iniciada');
        $this->create(TestStatusEnum::FINISHED, 'Finalizada');
        $this->create(TestStatusEnum::GRADED, 'Pontuada');
        $this->create(TestStatusEnum::CANCELED, 'Cancelada');
    }

    /**
     * Create a Test Status entry.
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name)
    {
        $testStatus = new TestStatus(compact('id', 'name'));
        $testStatus->save();
    }
}