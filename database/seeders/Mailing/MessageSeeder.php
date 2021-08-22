<?php

namespace Database\Seeders\Mailing;

use App\Models\Mailing\Message\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::factory()->create();
    }
}
