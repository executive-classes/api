<?php

namespace Database\Seeders\Mailing;

use App\Models\Mailing\MessageFooter;
use Illuminate\Database\Seeder;

class MessageFooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create('test', 'Test Footer', '<h1>Titulo</h1>');
    }

    /**
     * Create the Message Footer entry;
     *
     * @param string $id
     * @param string $description
     * @param string $content
     * @return void
     */
    protected function create(string $id, string $description, string $content): void
    {
        $messageFooter = new MessageFooter(compact('id', 'description', 'content'));
        $messageFooter->save();
    }
}
