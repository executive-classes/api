<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_country', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Country ID (Bacen).');

            // Country Data
            $table->string('short_name', 2)
                ->nullable()
                ->comment('Country short name.');

            // Country Data
            $table->boolean('active')
                ->default(false)
                ->comment('Country can be selected.');

            $table->string('name', 255)
                ->comment('Country name.');

            $table->string('name_pt', 255)
                ->comment('Country portuguese name.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_country');
    }
}
