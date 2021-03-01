<?php

namespace Database\Seeders\Billing;

use App\Models\Billing\Collection;
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
        $collections = Collection::with('biller.students')->get();
        
        foreach ($collections as $collection) {
            foreach ($collection->biller->students as $student) {
                CollectionItem::factory()
                    ->for($collection, 'collection')
                    ->for($student, 'student')
                    ->create();
            }
        }
    }
}