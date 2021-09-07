<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\TaxTypeEnum;
use App\Models\Eloquent\Billing\TaxType\TaxType;
use Database\Seeders\Seeder;

class TaxTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(TaxTypeEnum::CNPJ, 1, '##.###.###/####-##');
        $this->create(TaxTypeEnum::CPF, 1, '###.###.###-##');
        $this->create(TaxTypeEnum::RG, 2, '##.###.###-X');
        $this->create(TaxTypeEnum::IE, 2);
    }

    /**
     * Create the Tax Type entry.
     *
     * @param string $id
     * @param integer $priority
     * @param string|null $pattern
     * @return void
     */
    protected function create(string $id, int $priority, string $pattern = null)
    {
        $taxType = new TaxType(compact('id', 'priority', 'pattern'));
        $taxType->save();
    }
}
