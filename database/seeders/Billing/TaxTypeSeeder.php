<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\TaxTypeEnum;
use App\Models\Billing\TaxType\TaxType;
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
        $this->create(TaxTypeEnum::CNPJ, 'CNPJ', 1, '##.###.###/####-##');
        $this->create(TaxTypeEnum::CPF, 'CPF', 1, '###.###.###-##');
        $this->create(TaxTypeEnum::RG, 'RG', 2, '##.###.###-X');
        $this->create(TaxTypeEnum::IE, 'IE', 2);
    }

    /**
     * Create the Tax Type entry.
     *
     * @param string $id
     * @param string $name
     * @param string $pattern
     * @return void
     */
    protected function create(string $id, string $name, int $priority, string $pattern = null)
    {
        $taxType = new TaxType(compact('id', 'name', 'priority', 'pattern'));
        $taxType->save();
    }
}
