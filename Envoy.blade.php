@servers(['ec_prod' => 'u737844224@151.106.98.0 -p 65002', 'ec_db_dev' => 'admin@10.10.2.20'])

@setup
    /**
     * Fix for the classes not found error in Envoy
     * @source https://stackoverflow.com/questions/57141708/laravel-envoy-class-config-does-not-exist
     */
    define('LARAVEL_START', microtime(true));
    $app = require_once __DIR__.'/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
@endsetup

@story('db-update-dev')
    db-dump
    db-restore-dev
@endstory

@task('db-dump', ['on' => 'ec_prod'])
    @php $data = getDbDumpData(); @endphp

    cd ~/database/dump
    mysqldump -u {{ $data['username'] }} -p'{{ $data['password'] }}' {{ $data['database'] }} {{ $data['dump_excluded'] }} > {{ $data['dump_folder'] . "dump.sql" }}
@endtask

@task('db-restore-dev', ['on' => 'ec_db_dev'])
    @php $data = getDbDumpData(false); @endphp

    sshpass -p '{{ env('HOSTING_PASSWORD', '') }}' scp -o "StrictHostKeyChecking no" -P 65002 u737844224@151.106.98.0:database/dump/dump.sql .
    mysql -u {{ $data['username'] }} -p'{{ $data['password'] }}' {{ $data['database'] }} < dump.sql
@endtask