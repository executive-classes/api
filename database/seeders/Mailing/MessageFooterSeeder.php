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
        MessageFooter::factory()->create();
    }
}
