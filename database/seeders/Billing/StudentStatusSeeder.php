<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\StudentStatus;
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
        $this->create(StudentStatus::ACTIVE, 'Ativo', 'Indicates that a student is active and can attend classes.');
        $this->create(StudentStatus::SUSPENDED, 'Suspenso', 'Indicates that a student is suspended and can not attend classes.');
        $this->create(StudentStatus::CANCELED, 'Cancelado', 'Indicates that a student is canceled and will no more attend classes.');
        $this->create(StudentStatus::INACTIVE, 'Inativo', 'Indicates that a student is inactive.');
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