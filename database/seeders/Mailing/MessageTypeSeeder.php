<?php

namespace Database\Seeders\Mailing;

use App\Models\Mailing\MessageType;
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
        $this->create(MessageType::BILLING, 'Cobrança');
        $this->create(MessageType::WARNING, 'Aviso');
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
