<?php

namespace Tests\Unit\Http\Requests;

use Tests\MocksDatabase;
use Tests\TestCase;

abstract class RequestTestCase extends TestCase
{
    use MocksDatabase;

    /**
     * @var \Illuminate\Foundation\Http\FormRequest
     */
    protected $request;

    /**
     * @var array
     */
    protected $rules;

    /**
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->afterApplicationCreated(function () {
            $this->mockDb();
        });

        parent::setUp();

        $this->request   = new $this->requestClass;
        $this->rules     = $this->request->rules();
        $this->validator = $this->app['validator'];
    }

    /**
     * Validate a field.
     *
     * @param string $field
     * @param mixed $value
     * @return boolean
     */
    protected function validateField(string $field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }

    /**
     * Get a field validator
     *
     * @param string $field
     * @param mixed $value
     * @return \Illuminate\Validation\Validator
     */
    protected function getFieldValidator($field, $value)
    {
        return $this->validator->make(
            [$field => $value],
            [$field => $this->rules[$field]]
        );
    }

    protected function valueToString($value)
    {
        if ($value === true) {
            return 'true';
        }

        if ($value === false) {
            return 'false';
        }

        if ($value === null) {
            return 'null';
        }

        return $value;
    }

    /**
     * Assert that a field validation passes with a given value.
     *
     * @param string $field
     * @param mixed $value
     * @return void
     */
    public function assertPasses(string $field, $value)
    {
        $this->assertTrue($this->validateField($field, $value), "The field '$field' not passes with the value '{$this->valueToString($value)}'");
    }

    /**
     * Assert that a field validation will not passes with a given value.
     *
     * @param string $field
     * @param mixed $value
     * @return void
     */
    public function assertNotPasses(string $field, $value)
    {
        $this->assertFalse($this->validateField($field, $value), "The field '$field' passes with the value '{$this->valueToString($value)}'");
    }

    /**
     * Inform that DB should receive a select with the exists validation;
     *
     * @param string $table
     * @param string $field
     * @param mixed $value
     * @param boolean $exists
     * @return void
     */
    public function shouldValidateExists($table, $field, $value = null, bool $exists = true)
    {
        $this->db->shouldReceive('select')->withArgs([
            "select count(*) as aggregate from \"$table\" where \"$field\" = ?",
            [$value],
            false
        ])->andReturn([(object) ['aggregate' => $exists ? 1 : 0]]);
    }

}