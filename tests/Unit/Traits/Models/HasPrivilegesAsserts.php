<?php

namespace Tests\Unit\Traits\Models;

trait HasPrivilegesAsserts
{
    public function test_privileges()
    {
        $this->assertHasMethod(get_class($this->model), 'getAllPrivileges');
    }
}