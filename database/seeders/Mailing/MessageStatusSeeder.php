<?php

namespace Database\Seeders\Mailing;

use App\Models\Mailing\MessageStatus;
use App\Enums\Mailing\MessageStatusEnum;
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
        $this->create(MessageStatusEnum::SENT, 'Enviada');
        $this->create(MessageStatusEnum::CANCELED, 'Cancelada');
        $this->create(MessageStatusEnum::SCHEDULED, 'Agendada');
        $this->create(MessageStatusEnum::ERROR, 'Erro');
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
