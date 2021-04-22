<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creating table
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            // PK
            $table->bigIncrements('id')
                ->comment('Token ID.');

            // Timestamps
            $table->timestamps();

            $table->timestamp('last_used_at')
                ->nullable()
                ->comment('Last token use.');

            // Token data
            $table->morphs('tokenable');

            $table->string('name')
                ->comment('Token name.');

            $table->string('token', 64)
                ->unique()->comment('Token hash.');

            $table->text('abilities')
                ->nullable()
                ->comment('Token privileges.');
        });

        // Adding columns comments
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Message template creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Message template update date')
                ->change();
            
            // Token data comments
            $table->string('tokenable_type')
                ->comment('Model of the user that generate the token.')
                ->change();
                
            $table->bigInteger('tokenable_id')
                ->comment('ID of the user that generate the token.')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }
}
