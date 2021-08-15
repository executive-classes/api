<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\General\Category;
use Tests\Unit\Models\ModelTestCase;

class CategoryTest extends ModelTestCase
{
    /**
     * @var Course
     */
    protected $model;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->model = new Category();
    }

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'category',
            'primaryKey' => 'id',
            'timestamps' => false,
            'fillable' => [
                'name',
                'description',
                'category_type_id',
                'parent_id'
            ]
        ]);
    }

    public function test_type_relation()
    {
        $relation = $this->model->type();

        $this->assertBelongsToRelation($relation, $this->model, 'category_type_id');
    }

    public function test_parent_relation()
    {
        $relation = $this->model->parent();

        $this->assertBelongsToRelation($relation, $this->model, 'parent_id');
    }

    public function test_subCategories_relation()
    {
        $relation = $this->model->subCategories();

        $this->assertHasManyRelation($relation, $this->model, 'parent_id');
    }
}
