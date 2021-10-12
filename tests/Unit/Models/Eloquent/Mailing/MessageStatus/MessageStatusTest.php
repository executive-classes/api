<?php

namespace Tests\Unit\Models\Mailing;

use App\Models\Eloquent\Mailing\MessageStatus\MessageStatus;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class MessageStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var MessageStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = MessageStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'message_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}