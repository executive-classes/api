<?php

namespace Database\Seeders\Mailing;

use App\Enums\Mailing\MessageTypeEnum;
use App\Models\Eloquent\Mailing\MessageType\MessageType;
use Database\Seeders\Seeder;

class MessageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(MessageTypeEnum::BILLING);
        $this->create(MessageTypeEnum::WARNING);
    }

    /**
     * Create the Message Type entry;
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id): void
    {
        $messageType = new MessageType(compact('id'));
        $messageType->save();
    }
}
