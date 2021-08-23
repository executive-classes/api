<?php

namespace Tests\Unit\System;

use App\Exceptions\ApiException;
use App\Support\Mask\Mask;
use Tests\TestCase;

class MaskTest extends TestCase
{
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_mask_numbers()
    {
        $mask = new Mask('###-###', '123456');
        $this->assertEquals('123-456', $mask->mask());
    }

    public function test_can_mask_alphanumeric()
    {
        $mask = new Mask('###-XXX', '123ab6');
        $this->assertEquals('123-ab6', $mask->mask());
    }

    public function test_can_use_multiple_masks()
    {
        $mask = new Mask(['###', '###-###'], '123456');
        $this->assertEquals('123-456', $mask->mask());
    }

    public function test_invalid_mask_throw_error()
    {
        $this->expectException(ApiException::class);
        
        $mask = new Mask('###-##', '123226');
        $mask->mask();
    }
}
