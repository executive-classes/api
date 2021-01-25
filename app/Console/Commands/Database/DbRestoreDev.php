<?php

namespace App\Console\Commands\Database;

use App\Console\Command;

class DbRestoreDev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restore-dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore the production dump to the local database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->alert('Updating local database');

        if (isProduction()) {
            $this->block("There's no way to restore a local database in production server", 'No Actions!', 'fg=black;bg=yellow', ' ! ', true);
            return;
        } 

        system('php vendor/bin/envoy run db-update-dev');

        $this->block("Updated :)", 'SUCCESS!', 'fg=black;bg=green', ' ! ', true);
    }
}
