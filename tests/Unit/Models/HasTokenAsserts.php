<?php

namespace Tests\Unit\Models;

trait HasTokenAsserts
{
    public function test_token_functions()
    {
        $this->assertHasMethod(get_class($this->model), 'tokens');
        $this->assertHasMethod(get_class($this->model), 'tokenCan');
        $this->assertHasMethod(get_class($this->model), 'createToken');
        $this->assertHasMethod(get_class($this->model), 'currentAccessToken');
        $this->assertHasMethod(get_class($this->model), 'withAccessToken');
    }
}