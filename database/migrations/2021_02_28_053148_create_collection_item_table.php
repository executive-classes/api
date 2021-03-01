<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_item', function (Blueprint $table) {
            // PK
            $table->id()->comment('Collection Item ID.');

            // Timestamps
            $table->timestamp('created_at')->nullable()->comment('Collection item creation date.');
            $table->timestamp('updated_at')->nullable()->comment('Collection item last update date.');

            // Item data
            $table->unsignedBigInteger('collection_id')->comment('Collection of this item.');
            $table->unsignedBigInteger('student_id')->comment('Student of this item.');
            $table->double('value')->comment('Value of this item.');

            // Foreign Key
            $table->foreign('collection_id')->references('id')->on('collection');
            $table->foreign('student_id')->references('id')->on('student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_item');
    }
}
