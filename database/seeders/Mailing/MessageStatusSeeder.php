<?php

namespace Database\Seeders\Mailing;

use App\Models\Eloquent\Mailing\MessageStatus\MessageStatus;
use App\Enums\Mailing\MessageStatusEnum;
use Database\Seeders\Seeder;

class MessageStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(MessageStatusEnum::SENT);
        $this->create(MessageStatusEnum::CANCELED);
        $this->create(MessageStatusEnum::SCHEDULED);
        $this->create(MessageStatusEnum::ERROR);
    }

    /**
     * Create the Message Status entry;
     *
     * @param string $id
     * @return void
     */
    protected function create(string $id): void
    {
        $messageStatus = new MessageStatus(compact('id'));
        $messageStatus->save();
    }
}
