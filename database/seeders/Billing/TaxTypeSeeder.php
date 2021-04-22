<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\TaxTypeEnum;
use App\Models\Billing\TaxType;
use Illuminate\Database\Seeder;

class TaxTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(TaxTypeEnum::CNPJ, 'CNPJ', '##.###.###/####-##');
        $this->create(TaxTypeEnum::CPF, 'CPF', '###.###.###-##');
        $this->create(TaxTypeEnum::RG, 'RG', '##.###.###-#');
        $this->create(TaxTypeEnum::IE, 'IE');
    }

    /**
     * Create the Tax Type entry.
     *
     * @param string $id
     * @param string $name
     * @param string $pattern
     * @return void
     */
    protected function create(string $id, string $name, string $pattern = null)
    {
        $taxType = new TaxType(compact('id', 'name', 'pattern'));
        $taxType->save();
    }
}
