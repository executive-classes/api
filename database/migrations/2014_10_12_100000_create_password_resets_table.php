<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            // Reset data
            $table->string('email')
                ->index()
                ->comment('User e-mail.');

            $table->string('token')
                ->comment('Password reset token.');

            // Timestamp
            $table->timestamp('created_at')
                ->nullable()
                ->comment("Creation date of the token.");
            
            // Foreign keys
            $table->foreign('email')
                ->references('email')
                ->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
