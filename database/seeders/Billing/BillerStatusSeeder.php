<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\BillerStatus;
use Illuminate\Database\Seeder;

class BillerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(BillerStatus::ACTIVE, 'Ativo', 'Indicates that a biller is active and realize its payments.');
    }

    /**
     * Create a Biller Status entry.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $name, string $description)
    {
        $billerStatus = new BillerStatus(compact('id', 'name', 'description'));
        $billerStatus->save();
    }
}
