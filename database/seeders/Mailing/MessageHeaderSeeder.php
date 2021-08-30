<?php

namespace Database\Seeders\Mailing;

use App\Models\Eloquent\Mailing\MessageHeader\MessageHeader;
use Database\Seeders\Seeder;

class MessageHeaderSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        MessageHeader::factory()->persist()->create();
    }
}
