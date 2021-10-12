<?php

namespace Tests\Unit\Models\Mailing;

use App\Models\Eloquent\Mailing\MessageType\MessageType;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class MessageTypeTest extends ModelTestCase
{
    use HasFactoryAsserts;

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