<?php

namespace Database\Seeders\Mailing;

use App\Models\Eloquent\Mailing\MessageFooter\MessageFooter;
use Database\Seeders\Seeder;

class MessageFooterSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        MessageFooter::factory()->persist()->create();
    }
}
