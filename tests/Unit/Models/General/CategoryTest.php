<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\General\Category\Category;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class CategoryTest extends ModelTestCase
{
    use HasFactoryAsserts;
    use HasFilterAsserts;

    /**
     * @var Category
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Category::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'category',
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
