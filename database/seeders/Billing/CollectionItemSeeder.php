<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\CollectionItem\CollectionItem;
use Database\Seeders\Seeder;

class CollectionItemSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        CollectionItem::factory(5)->persist()->create();
    }
}