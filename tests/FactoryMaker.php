<?php

namespace Tests;

use Illuminate\Foundation\Testing\WithFaker;

trait FactoryMaker
{
    use WithFaker;

    public function makeOne(string $model, bool $createRelations = false)
    {
        return $createRelations
            ? $this->factory($model, 1, true)->make()->first()
            : $this->factory($model, 1, false)->make()->first();
    }
    
    public function makeMany(string $model, int $count = 2, bool $createRelations = false)
    {
        return $createRelations
            ? $this->factory($model, $count, true)->make()
            : $this->factory($model, $count, false)->make();
    }

    public function createOne(string $model)
    {
        return $this->factory($model, 1, true)->create()->first();
    }

    public function createMany(string $model, int $count = 2)
    {
        return $this->factory($model, $count, true)->create();
    }

    public function factory(string $model, int $count = 2, bool $persist = false)
    {
        $factory = $model::factory()
            ->persist($persist)
            ->count($count);

        return $factory;
    }
}