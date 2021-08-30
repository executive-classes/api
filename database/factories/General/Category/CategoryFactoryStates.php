<?php

namespace Database\Factories\General\Category;

use App\Models\Eloquent\General\Category\Category;

trait CategoryFactoryStates
{
    /**
     * Indicate that the category has a parent category.
     *
     * @param boolean $hasParent
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function parent(bool $hasParent = true)
    {
        $parent = $hasParent 
            ? $this->relation(Category::class) 
            : null;

        return $this->state(function (array $attributes) use ($parent) {
            return [
                'parent_id' => $parent
            ];
        });
    }
}