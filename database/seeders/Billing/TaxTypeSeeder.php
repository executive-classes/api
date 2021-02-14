<?php

namespace Database\Seeders\Billing;

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
        $this->create('cnpj', 'CNPJ', '##.###.###/####-##');
        $this->create('cpf', 'CPF', '###.###.###-##');
        $this->create('rg', 'RG', '##.###.###-#');
    }

    /**
     * Create the Tax Type entry.
     *
     * @param string $id
     * @param string $name
     * @param string $pattern
     * @return void
     */
    protected function create(string $id, string $name, string $pattern)
    {
        $taxType = new TaxType(compact('id', 'name', 'pattern'));
        $taxType->save();
    }
}
