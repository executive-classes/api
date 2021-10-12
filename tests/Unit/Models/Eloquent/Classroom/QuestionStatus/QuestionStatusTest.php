<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Eloquent\Classroom\QuestionStatus\QuestionStatus;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class QuestionStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

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