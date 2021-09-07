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
        $this->create(CategoryTypeEnum::COURSE);
        $this->create(CategoryTypeEnum::MODULE);
        $this->create(CategoryTypeEnum::LESSON);
        $this->create(CategoryTypeEnum::TEST);
        $this->create(CategoryTypeEnum::QUESTION);
        $this->create(CategoryTypeEnum::MATERIAL);
    }

    /**
     * Create a Category Type entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $categoryType = new CategoryType(compact('id'));
        $categoryType->save();
    }
}