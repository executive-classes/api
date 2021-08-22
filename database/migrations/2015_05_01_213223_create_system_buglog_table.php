<?php

use App\Models\Billing\User\User;
use App\Models\System\SystemApp\SystemApp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemBuglogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_buglog', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Bug Id.');
            
            // Data
            $table->timestamp('date')
                ->useCurrent()
                ->comment('When the bug occurred.');
            
            $table->foreignIdFor(User::class, 'user_id')
                ->nullable()
                ->references('id')
                ->on('user')
                ->comment('Who had the bug.');
            
            $table->foreignIdFor(User::class, 'cross_user_id')
                ->nullable()
                ->references('id')
                ->on('user')
                ->comment('User that made the change, by cross auth.');
            
            $table->string('agent')
                ->comment('Application that had the bug.');

            $table->string('url')
                ->comment('The URL of the bug.');
                
            $table->string('method')
                ->comment('The method of the bug.');

            $table->boolean('ajax')
                ->nullable()
                ->comment('Indicates if the bug was made by ajax.');

            $table->foreignIdFor(SystemApp::class, 'app_id')
                ->references('id')
                ->on('system_app')
                ->comment('The application that had the bug.');

            $table->string('route')
                ->comment('The route that had the bug.');
            
            $table->json('data')
                ->nullable()
                ->comment('The data of the request that had the bug.');

            $table->json('error')
                ->comment('The bug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_buglog');
    }
}
