<?php

use App\Models\Billing\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemAuditlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_auditlog', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Audit Id.');
            
            // Data
            $table->timestamp('date')
                ->useCurrent()
                ->comment('Date that the change was made.');
            
            $table->foreignIdFor(User::class, 'user_id')
                ->nullable()
                ->references('id')
                ->on('user')
                ->comment('User that made the change.');
            
            $table->foreignIdFor(User::class, 'cross_user_id')
                ->nullable()
                ->references('id')
                ->on('user')
                ->comment('User that made the change, by cross auth.');
            
            $table->json('relations')
                ->nullable()
                ->comment('Relations of the change.');
            
            $table->string('agent')
                ->comment('User-Agent that made the change.');
            
            $table->string('method')
                ->comment('The method of the change request.');
                
            $table->string('url')
                ->comment('The URL of the change request.');

            $table->string('route')
                ->comment('The route of the change request.');
            
            $table->boolean('ajax')
                ->comment('Indicates if the change request was made by ajax.');

            $table->string('type')
                ->comment('Type of the change.');
            
            $table->string('table')
                ->comment('Table that have changed.');

            $table->json('before')
                ->nullable()
                ->comment('Values before the change.');
            
            $table->json('after')
                ->nullable()
                ->comment('Values after the change.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_auditlog');
    }
}
