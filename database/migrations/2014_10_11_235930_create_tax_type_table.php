<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_type', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Tax type ID.');

            $table->primary('id');

            // Tax type data
            $table->string('name')
                ->comment('Tax type name.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_type');
    }
}
