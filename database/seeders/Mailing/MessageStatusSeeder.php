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
        $this->create('sent', 'Enviada');
        $this->create('canceled', 'Cancelada');
        $this->create('scheduled', 'Cancelada');
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
