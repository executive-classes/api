<?php

namespace Tests\Feature\Classroom;

use Tests\Feature\FeatureTestCase;
use App\Models\Eloquent\Classroom\Question\Question;
use Tests\FactoryMaker;

class QuestionTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('question.index'));
        $this->assertAuthenticationRequired(route('question.store'), 'POST');
        $this->assertAuthenticationRequired(route('question.show', ['question' => 1]));
        $this->assertAuthenticationRequired(route('question.update', ['question' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('question.reactivate', ['question' => 1]), 'PATCH');
        $this->assertAuthenticationRequired(route('question.cancel', ['question' => 1]), 'PATCH');
    }

    public function test_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('question.index'));
        
        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_create()
    {
        // Data creation
        $question = $this->makeOne(Question::class, true);
        $data = collect($question->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('question.store'), $question->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('question', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_show()
    {
        // Data creation
        $question = $this->createOne(Question::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('question.show', ['question' => $question->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_update()
    {
        // Data creation
        $question = $this->createOne(Question::class);
        $newQuestion = $this->makeOne(Question::class, true);
        $data = collect($newQuestion->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(
                route('question.update', ['question' => $question->id]),
                $newQuestion->toArray()
            );

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('question', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_reactivate()
    {
        // Data creation
        $question = $this->createOne(Question::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('question.reactivate', ['question' => $question->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_cancel()
    {
        // Data creation
        $question = $this->createOne(Question::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('question.cancel', ['question' => $question->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('question', [
            'id' => $question->id, 
            'active' => false
        ]);
    }
}