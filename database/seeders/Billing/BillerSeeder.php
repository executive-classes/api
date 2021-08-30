<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Biller\Biller;
use Database\Seeders\Seeder;

class BillerSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creating biller for every tax
        Biller::factory()->persist()->cnpj()->create();
        Biller::factory()->persist()->cpf()->create();

        // Creating biller for every status
        Biller::factory()->persist()->active()->create();
        Biller::factory()->persist()->suspended()->create();
        Biller::factory()->persist()->canceled()->create();
        Biller::factory()->persist()->inactive()->create();

        // Creating biller for every payment method
        Biller::factory()->persist()->credit_card()->create();
        Biller::factory()->persist()->bank_slip()->create();
        Biller::factory()->persist()->pix()->create();
        Biller::factory()->persist()->deposit()->create();
        Biller::factory()->persist()->transfer()->create();

        // Creating biller for every payment interval
        Biller::factory()->persist()->mensal()->create();
        Biller::factory()->persist()->bimestral()->create();
        Biller::factory()->persist()->trimestral()->create();
        Biller::factory()->persist()->semestral()->create();
        Biller::factory()->persist()->anual()->create();
        Biller::factory()->persist()->bianual()->create();
    }
}