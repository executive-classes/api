<?php

namespace Tests\Unit\Models\Mailing;

use App\Models\Mailing\Message;
use Tests\Unit\Models\HasFactoryAsserts;
use Tests\Unit\Models\HasMessageVerificationAsserts;
use Tests\Unit\Models\ModelTestCase;

class MessageTest extends ModelTestCase
{
    use HasFactoryAsserts, HasMessageVerificationAsserts;

    /**
     * @var Message
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Message::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'message',
            'timestamps' => false,
            'fillable' => [
                'should_proccess_at',
                'message_status_id',
                'reply_to',
                'to',
                'cc',
                'bcc',
                'subject',
                'content',
                'message_template_id',
                'params',
                'retries',
                'error_message'
            ]
        ]);
    }

    public function test_status_relation()
    {
        $relation = $this->model->status();

        $this->assertBelongsToRelation($relation, $this->model, 'message_status_id');
    }

    public function test_type_relation()
    {
        $relation = $this->model->type();

        $this->assertHasOneThroughRelation($relation, $this->model, 'id', 'id', 'message_id', 'message_template_id');
    }

    public function test_template_relation()
    {
        $relation = $this->model->template();

        $this->assertBelongsToRelation($relation, $this->model, 'message_template_id');
    }
}