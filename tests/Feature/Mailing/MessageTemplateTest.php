<?php

namespace Tests\Feature\Mailing;

use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;

class MessageTemplateTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('messages.templates.list'));
        $this->assertAuthenticationRequired(route('messages.templates.show', ['messageTemplate' => 'abc']), );
        $this->assertAuthenticationRequired(route('messages.templates.create'), 'POST');
        $this->assertAuthenticationRequired(route('messages.templates.update', ['messageTemplate' => 'abc']), 'PUT');
        $this->assertAuthenticationRequired(route('messages.templates.delete', ['messageTemplate' => 'abc']), 'DELETE');
    }

    public function test_messages_templates_list()
    {
        // Data creation
        $this->createMany(MessageTemplate::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('messages.templates.list'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_messages_templates_show()
    {
        // Data creation
        $template = $this->createOne(MessageTemplate::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('messages.templates.show', ['messageTemplate' => $template->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_messages_templates_create()
    {
        // Data creation
        $template = $this->makeOne(MessageTemplate::class, true);
        $data = collect($template->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('messages.templates.create'), $template->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('message_template', $data->only(['id'])->toArray());
    }

    public function test_messages_templates_update()
    {
        // Data creation
        $template = $this->createOne(MessageTemplate::class);
        $newTemplate = $this->makeOne(MessageTemplate::class, true);
        $data = collect($newTemplate->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(
                route('messages.templates.update', ['messageTemplate' => $template->id]),
                $newTemplate->toArray()
            );

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('message_template', $data->only(['description', 'subject'])->toArray());
    }

    public function test_messages_templates_delete()
    {
        // Data creation
        $template = $this->createOne(MessageTemplate::class);
        $data = collect($template->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->deleteJson(
                route('messages.templates.delete', ['messageTemplate' => $template->id])
            );

        // Assertions
        $this->assertResponseJson($response, 204);
        $this->assertDatabaseMissing('message_template', $data->only(['id'])->toArray());
    }
}