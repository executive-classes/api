<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\LessonStatusEnum;
use App\Models\Classroom\LessonStatus\LessonStatus;
use Illuminate\Database\Seeder;

class LessonStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(LessonStatusEnum::NEW, 'Novo');
        $this->create(LessonStatusEnum::IN_PROGRESS, 'Em andamento');
        $this->create(LessonStatusEnum::FINISHED, 'Finalizado');
        $this->create(LessonStatusEnum::ABANDONED, 'Abandonado');
    }

    /**
     * Create a Lesson Status entry.
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name)
    {
        $lessonStatus = new LessonStatus(compact('id', 'name'));
        $lessonStatus->save();
    }
}