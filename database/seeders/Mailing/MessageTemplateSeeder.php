<?php

namespace Database\Seeders\Mailing;

use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use App\Models\Mailing\MessageTemplate;
use App\Models\Mailing\MessageType;
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
        MessageTemplate::factory()
            ->for(MessageType::find('billing'), 'type')
            ->for(MessageHeader::find('test'), 'header')
            ->for(MessageFooter::find('test'), 'footer')
            ->create();
    }
}
