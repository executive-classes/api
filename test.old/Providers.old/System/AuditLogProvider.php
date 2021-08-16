<?php

namespace Tests\Providers\System;

use App\Models\Billing\User;
use Closure;

/**
 * @requires \Tests\Providers\System\RequestProvider
 */
trait AuditLogProvider
{
    /**
     * Providers
     */

    public function getModel()
    {
        return [
            [ $this->getModelFunction(User::class) ]
        ];
    }
    
    public function getModelWithAutentication()
    {
        return [
            'without-user' => [
                $this->getModelWithAutenticationFunction()
            ],
            'with-user' => [
                $this->getModelWithAutenticationFunction(true)
            ],
            'with-cross-user' => [
                $this->getModelWithAutenticationFunction(true, true)
            ]
        ];
    }

    public function getModelsForInsert()
    {
        return [
            'user' => [ $this->getModelsForInsertFunction(User::class) ]
        ];
    }

    public function getModelsForUpdate()
    {
        return [
            'user' => [ $this->getModelsForUpdateFunction(User::class) ]
        ];
    }

    public function getModelsForDelete()
    {
        return [
            'user' => [ $this->getModelsForDeleteFunction(User::class) ]
        ];
    }
    
    /**
     * Providers Functions
     */

    private function getModelFunction(string $model): Closure 
    {
        return function () use ($model) { 
            return [ $this->makeRequest(), $model ]; 
        };
    }

    private function getModelWithAutenticationFunction(bool $authenticate = false, bool $crossAuthenticate = false): Closure 
    {
        return function () use ($authenticate, $crossAuthenticate) { 
            return [ $this->makeRequest($authenticate, $crossAuthenticate), User::class ]; 
        };
    }

    private function getModelsForInsertFunction(string $model): Closure 
    {
        return function () use ($model) { 
            return [ $this->makeRequest(), $model ]; 
        };
    }

    private function getModelsForUpdateFunction(string $model): Closure 
    {
        return function () use ($model) { 
            return [ $this->makeRequest(), $this->makeModel($model), $this->makeModelAttributes($model) ]; 
        };
    }

    private function getModelsForDeleteFunction(string $model): Closure 
    {
        return function () use ($model) { 
            return [ $this->makeRequest(), $this->makeModel($model) ]; 
        };
    }

    /**
     * Makers
     */

    public function makeModel(string $model)
    {
        return $model::factory()->create();
    }

    public function makeModelAttributes(string $model)
    {
        return $model::factory()->make()->getAttributes();
    }
}