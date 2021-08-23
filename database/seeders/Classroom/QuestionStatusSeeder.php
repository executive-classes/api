<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\QuestionStatusEnum;
use App\Models\Eloquent\Classroom\QuestionStatus\QuestionStatus;
use Illuminate\Database\Seeder;

class QuestionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(QuestionStatusEnum::READY, 'Pronta');
        $this->create(QuestionStatusEnum::STARTED, 'Iniciada');
        $this->create(QuestionStatusEnum::ANSWERED, 'Respondida');
        $this->create(QuestionStatusEnum::GRADED, 'Pontuada');
    }

    /**
     * Create a Question Status entry.
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name)
    {
        $questionStatus = new QuestionStatus(compact('id', 'name'));
        $questionStatus->save();
    }
}