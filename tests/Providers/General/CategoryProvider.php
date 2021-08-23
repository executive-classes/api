<?php

namespace Tests\Providers\General;

use App\Models\Eloquent\General\Category\Category;

trait CategoryProvider
{
    /**
     * Make a category for test.
     *
     * @param bool $persist
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function category(bool $persist = false)
    {
        return $this->categories(1, $persist)->first();
    }

    /**
     * Make categories for test.
     *
     * @param integer $count
     * @param bool $persist
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function categories(int $count = 2, bool $persist = false)
    {
        $factory = Category::factory()
            ->persist($persist)
            ->count($count);

        return $persist
            ? $factory->create()
            : $factory->make();
    }
}