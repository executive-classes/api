<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_header', function (Blueprint $table) {
            $table->string('id')->comment('Header ID.');
            $table->timestamps();
            $table->string('description')->comment('Header description');
            $table->longText('content')->comment('Message header content, in HTML.');
            
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
        Schema::dropIfExists('message_header');
    }
}
