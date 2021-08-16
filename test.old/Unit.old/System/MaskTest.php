<?php

namespace Tests\Unit\System;

use App\Exceptions\ApiException;
use App\Services\Mask\MaskService;
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
        $mask = new MaskService('###-###', '123456');
        $this->assertEquals('123-456', $mask->mask());
    }

    public function test_can_mask_alphanumeric()
    {
        $mask = new MaskService('###-XXX', '123ab6');
        $this->assertEquals('123-ab6', $mask->mask());
    }

    public function test_can_use_multiple_masks()
    {
        $mask = new MaskService(['###', '###-###'], '123456');
        $this->assertEquals('123-456', $mask->mask());
    }

    public function test_invalid_mask_throw_error()
    {
        $this->expectException(ApiException::class);
        
        $mask = new MaskService('###-##', '123226');
        $mask->mask();
    }
}
