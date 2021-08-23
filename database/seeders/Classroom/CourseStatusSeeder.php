<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\CourseStatusEnum;
use App\Models\Eloquent\Classroom\CourseStatus\CourseStatus;
use Illuminate\Database\Seeder;

class CourseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(CourseStatusEnum::NEW, 'Novo');
        $this->create(CourseStatusEnum::IN_PROGRESS, 'Em andamento');
        $this->create(CourseStatusEnum::FINISHED, 'Finalizado');
        $this->create(CourseStatusEnum::APPROVED, 'Aprovado');
        $this->create(CourseStatusEnum::DISAPPROVED, 'Desaprovado');
        $this->create(CourseStatusEnum::ABANDONED, 'Abandonado');
    }

    /**
     * Create a Course Status entry.
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name)
    {
        $courseStatus = new CourseStatus(compact('id', 'name'));
        $courseStatus->save();
    }
}