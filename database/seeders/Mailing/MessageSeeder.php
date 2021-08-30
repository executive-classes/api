<?php

namespace Database\Seeders\Mailing;

use App\Models\Eloquent\Mailing\Message\Message;
use Database\Seeders\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creating message for every status
        Message::factory()->persist()->scheduled()->create();
        Message::factory()->persist()->sent()->create();
        Message::factory()->persist()->canceled()->create();
        Message::factory()->persist()->error()->create();
    }
}
