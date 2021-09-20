<?php

namespace Tests\Unit\Http\Requests\Mailing\Message;

use App\Http\Requests\Mailing\Message\MessageCreateRequest;
use Carbon\Carbon;
use Tests\Unit\Http\Requests\RequestTestCase;

class MessageCreateRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = MessageCreateRequest::class;

    public function test_should_process_at_field()
    {
        $field = 'should_process_at';
        
        $this->assertPasses($field, [$field => Carbon::now()->toDateTimeString()]);
        $this->assertSometimesRule($field);
        $this->assertDateRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_reply_to_field()
    {
        $field = 'reply_to';

        $this->assertPasses($field, [$field => 'email@domain.com']);
        $this->assertRequiredRule($field);
        $this->assertStringRule($field);
        $this->assertEmailRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_to_field()
    {
        $field = 'to';

        $this->assertPasses($field, [$field => 'email@domain.com']);
        $this->assertRequiredRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_cc_field()
    {
        $field = 'cc';

        $this->assertPasses($field, [$field => 'email@domain.com']);
        $this->assertSometimesRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_bcc_field()
    {
        $field = 'bcc';

        $this->assertPasses($field, [$field => 'email@domain.com']);
        $this->assertSometimesRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_subject_field()
    {
        $field = 'subject';

        $this->assertPasses($field, [$field => 'some subject']);
        $this->assertRequiredIfRule(
            $field, 
            ['message_template_id' => null], 
            ['message_template_id' => 'some_id']
        );
        $this->assertNotNullableRule($field);
    }

    public function test_content_field()
    {
        $field = 'content';

        $this->assertPasses($field, [$field => 'some content']);
        $this->assertRequiredIfRule(
            $field,
            ['message_template_id' => null],
            ['message_template_id' => 'some_id']
        );
        $this->assertNotNullableRule($field);
    }

    public function test_message_template_id_field()
    {
        $field = 'message_template_id';

        $this->assertRequiredIfRule(
            $field,
            ['content' => null],
            ['content' => 'some content']
        );
        $this->assertExistsRule(
            $field, 
            'message_template', 
            'id', 
            'some_id', 
            'invalid_id'
        );
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_params_field()
    {
        $field = 'params';

        $this->assertPasses($field, [$field => 'some params']);
        $this->assertRequiredIfRule(
            $field,
            ['content' => null],
            ['content' => 'some content']
        );
        $this->assertNotNullableRule($field);
    }
}