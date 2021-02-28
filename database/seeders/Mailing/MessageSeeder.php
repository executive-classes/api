<?php

namespace Database\Seeders\Mailing;

use App\Models\Mailing\Message;
use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use App\Models\Mailing\MessageStatus;
use App\Models\Mailing\MessageTemplate;
use App\Models\Mailing\MessageType;
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
        Message::factory()
            ->for(MessageTemplate::find('test'), 'template')
            ->for(MessageStatus::find('scheduled'), 'status')
            ->create();
    }
}
