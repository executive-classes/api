<?php

namespace App\Console\Commands\Database;

use App\Console\Command;

class DbDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Do the production database dump';

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
        $this->alert('Dumping production database');

        $command = isProduction() 
            ? $this->makeDumpCommand()
            : 'php vendor/bin/envoy run db-dump';

        system($command);

        $this->block("Dumped :)", 'SUCCESS!', 'fg=black;bg=green', ' ! ', true);
    }

    /**
     * Generate the dump command using the database config.
     *
     * @return string
     */
    protected function makeDumpCommand(): string
    {
        $data = getDbDumpData();
        $command = 'mysqldump -u %s -p\'%s\' %s %s > %s.sql && rm -f %s';

        return printf(
            $command, 
            $data['username'], 
            $data['password'], 
            $data['database'], 
            $data['dump_excluded'], 
            $data['dump_folder'] . $data['dump_file'],
            $data['dump_folder'] . $data['remove_file']
        );
    }
}
