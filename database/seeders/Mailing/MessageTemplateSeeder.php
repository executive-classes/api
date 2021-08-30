<?php

namespace Database\Seeders\Mailing;

use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;
use Database\Seeders\Seeder;

class MessageTemplateSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        MessageTemplate::factory(5)->persist()->create();
    }
}
