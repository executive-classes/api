<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_footer', function (Blueprint $table) {
            $table->string('id')->comment('Footer ID.');
            $table->timestamps();
            $table->string('description')->comment('Footer description.');
            $table->longText('content')->comment('Footer content, in HTML.');
            
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
        Schema::dropIfExists('message_footer');
    }
}
