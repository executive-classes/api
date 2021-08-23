<?php

use App\Models\Eloquent\Billing\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemAccesslogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_accesslog', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Access Id.');
            
            // Data
            $table->timestamp('date')
                ->useCurrent()
                ->comment('Date that the access was made.');
            
            $table->foreignIdFor(User::class, 'user_id')
                ->nullable()
                ->references('id')
                ->on('user')
                ->comment('User that made the access.');
            
            $table->foreignIdFor(User::class, 'cross_user_id')
                ->nullable()
                ->references('id')
                ->on('user')
                ->comment('User that made the change, by cross auth.');
            
            $table->string('agent')
                ->comment('User-Agent that made the access.');
            
            $table->string('method')
                ->comment('The method of the request.');

            $table->string('url')
                ->comment('The URL of the request.');
            
            $table->string('route')
                ->nullable()
                ->comment('The route of the request.');
                
            $table->boolean('ajax')
                ->nullable()
                ->comment('Indicates if the access was made by ajax.');
            
            $table->boolean('allowed')
                ->nullable()
                ->comment('Indicates if the access was allowed.');
            
            $table->smallInteger('code')
                ->nullable()
                ->comment('Indicates if the access was allowed.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_accesslog');
    }
}
