<?php

namespace Tests\Unit\Traits\Models;

trait HasAuthenticationAsserts
{
    public function test_login_function()
    {
        $this->assertHasMethod(get_class($this->model), 'login');
    }

    public function test_crossLogin_function()
    {
        $this->assertHasMethod(get_class($this->model), 'crossLogin');
    }

    public function test_logout_function()
    {
        $this->assertHasMethod(get_class($this->model), 'logout');
    }

    public function test_check_function()
    {
        $this->assertHasMethod(get_class($this->model), 'check');
    }
}