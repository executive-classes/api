<?php

namespace Tests\Unit\Traits\Models;

trait HasFilterAsserts
{
    public function test_filter()
    {
        $this->assertModelScope($this->model, 'filter');
    }
}