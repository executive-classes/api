<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder as DefaultSeeder;

class Seeder extends DefaultSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (isLocal()) {
            $this->local();
        }

        if (isTest()) {
            $this->test();
        }
    }

    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        //
    }

    /**
     * Run the test database seeds.
     *
     * @return void
     */
    protected function test()
    {
        //
    }
}