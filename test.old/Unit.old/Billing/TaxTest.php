<?php

namespace Tests\Unit\Billing;

use App\Enums\Billing\StateEnum;
use App\Services\Billing\Tax\Cnpj;
use App\Services\Billing\Tax\Cpf;
use App\Services\Billing\Tax\Ie;
use App\Services\Billing\Tax\Rg;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Providers\Billing\TaxProvider;
use Tests\TestCase;

class TaxTest extends TestCase
{
    use WithFaker, TaxProvider;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test if valids CPFs returns true.
     *
     * @return void
     */
    public function test_valid_cnpj_validation()
    {
        $cnpj = new Cnpj;
        $this->assertTrue($cnpj->validate($this->faker()->cnpj(false)));
        $this->assertTrue($cnpj->validate($this->faker()->cnpj()));
    }
    
    /**
     * Test if invalids CPFs returns false.
     *
     * @dataProvider getInvalidCnpj
     * 
     * @param string $cnpj_unformated
     * @param string $cnpj_formated
     * @return void
     */
    public function test_invalid_cnpj_validation(string $cnpj_unformated, string $cnpj_formated)
    {
        $cnpj = new Cnpj;
        $this->assertFalse($cnpj->validate($cnpj_formated));
        $this->assertFalse($cnpj->validate($cnpj_unformated));
    }

    /**
     * Test if CNPJs can be masked.
     * 
     * @dataProvider getValidCnpj
     *
     * @param string $cnpj_unformated
     * @param string $cnpj_formated
     * @return void
     */
    public function test_cnpj_mask(string $cnpj_unformated, string $cnpj_formated)
    {
        $cnpj = new Cnpj;
        $this->assertEquals($cnpj_formated, $cnpj->mask($cnpj_unformated));
    }

    /**
     * Test if valids CPFs returns true.
     *
     * @return void
     */
    public function test_valid_cpf_validation()
    {
        $cpf = new Cpf;
        $this->assertTrue($cpf->validate($this->faker()->cpf(false)));
        $this->assertTrue($cpf->validate($this->faker()->cpf()));
    }
    
    /**
     * Test if invalids CPFs returns false.
     *
     * @dataProvider getInvalidCpf
     * 
     * @param string $cpf_unformated
     * @param string $cpf_formated
     * @return void
     */
    public function test_invalid_cpf_validation(string $cpf_unformated, string $cpf_formated)
    {
        $cpf = new Cpf;
        $this->assertFalse($cpf->validate($cpf_unformated));
        $this->assertFalse($cpf->validate($cpf_formated));
    }

    /**
     * Test if CPFs can be masked.
     *
     * @dataProvider getValidCpf
     * 
     * @param string $cpf_unformated
     * @param string $cpf_formated
     * @return void
     */
    public function test_cpf_mask(string $cpf_unformated, string $cpf_formated)
    {
        $cpf = new Cpf;
        $this->assertEquals($cpf_formated, $cpf->mask($cpf_unformated));
    }

    /**
     * Test if valids RGs returns true.
     *
     * @dataProvider getValidRgs
     * 
     * @param string $rg_unformated
     * @param string $rg_formated
     * @return void
     */
    public function test_valid_rg_validation(string $rg_unformated, string $rg_formated)
    {
        $rg = new Rg;
        $this->assertTrue($rg->validate($rg_unformated));
        $this->assertTrue($rg->validate($rg_formated));
    }
    
    /**
     * Test if invalids RGs returns false.
     *
     * @dataProvider getInvalidRgs
     * 
     * @param string $rg_unformated
     * @param string $rg_formated
     * @return void
     */
    public function test_invalid_rg_validation(string $rg_unformated, string $rg_formated)
    {
        $rg = new Rg;
        $this->assertFalse($rg->validate($rg_unformated));
        $this->assertFalse($rg->validate($rg_formated));
    }

    /**
     * Test if RGs can be masked.
     *
     * @dataProvider getValidRgs
     * 
     * @param string $rg_unformated
     * @param string $rg_formated
     * @return void
     */
    public function test_rg_mask(string $rg_unformated, string $rg_formated)
    {
        $rg = new Rg;
        $this->assertEquals($rg_formated, $rg->mask($rg_unformated));
    }

    /**
     * Test if valids IEs returns true.
     * 
     * @dataProvider getValidIes
     *
     * @param StateEnum $state
     * @param string $ie_unformated
     * @param string $ie_formated
     * @return void
     */
    public function test_valid_ie_validation(StateEnum $state, string $ie_unformated, string $ie_formated)
    {
        $ie = new Ie;
        $this->assertTrue($ie->validate($ie_unformated, $state));
        $this->assertTrue($ie->validate($ie_formated, $state));
    }
    
    /**
     * Test of invalid IEs returns false.
     * 
     * @dataProvider getInvalidIes
     *
     * @param StateEnum $state
     * @param string $ie_unformated
     * @param string $ie_formated
     * @return void
     */
    public function test_invalid_ie_validation(StateEnum $state, string $ie_unformated, string $ie_formated)
    {
        $ie = new Ie;
        $this->assertFalse($ie->validate($ie_unformated, $state));
        $this->assertFalse($ie->validate($ie_formated, $state));
    }

    /**
     * Test if IEs can be masked.
     * 
     * @dataProvider getValidIes
     *
     * @param StateEnum $state
     * @param string $ie_unformated
     * @param string $ie_formated
     * @return void
     */
    public function test_ie_mask(StateEnum $state, string $ie_unformated, string $ie_formated)
    {
        $ie = new Ie;
        $this->assertEquals($ie_formated, $ie->mask($ie_unformated, $state));
    }

    
}
