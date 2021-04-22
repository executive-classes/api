<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\CollectionItem;
use Illuminate\Database\Seeder;

class CollectionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CollectionItem::factory()->create();
    }
}