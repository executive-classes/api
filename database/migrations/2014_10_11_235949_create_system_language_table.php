<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_language', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('System Language Id.');

            $table->primary('id');

            // Language data
            $table->string('name')
                ->comment('System Language Name.');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_language');
    }
}
