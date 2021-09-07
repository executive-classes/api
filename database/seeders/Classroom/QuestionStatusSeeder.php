<?php

namespace Database\Seeders\Classroom;

use App\Enums\Classroom\QuestionStatusEnum;
use App\Models\Eloquent\Classroom\QuestionStatus\QuestionStatus;
use Database\Seeders\Seeder;

class QuestionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(QuestionStatusEnum::READY);
        $this->create(QuestionStatusEnum::STARTED);
        $this->create(QuestionStatusEnum::ANSWERED);
        $this->create(QuestionStatusEnum::GRADED);
    }

    /**
     * Create a Question Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $questionStatus = new QuestionStatus(compact('id'));
        $questionStatus->save();
    }
}