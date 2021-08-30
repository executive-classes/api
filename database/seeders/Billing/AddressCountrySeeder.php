<?php

namespace Database\Seeders\Billing;

use Database\Seeders\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AddressCountrySeeder extends Seeder
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
     * @see https://github.com/chinnonsantos/sql-paises-estados-cidades/blob/master/MySQL/pais.sql
     */
    private function getSql(): string
    {
        return Storage::disk('resource')->get('sql/countries.sql');
    }
}