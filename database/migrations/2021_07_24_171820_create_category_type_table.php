<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_type', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Category type id.');

            $table->primary('id');

            // Data
            $table->string('name')
                ->comment('Category type name.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_type');
    }
}
