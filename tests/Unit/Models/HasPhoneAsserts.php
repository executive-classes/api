<?php

namespace Tests\Unit\Models;

trait HasPhoneAsserts
{
    public function test_phone_mutators()
    {
        $this->assertModelMutator($this->model, 'phone', '(11) 99999-9999', '11999999999');
        $this->assertModelMutator($this->model, 'phone', null, null, true);

        $this->assertModelMutator($this->model, 'phone_alt', '(11) 99999-9999', '11999999999');
        $this->assertModelMutator($this->model, 'phone_alt', null, null, true);
    }
}