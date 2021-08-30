<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Collection\Collection;
use Database\Seeders\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creating collection for every status
        Collection::factory()->persist()->payed()->create();
        Collection::factory()->persist()->charged()->create();
        Collection::factory()->persist()->scheduled()->create();
        Collection::factory()->persist()->postponed()->create();
        Collection::factory()->persist()->canceled()->create();
        Collection::factory()->persist()->error()->create();

        // Creating collection for every payment method
        Collection::factory()->persist()->credit_card(true)->create();
        Collection::factory()->persist()->bank_slip()->create();
        Collection::factory()->persist()->pix()->create();
        Collection::factory()->persist()->deposit()->create();
        Collection::factory()->persist()->transfer()->create();

        // Creating collection for every payment interval
        Collection::factory()->persist()->mensal()->create();
        Collection::factory()->persist()->bimestral()->create();
        Collection::factory()->persist()->trimestral()->create();
        Collection::factory()->persist()->semestral()->create();
        Collection::factory()->persist()->anual()->create();
        Collection::factory()->persist()->bianual()->create();
    }
}