<?php

namespace Database\Seeders\Billing;

use App\Enums\Billing\BillerStatusEnum;
use App\Models\Eloquent\Billing\BillerStatus\BillerStatus;
use Database\Seeders\Seeder;

class BillerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(BillerStatusEnum::ACTIVE);
        $this->create(BillerStatusEnum::SUSPENDED);
        $this->create(BillerStatusEnum::CANCELED);
        $this->create(BillerStatusEnum::INACTIVE);
    }

    /**
     * Create a Biller Status entry.
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id)
    {
        $billerStatus = new BillerStatus(compact('id'));
        $billerStatus->save();
    }
}
