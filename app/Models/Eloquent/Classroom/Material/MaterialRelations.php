<?php

namespace App\Models\Eloquent\Classroom\Material;

use App\Models\Eloquent\General\Category\Category;
use App\Models\Eloquent\Classroom\Lesson\Lesson;

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