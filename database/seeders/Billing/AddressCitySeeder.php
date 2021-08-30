<?php

namespace Database\Seeders\Billing;

use Database\Seeders\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AddressCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = $this->getSql();
        DB::insert($sql);
    }

    /**
     * Get the SQL file.
     *
     * @return string
     * @see https://github.com/kelvins/Municipios-Brasileiros
     */
    private function getSql(): string
    {
        return Storage::disk('resource')->get('sql/cities.sql');
    }
}