<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\Billing\Address\AddressRequest;
use Tests\MocksDatabase;
use Tests\TestCase;

abstract class RequestTestCase extends TestCase
{
    use MocksDatabase;

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

        $this->validator = $this->app['validator'];
    }

    /**
     * Makes the request.
     *
     * @param array $fields
     * @return \Illuminate\Foundation\Http\FormRequest
     */
    private function request(array $fields = [])
    {
        return (new $this->requestClass)->merge($fields);
    }

    /**
     * Validate a field.
     *
     * @param string $name
     * @param array $fields
     * @return boolean
     */
    protected function validateField(string $name, array $fields)
    {
        $rules = $this->request($fields)->rules();
        return $this->validator->make(
            $fields, 
            [$name => $rules[$name]]
        )->passes();
    }

    /**
     * Execute the prepareForValidation method.
     *
     * @param array $fields
     * @return \Illuminate\Foundation\Http\FormRequest
     */
    protected function executePrepareForValidation(array $fields = [])
    {
        $request = $this->request($fields);
        $this->callMethod($request, 'prepareForValidation');
        return $request;
    }

    /**
     * Write the value has a string.
     *
     * @param mixed $value
     * @return string|mixed
     */
    private function valueToString($value)
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
     * @param string $name
     * @param array $fields
     * @return void
     */
    public function assertPasses(string $name, array $fields)
    {
        $message = "The field '$name' not passes " . (empty($fields[$name])
            ? "without value"
            : "with the value '{$this->valueToString($fields[$name])}'");
        $this->assertTrue($this->validateField($name, $fields), $message);
    }

    /**
     * Assert that a field validation will not passes with a given value.
     *
     * @param string $name
     * @param array $fields
     * @return void
     */
    public function assertNotPasses(string $name, array $fields)
    {
        $message = "The field '$name' passes " . (empty($fields[$name])
            ? "without value"
            : "with the value '{$this->valueToString($fields[$name])}'");
        $this->assertFalse($this->validateField($name, $fields), $message);
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