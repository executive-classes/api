<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Classroom\Material;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Models\HasFilterAsserts;
use Tests\Unit\Models\HasFactoryAsserts;

class MaterialTest extends ModelTestCase
{
    use HasFactoryAsserts, HasFilterAsserts;

    /**
     * @var Material
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Material::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'material',
            'fillable' => [
                'name',
                'title',
                'content',
                'style',
                'active',
                'category_id'
            ],
            'casts' => [
                'id' => 'int',
                'active' => 'boolean'
            ]
        ]);
    }

    public function test_category_relation()
    {
        $relation = $this->model->category();

        $this->assertBelongsToRelation($relation, $this->model, 'category_id');
    }

    public function test_lessons_relation()
    {
        $relation = $this->model->lessons();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lessons_x_material', 'material_id', 'lesson_id');
    }

}