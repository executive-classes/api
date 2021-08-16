<?php

namespace Tests\Unit\Models\Mailing;

use App\Models\Mailing\MessageType;
use Tests\Unit\Models\ModelTestCase;

class MessageTypeTest extends ModelTestCase
{
    /**
     * @var MessageType
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = MessageType::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'message_type',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}