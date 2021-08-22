<?php

namespace App\Models\Classroom\Material;

use App\Models\General\Category\Category;
use App\Models\Classroom\Lesson\Lesson;

trait MaterialRelations
{
    /**
     * Category relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Lessons relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lessons_x_material', 'material_id', 'lesson_id');
    }
}