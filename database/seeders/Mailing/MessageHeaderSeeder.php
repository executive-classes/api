<?php

namespace Database\Seeders\Mailing;

use App\Models\Mailing\MessageHeader;
use Illuminate\Database\Seeder;

class MessageHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create('test', 'Test Header', '<h1>Titulo</h1>');
    }

    /**
     * Create the Message Header entry;
     *
     * @param string $id
     * @param string $description
     * @param string $content
     * @return void
     */
    protected function create(string $id, string $description, string $content): void
    {
        $messageHeader = new MessageHeader(compact('id', 'description', 'content'));
        $messageHeader->save();
    }
}
