<?php

namespace Tests\Unit\Models\Mailing;

use Tests\Unit\Models\ModelTestCase;
use App\Models\Mailing\MessageHeader\MessageHeader;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class MessageHeaderTest extends ModelTestCase
{
    use HasFactoryAsserts;
    
    /**
     * @var MessageHeader
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = MessageHeader::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'message_header',
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

        $this->assertHasManyRelation($relation, $this->model, 'message_header_id');
    }
}