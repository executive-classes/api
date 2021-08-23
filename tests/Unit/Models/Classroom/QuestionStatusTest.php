<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Eloquent\Classroom\QuestionStatus\QuestionStatus;
use Tests\Unit\Models\ModelTestCase;

class QuestionStatusTest extends ModelTestCase
{
    /**
     * @var QuestionStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = QuestionStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'question_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}