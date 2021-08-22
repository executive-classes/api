<?php

namespace Database\Seeders\Mailing;

use App\Enums\Mailing\MessageTypeEnum;
use App\Models\Mailing\MessageType\MessageType;
use Illuminate\Database\Seeder;

class MessageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(MessageTypeEnum::BILLING, 'Cobrança');
        $this->create(MessageTypeEnum::WARNING, 'Aviso');
    }

    /**
     * Create the Message Type entry;
     *
     * @param string $id
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $description): void
    {
        $messageType = new MessageType(compact('id', 'description'));
        $messageType->save();
    }
}
