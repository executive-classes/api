<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\StudentStatusEnum;
use App\Models\Eloquent\Billing\StudentStatus\StudentStatus;
use Illuminate\Database\Seeder;

class StudentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(StudentStatusEnum::ACTIVE, 'Ativo', 'Indicates that a student is active and can attend classes.');
        $this->create(StudentStatusEnum::SUSPENDED, 'Suspenso', 'Indicates that a student is suspended and can not attend classes.');
        $this->create(StudentStatusEnum::CANCELED, 'Cancelado', 'Indicates that a student is canceled and will no more attend classes.');
    }

    /**
     * Create a Student Status entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description)
    {
        $studentStatus = new StudentStatus(compact('id', 'name', 'description'));
        $studentStatus->save();
    }
}