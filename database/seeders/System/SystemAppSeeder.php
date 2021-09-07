<?php

namespace Database\Seeders\System;

use App\Enums\System\SystemAppEnum;
use App\Models\Eloquent\System\SystemApp\SystemApp;
use Database\Seeders\Seeder;

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
            true, 
            '151.106.98.14', 
            'https://executiveclasses.com.br'
        );
        
        $this->create(
            SystemAppEnum::PORTAL, 
            'Portal', 
            true, 
            '151.106.98.14', 
            'https://portal.executiveclasses.com.br'
        );

        $this->create(
            SystemAppEnum::API, 
            'API', 
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
     * @param boolean $active
     * @param string $ip
     * @param string $url
     * @return void
     */
    protected function create(string $id, string $name, bool $active, string $ip, string $url)
    {
        $app = new SystemApp(compact('id', 'name', 'active', 'ip', 'url'));
        $app->save();
    }
}
