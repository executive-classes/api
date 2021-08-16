<?php

namespace Tests\Unit\Models;

trait HasFilterAsserts
{
    public function test_filter()
    {
        $this->assertModelScope($this->model, 'filter');
    }
}