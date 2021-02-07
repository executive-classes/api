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
            $table->string('id')->comment('ID do tipo de documento.');
            $table->string('name')->comment('Nome do tipo de documento.');
            $table->string('pattern')->comment('Padrão do tipo de documento.');

            $table->primary('id');
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
