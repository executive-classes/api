<?php

namespace App\Models\General\Category;

use App\Models\General\CategoryType\CategoryType;
use App\Models\General\Category\Category;

trait CategoryRelations
{
    /**
     * Category Type relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CategoryType::class, 'category_type_id', 'id');
    }

    /**
     * Parent category relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * Sub Category relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}