<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\Billing\Address\AddressRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\MocksDatabase;
use Tests\TestCase;

abstract class RequestTestCase extends TestCase
{
    use MocksDatabase;
    use WithFaker;

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
    protected function request(array $fields = [])
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
     * Check if the additional rule is required.
     *
     * @param string $rule
     * @return bool
     */
    protected function checkRequiredAdditionalRule(string $rule)
    {
        return ($this->request()->additionalRules()[$rule] ?? null) === 'required';
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
     * Assert if a field is required.
     *
     * @param string $field
     * @param boolean $required
     * @return void
     */
    public function assertRequiredRule(string $field, bool $required = true)
    {
        if ($required) {
            $this->assertNotPasses($field, []);
        } else {
            $this->assertPasses($field, []);
        }
    }

    /**
     * Assert if a field is required if another field has some value.
     *
     * @param string $field
     * @param array $ifFields
     * @return void
     */
    public function assertRequiredIfRule(string $field, array $ifFields, array $passesField = [])
    {
        $this->assertPasses($field, $passesField);
        $this->assertNotPasses($field, $ifFields);
    }

    /**
     * Assert if a field is required with another field.
     *
     * @param string $field
     * @param array $withFields
     * @return void
     */
    public function assertRequiredWithRule(string $field, array $withFields, array $passesField = [])
    {
        $this->assertPasses($field, $passesField);
        $this->assertNotPasses($field, $withFields);
    }

    /**
     * Assert if a field is not required.
     *
     * @param string $field
     * @return void
     */
    public function assertSometimesRule(string $field)
    {
        $this->assertRequiredRule($field, false);
    }

    /**
     * Assert if a field is a Enum.
     *
     * @param string $field
     * @param array $enumValues
     * @return void
     */
    public function assertEnumRule(string $field, array $enumValues)
    {
        foreach ($enumValues as $value) {
            $this->assertPasses($field, [$field => $value]);
        }

        $this->assertNotPasses($field, [$field => 'invalid field']);
    }

    /**
     * Assert if a field is a string.
     *
     * @param string $field
     * @return void
     */
    public function assertStringRule(string $field)
    {
        $this->assertNotPasses($field, [$field => 123]);
        $this->assertNotPasses($field, [$field => true]);
        $this->assertNotPasses($field, [$field => 10.2]);
    }

    /**
     * Assert if a field is numeric.
     *
     * @param string $field
     * @return void
     */
    public function assertNumericRule(string $field)
    {
        $this->assertNotPasses($field, [$field => 'some string']);
        $this->assertNotPasses($field, [$field => true]);
    }

    /**
     * Assert if afield is a alpha dash string.
     *
     * @param string $field
     * @return void
     */
    public function assertAlphaDashRule(string $field)
    {
        $this->assertNotPasses($field, [$field => 'some string']);
        $this->assertNotPasses($field, [$field => true]);
    }
    
    /**
     * Assert if a integer field has max validation.
     *
     * @param string $field
     * @param integer $max
     * @return void
     */
    public function assertMaxIntRule(string $field, int $max)
    {
        $this->assertNotPasses($field, [$field => $max + 1]);
    }

    /**
     * Assert if a integer field has min validation.
     *
     * @param string $field
     * @param integer $min
     * @return void
     */
    public function assertMinIntRule(string $field, int $min)
    {
        $this->assertNotPasses($field, [$field => $min - 1]);
    }

    /**
     * Assert if a string field has max validation.
     *
     * @param string $field
     * @param integer $max
     * @return void
     */
    public function assertMaxStringRule(string $field, int $max)
    {
        $this->assertNotPasses($field, [$field => str_repeat('*', $max + 1)]);
    }

    /**
     * Assert if a string field has min validation.
     *
     * @param string $field
     * @param integer $min
     * @return void
     */
    public function assertMinStringRule(string $field, int $min)
    {
        $this->assertNotPasses($field, [$field => str_repeat('*', $min - 1)]);
    }

    /**
     * Assert if a field need to be the same that another.
     *
     * @param string $field
     * @param string $anotherField
     * @param mixed $value
     * @return void
     */
    public function assertSameRule(string $field, string $anotherField, $value)
    {
        $anotherValue = is_array($value) 
            ? $value['new_value'] = 'other value'
            : $value . 'other value';

        $this->assertNotPasses($field, [$field => $value, $anotherField => $anotherValue]);
    }

    /**
     * Assert if a field need to be different to another.
     *
     * @param string $field
     * @param string $anotherField
     * @param mixed $value
     * @return void
     */
    public function assertDifferentRule(string $field, string $anotherField, $value)
    {
        $this->assertNotPasses($field, [$field => $value, $anotherField => $value]);
    }

    /**
     * Assert if a field is a email.
     *
     * @param string $field
     * @return void
     */
    public function assertEmailRule(string $field)
    {
        $this->assertNotPasses($field, [$field => 'some string']);
        $this->assertNotPasses($field, [$field => true]);
        $this->assertNotPasses($field, [$field => 10.2]);
    }

    /**
     * Assert if a field is a date.
     *
     * @param string $field
     * @return void
     */
    public function assertDateRule(string $field)
    {
        $this->assertNotPasses($field, [$field => 'invalid date']);
        $this->assertNotPasses($field, [$field => 123]);
        $this->assertNotPasses($field, [$field => true]);
        $this->assertNotPasses($field, [$field => 10.2]);
    }

    /**
     * Assert if a field is a boolean.
     *
     * @param string $field
     * @return void
     */
    public function assertBooleanRule(string $field)
    {
        $this->assertPasses($field, [$field => true]);
        $this->assertPasses($field, [$field => false]);
        $this->assertNotPasses($field, [$field => 'ab']);
        $this->assertNotPasses($field, [$field => 123]);
    }

    /**
     * Assert if a field can be null.
     *
     * @param string $field
     * @return void
     */
    public function assertNullableRule(string $field)
    {
        $this->assertPasses($field, [$field => null]);
    }

    /**
     * Assert if a field can't be null.
     *
     * @param string $field
     * @return void
     */
    public function assertNotNullableRule(string $field)
    {
        $this->assertNotPasses($field, [$field => null]);
    }

    /**
     * Assert if a field exists.
     *
     * @param string $field
     * @param string $table
     * @param string $column
     * @param mixed $exists
     * @param mixed $notExists
     * @return void
     */
    public function assertExistsRule(string $field, string $table, string $column, $exists, $notExists)
    {
        $this->shouldValidateExists($table, $column, $exists);
        $this->shouldValidateNotExists($table, $column, $notExists);

        $this->assertPasses($field, [$field => $exists]);
        $this->assertNotPasses($field, [$field => $notExists]);
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

    /**
     * Inform that DB should receive a select with the exists validation and return a field;
     *
     * @param string $table
     * @param string $field
     * @param mixed $value
     * @param boolean $exists
     * @return void
     */
    public function shouldValidateNotExists($table, $field, $value = null)
    {
        $this->shouldValidateExists($table, $field, $value, false);
    }

    /**
     * Assert if a field is unique.
     *
     * @param string $field
     * @param string $table
     * @param string $column
     * @param mixed $unique
     * @param mixed $notUnique
     * @return void
     */
    public function assertUniqueRule(string $field, string $table, string $column, $unique, $notUnique)
    {
        $this->shouldValidateUnique($table, $column, $unique);
        $this->shouldValidateNotUnique($table, $column, $notUnique, false);

        $this->assertPasses($field, [$field => $unique]);
        $this->assertNotPasses($field, [$field => $notUnique]);
    }

    /**
     * Inform that DB should receive a select with the unique validation;
     *
     * @param string $table
     * @param string $field
     * @param mixed $value
     * @param boolean $exists
     * @return boolean
     */
    public function shouldValidateUnique($table, $field, $value = null, bool $unique = true)
    {
        $this->db->shouldReceive('select')->withArgs([
            "select count(*) as aggregate from \"$table\" where \"$field\" = ?",
            [$value],
            false
        ])->andReturn([(object) ['aggregate' => $unique ? 0 : 1]]);
    }

    /**
     * Inform that DB should receive a select with the unique validation and return some field.
     *
     * @param string $table
     * @param string $field
     * @param mixed $value
     * @param boolean $exists
     */
    public function shouldValidateNotUnique($table, $field, $value = null)
    {
        $this->shouldValidateUnique($table, $field, $value, false);
    }

}