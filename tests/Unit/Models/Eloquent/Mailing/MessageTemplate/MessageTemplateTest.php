<?php

namespace Tests\Unit\Models\Mailing;

use Tests\Unit\Models\Eloquent\ModelTestCase;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class MessageTemplateTest extends ModelTestCase
{
    use HasFactoryAsserts;
    
    /**
     * @var MessageTemplate
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = MessageTemplate::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'message_template',
            'incrementing' => false,
            'keyType' => 'string',
            'fillable' => [
                'message_type_id',
                'description',
                'subject',
                'content',
                'message_header_id',
                'message_footer_id'
            ],
            'casts' => []
        ]);
    }

    public function test_type_relation()
    {
        $relation = $this->model->type();

        $this->assertBelongsToRelation($relation, $this->model, 'message_type_id');
    }

    public function test_header_relation()
    {
        $relation = $this->model->header();

        $this->assertBelongsToRelation($relation, $this->model, 'message_header_id');
    }

    public function test_footer_relation()
    {
        $relation = $this->model->footer();

        $this->assertBelongsToRelation($relation, $this->model, 'message_footer_id');
    }

    public function test_messages_relation()
    {
        $relation = $this->model->messages();

        $this->assertHasManyRelation($relation, $this->model, 'message_template_id');
    }
}