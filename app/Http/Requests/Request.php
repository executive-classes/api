<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Additional rules set of the request.
     *
     * @var array
     */
    protected $additionalRules = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [];
    }

    /**
     * Get the request attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return [];
    }

    /**
     * Get the request messages.
     *
     * @return array
     */
    public function getMessages(): array
    {
        return [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge($this->getRules(), $this->getAdditionalRules());
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return array_merge($this->getAttributes(), $this->getAdditionalAttributes());
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return array_merge($this->getMessages(), $this->getAdditionalMessages());
    }

    /**
     * Append the additional rules of the request.
     *
     * @return array
     */
    protected function getAdditionalRules(): array
    {
        $rules = [];
        
        foreach ($this->additionalRules as $name => $required) {
            $method = 'get' . Str::camel($name) . 'Rules';
            $rules = array_merge($rules, executeMethod($this, $method, [$required], []));
        }

        return $rules;
    }

    /**
     * Append the additional messages of the request.
     *
     * @return array
     */
    protected function getAdditionalMessages(): array
    {
        $messages = [];
        
        foreach ($this->additionalRules as $name) {
            $method = 'get' . Str::camel($name) . 'Messages';
            $messages = array_merge($messages, executeMethod($this, $method, null, []));
        }

        return $messages;
    }

    /**
     * Append the additional attributes of the request.
     *
     * @return array
     */
    protected function getAdditionalAttributes(): array
    {
        $attributes = [];
        
        foreach ($this->additionalRules as $name) {
            $method = 'get' . Str::camel($name) . 'Attributes';
            $attributes = array_merge($attributes, executeMethod($this, $method, null, []));
        }

        return $attributes;
    }
}