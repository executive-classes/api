<?php

namespace Database\Seeders\Mailing;

use App\Models\Mailing\MessageStatus;
use Illuminate\Database\Seeder;

class MessageStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(MessageStatus::SENT, 'Enviada');
        $this->create(MessageStatus::CANCELED, 'Cancelada');
        $this->create(MessageStatus::SCHEDULED, 'Agendada');
        $this->create(MessageStatus::ERROR, 'Erro');
    }

    /**
     * Create the Message Status entry;
     *
     * @param string $id
     * @param string $description
     * @return void
     */
    protected function create(string $id, string $description): void
    {
        $messageStatus = new MessageStatus(compact('id', 'description'));
        $messageStatus->save();
    }
}
