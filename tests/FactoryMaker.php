<?php

namespace Tests;

use Illuminate\Foundation\Testing\WithFaker;

trait FactoryMaker
{
    use WithFaker;

    public function makeOne(string $model)
    {
        return $this->factory($model, 1, false)->first();
    }
    
    public function makeMany(string $model, int $count = 2)
    {
        return $this->factory($model, $count, false);
    }

    public function createOne(string $model)
    {
        return $this->factory($model, 1, true)->first();
    }

    public function createMany(string $model, int $count = 2)
    {
        return $this->factory($model, $count, true);
    }

    public function factory(string $model, int $count = 2, bool $persist = false)
    {
        $factory = $model::factory()
            ->persist($persist)
            ->count($count);

        return $persist
            ? $factory->create()
            : $factory->make();
    }
}