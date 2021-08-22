<?php

namespace Tests\Unit\Traits\Models;

trait HasFactoryAsserts
{
    public function test_factory()
    {
        $this->assertModelFactory($this->model);
    }
}