<?php

namespace Tests\Unit\Models;

use Illuminate\Support\Str;
use App\Enums\Billing\TaxTypeEnum;
use Illuminate\Database\Eloquent\Model;

trait HasTaxAsserts
{
    /**
     * Assert that the model has the tax methods.
     *
     * @param Model $model
     * @return void
     */
    public function assertTaxHasAndGetFunctions(Model $model)
    {
        foreach (TaxTypeEnum::getValues() as $doc) {
            $hasError = "Failed on checking '$doc' has method";
            $getError = "Failed on checking '$doc' get method";
            
            $model->tax_type_id = $doc;
            $model->tax_code = '123456789';

            $hasMethod = 'has' . Str::ucfirst($doc);
            $this->assertTrue($model->$hasMethod(), $hasError);

            $getMethod = 'get' . Str::ucfirst($doc);
            $this->assertEquals($model->tax_code, $model->$getMethod(), $getError);
        }
    }

    public function test_tax_functions()
    {
        $this->assertTaxHasAndGetFunctions($this->model);
    }

    public function test_tax_mutators()
    {
        $this->assertModelMutator($this->model, 'tax_code', '123.456.789-12', '12345678912');
        $this->assertModelMutator($this->model, 'tax_code_alt', '123.456.789-12', '12345678912');
        $this->assertModelMutator($this->model, 'tax_code_alt', null, null, true);
    }
}
