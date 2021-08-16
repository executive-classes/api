<?php

namespace Tests\Unit\Models;

trait HasCrossAuthAuthenticationAsserts
{
    public function test_crossEmail_function()
    {
        $this->assertHasMethod(get_class($this->model), 'crossEmail');
    }
    
    public function test_crossUser_function()
    {
        $this->assertHasMethod(get_class($this->model), 'crossUser');
    }

    public function test_crossId_function()
    {
        $this->assertHasMethod(get_class($this->model), 'crossId');
    }
}