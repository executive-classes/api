<?php

namespace Database\Seeders\General;

use App\Enums\General\CategoryTypeEnum;
use App\Models\Eloquent\General\CategoryType\CategoryType;
use Database\Seeders\Seeder;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(CategoryTypeEnum::COURSE, 'Curso');
        $this->create(CategoryTypeEnum::MODULE, 'Módulo');
        $this->create(CategoryTypeEnum::LESSON, 'Aula');
        $this->create(CategoryTypeEnum::TEST, 'Prova');
        $this->create(CategoryTypeEnum::QUESTION, 'Questão');
        $this->create(CategoryTypeEnum::MATERIAL, 'Material');
    }

    /**
     * Create a Category Type entry.
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name)
    {
        $categoryType = new CategoryType(compact('id', 'name'));
        $categoryType->save();
    }
}