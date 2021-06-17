<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_state', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('State ID.');

            // State Data
            $table->string('short_name', 2)
                ->comment('State short name.');

            $table->string('name', 255)
                ->comment('State name.');

            $table->string('ie_mask', 255)
                ->nullable()
                ->comment('State IE Mask.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_state');
    }
}
