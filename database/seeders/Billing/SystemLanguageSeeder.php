<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\SystemLanguage;
use Illuminate\Database\Seeder;

class SystemLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(SystemLanguage::EN, 'Inglês');
        $this->create(SystemLanguage::PT_BR, 'Português (Brasil)');
    }

    /**
     * Create the System Language entry.
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name)
    {
        $language = new SystemLanguage(compact('id', 'name'));
        $language->save();
    }
}
