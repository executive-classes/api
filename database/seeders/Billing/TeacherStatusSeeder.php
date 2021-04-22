<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\TeacherStatusEnum;
use App\Models\Billing\TeacherStatus;
use Illuminate\Database\Seeder;

class TeacherStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(TeacherStatusEnum::ACTIVE, 'Ativo', 'Indicates that a teacher is active and can teach classes.');
        $this->create(TeacherStatusEnum::SUSPENDED, 'Suspenso', 'Indicates that a teacher is suspended and can not teach classes.');
        $this->create(TeacherStatusEnum::CANCELED, 'Cancelado', 'Indicates that a teacher is canceled and will no more teach classes.');
        $this->create(TeacherStatusEnum::INACTIVE, 'Inativo', 'Indicates that a teacher is inactive.');
    }

    /**
     * Create a Teacher Status entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description)
    {
        $teacherStatus = new TeacherStatus(compact('id', 'name', 'description'));
        $teacherStatus->save();
    }
}