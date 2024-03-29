<?php

namespace Database\Seeders\Mailing;

use App\Models\Mailing\MessageHeader;
use Illuminate\Database\Seeder;

class MessageHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MessageHeader::factory()->create();
    }
}
