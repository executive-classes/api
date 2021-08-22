<?php

namespace Database\Seeders\System;

use App\Enums\System\SystemAppEnum;
use App\Models\System\SystemApp\SystemApp;
use Illuminate\Database\Seeder;

class SystemAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(
            SystemAppEnum::SITE, 
            'Site', 
            'Executive Classes landing page.',
            true, 
            '151.106.98.14', 
            'https://executiveclasses.com.br'
        );
        
        $this->create(
            SystemAppEnum::PORTAL, 
            'Portal', 
            'Executive Classes portal for customers, teachers and employees.',
            true, 
            '151.106.98.14', 
            'https://portal.executiveclasses.com.br'
        );

        $this->create(
            SystemAppEnum::API, 
            'API', 
            'Executive Classes API.',
            true, 
            '151.106.98.14', 
            'https://api.executiveclasses.com.br'
        );
    }

    /**
     * Create the System Language entry.
     *
     * @param string $id
     * @param string $name
     * @return void
     */
    protected function create(string $id, string $name, string $description, bool $active, string $ip, string $url)
    {
        $app = new SystemApp(compact('id', 'name', 'description', 'active', 'ip', 'url'));
        $app->save();
    }
}
