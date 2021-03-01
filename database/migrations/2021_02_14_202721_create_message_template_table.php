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
        // Creating table.
        Schema::create('message_template', function (Blueprint $table) {
            // PK
            $table->string('id')->comment('Message template ID.');
            $table->primary('id');

            // Timestamps
            $table->timestamps();

            // Template data
            $table->string('message_type_id')->comment('Type of the template.');
            $table->string('description')->comment('Message template description.');
            $table->string('subject')->comment('Message template subject.');
            $table->longText('content')->comment('Message template content, in HTML.');
            $table->string('message_header_id')->comment('Header of the template.');
            $table->string('message_footer_id')->comment('Footer of the template.');
                
            // Foreign keys
            $table->foreign('message_type_id')->references('id')->on('message_type');
            $table->foreign('message_header_id')->references('id')->on('message_header');
            $table->foreign('message_footer_id')->references('id')->on('message_footer');
        });

        // Adding columns comments.
        Schema::table('message_template', function (Blueprint $table) {
            $table->timestamp('created_at')->comment('Message template creation date.')->change();
            $table->timestamp('updated_at')->comment('Message template update date')->change();
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