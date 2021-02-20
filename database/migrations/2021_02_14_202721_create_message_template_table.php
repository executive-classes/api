<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_template', function (Blueprint $table) {
            $table->string('id')->comment('Message template ID.');
            $table->timestamps();
            $table->string('description')->comment('Message template description.');
            $table->string('subject')->comment('Message template subject.');
            $table->longText('content')->comment('Message template content, in HTML.');
            $table->string('message_type_id')->comment('Type of the template.');
            $table->string('message_header_id')->comment('Header of the template.');
            $table->string('message_footer_id')->comment('Footer of the template.');
                
            $table->primary('id');

            $table->foreign('message_type_id')->references('id')->on('message_type');
            $table->foreign('message_header_id')->references('id')->on('message_header');
            $table->foreign('message_footer_id')->references('id')->on('message_footer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_template');
    }
}