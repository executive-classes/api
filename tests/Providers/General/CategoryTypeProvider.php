<?php

namespace Tests\Providers\General;

use App\Models\General\CategoryType\CategoryType;

trait CategoryTypeProvider
{
    /**
     * Make a category type for test.
     *
     * @param bool $persist
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function type(bool $persist = false)
    {
        return $this->types(1, $persist)->first();
    }

    /**
     * Make category types for test.
     *
     * @param integer $count
     * @param bool $persist
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function types(int $count = 2, bool $persist = false)
    {
        $factory = CategoryType::factory()
            ->persist($persist)
            ->count($count);

        return $persist
            ? $factory->create()
            : $factory->make();
    }
}