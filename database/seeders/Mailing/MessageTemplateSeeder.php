<?php

namespace Database\Seeders\Mailing;

use App\Models\Mailing\MessageTemplate\MessageTemplate;
use Illuminate\Database\Seeder;

class MessageTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MessageTemplate::factory()->create();
    }
}
