<?php

namespace Tests\Unit\Models;

trait HasFactoryAsserts
{
    public function test_factory()
    {
        $this->assertModelFactory($this->model);
    }
}