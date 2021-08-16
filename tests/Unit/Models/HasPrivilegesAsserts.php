<?php

namespace Tests\Unit\Models;

trait HasPrivilegesAsserts
{
    public function test_privileges()
    {
        $this->assertHasMethod(get_class($this->model), 'getAllPrivileges');
    }
}