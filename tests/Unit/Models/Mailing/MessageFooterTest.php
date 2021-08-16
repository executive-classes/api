<?php

namespace Tests\Unit\Models\Mailing;

use App\Models\Mailing\MessageFooter;
use Tests\Unit\Models\HasFactoryAsserts;
use Tests\Unit\Models\ModelTestCase;

class MessageFooterTest extends ModelTestCase
{
    use HasFactoryAsserts;
    
    /**
     * @var MessageFooter
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = MessageFooter::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'message_footer',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'fillable' => [
                'description',
                'content'
            ],
            'casts' => []
        ]);
    }

    public function test_templates_relation()
    {
        $relation = $this->model->templates();

        $this->assertHasManyRelation($relation, $this->model, 'message_footer_id');
    }
}
