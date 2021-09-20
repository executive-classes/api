<?php

namespace Tests\Unit\Http\Requests\Mailing\MessageTemplate;

use App\Http\Requests\Mailing\MessageTemplate\MessageTemplateCreateRequest;
use Tests\Unit\Http\Requests\RequestTestCase;

class MessageTemplateCreateRequestTest extends RequestTestCase
{
    /**
     * @var string
     */
    protected $requestClass = MessageTemplateCreateRequest::class;

    public function test_id_field()
    {
        $field = 'id';

        $this->assertPasses($field, [$field => 'some_id']);
        $this->assertPasses($field, [$field => 'some-id']);
        $this->assertRequiredRule($field);
        $this->assertAlphaDashRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_description_field()
    {
        $field = 'description';

        $this->assertPasses($field, [$field => 'some description']);
        $this->assertRequiredRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_subject_field()
    {
        $field = 'subject';

        $this->assertPasses($field, [$field => 'some subject']);
        $this->assertRequiredRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_content_field()
    {
        $field = 'content';

        $this->assertPasses($field, [$field => 'some content']);
        $this->assertRequiredRule($field);
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_message_type_id_field()
    {
        $field = 'message_type_id';

        $this->assertPasses($field, [$field => 'some_id']);
        $this->assertPasses($field, [$field => 'some-id']);
        $this->assertRequiredRule($field);
        $this->assertAlphaDashRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_message_header_id_field()
    {
        $field = 'message_header_id';

        $this->assertPasses($field, [$field => 'some_id']);
        $this->assertPasses($field, [$field => 'some-id']);
        $this->assertRequiredRule($field);
        $this->assertAlphaDashRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_message_footer_id_field()
    {
        $field = 'message_footer_id';

        $this->assertPasses($field, [$field => 'some_id']);
        $this->assertPasses($field, [$field => 'some-id']);
        $this->assertRequiredRule($field);
        $this->assertAlphaDashRule($field);
        $this->assertNotNullableRule($field);
    }
}