<?php

namespace Tests\Unit\Billing;

use App\Enums\Billing\StateEnum;
use App\Enums\Billing\TaxTypeEnum;
use App\Models\Eloquent\Billing\TaxType\TaxType;
use App\Services\Billing\Tax\Cnpj;
use App\Services\Billing\Tax\Cpf;
use App\Services\Billing\Tax\Ie;
use App\Services\Billing\Tax\Rg;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Providers\Billing\TaxProvider;
use Tests\TestCase;

class TaxTypeTest extends TestCase
{
    use RefreshDatabase, WithFaker, TaxProvider;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;
    
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
     * Test if a instance of Tax Type can validate a CNPJ.
     * 
     * @dataProvider getValidCnpj
     *
     * @param string $cnpj_unformated
     * @param string $cnpj_formated
     * @return void
     */
    public function test_cnpj_can_validate(string $cnpj_unformated, string $cnpj_formated)
    {
        $taxType = TaxType::find(TaxTypeEnum::CNPJ);

        $this->assertInstanceOf(Cnpj::class, $taxType->tax());
        $this->assertTrue($taxType->validate($cnpj_formated));
        $this->assertTrue($taxType->validate($cnpj_unformated));
    }

    /**
     * Test if a instance of Tax Type can mask a CNPJ.
     * 
     * @dataProvider getValidCnpj
     *
     * @param string $cnpj_unformated
     * @param string $cnpj_formated
     * @return void
     */
    public function test_cnpj_can_mask(string $cnpj_unformated, string $cnpj_formated)
    {
        $taxType = TaxType::find(TaxTypeEnum::CNPJ);
        
        $this->assertInstanceOf(Cnpj::class, $taxType->tax());
        $this->assertEquals($cnpj_formated, $taxType->mask($cnpj_unformated));
    }

    /**
     * Test if a instance of Tax Type can validate a CPF.
     * 
     * @dataProvider getValidCpf
     *
     * @param string $cpf_unformated
     * @param string $cpf_formated
     * @return void
     */
    public function test_cpf_can_validate(string $cpf_unformated, string $cpf_formated)
    {
        $taxType = TaxType::find(TaxTypeEnum::CPF);

        $this->assertInstanceOf(Cpf::class, $taxType->tax());
        $this->assertTrue($taxType->validate($cpf_formated));
        $this->assertTrue($taxType->validate($cpf_unformated));
    }

    /**
     * Test if a instance of Tax Type can mask a CPF.
     * 
     * @dataProvider getValidCpf
     *
     * @param string $cpf_unformated
     * @param string $cpf_formated
     * @return void
     */
    public function test_cpf_can_mask(string $cpf_unformated, string $cpf_formated)
    {
        $taxType = TaxType::find(TaxTypeEnum::CPF);
        
        $this->assertInstanceOf(Cpf::class, $taxType->tax());
        $this->assertEquals($cpf_formated, $taxType->mask($cpf_unformated));
    }

    /**
     * Test if a instance of Tax Type can validate a RG.
     * 
     * @dataProvider getValidRg
     *
     * @param string $rg_unformated
     * @param string $rg_formated
     * @return void
     */
    public function test_rg_can_validate(string $rg_unformated, string $rg_formated)
    {
        $taxType = TaxType::find(TaxTypeEnum::RG);

        $this->assertInstanceOf(Rg::class, $taxType->tax());
        $this->assertTrue($taxType->validate($rg_formated));
        $this->assertTrue($taxType->validate($rg_unformated));
    }

    /**
     * Test if a instance of Tax Type can mask a RG.
     * 
     * @dataProvider getValidRg
     *
     * @param string $rg_unformated
     * @param string $rg_formated
     * @return void
     */
    public function test_rg_can_mask(string $rg_unformated, string $rg_formated)
    {
        $taxType = TaxType::find(TaxTypeEnum::RG);
        
        $this->assertInstanceOf(Rg::class, $taxType->tax());
        $this->assertEquals($rg_formated, $taxType->mask($rg_unformated));
    }

    /**
     * Test if a instance of Tax Type can validate a IE.
     * 
     * @dataProvider getValidIe
     *
     * @param string $ie_unformated
     * @param string $ie_formated
     * @return void
     */
    public function test_ie_can_validate(StateEnum $state, string $ie_unformated, string $ie_formated)
    {
        $taxType = TaxType::find(TaxTypeEnum::IE);

        $this->assertInstanceOf(Ie::class, $taxType->tax());
        $this->assertTrue($taxType->validate($ie_formated, $state));
        $this->assertTrue($taxType->validate($ie_unformated, $state));
    }

    /**
     * Test if a instance of Tax Type can mask a IE.
     * 
     * @dataProvider getValidIe
     *
     * @param string $ie_unformated
     * @param string $ie_formated
     * @return void
     */
    public function test_ie_can_mask(StateEnum $state, string $ie_unformated, string $ie_formated)
    {
        $taxType = TaxType::find(TaxTypeEnum::IE);
        
        $this->assertInstanceOf(Ie::class, $taxType->tax());
        $this->assertEquals($ie_formated, $taxType->mask($ie_unformated, $state));
    }

    
}

