<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('sent_at')->nullable()->comment('Sent date of the message.');
            $table->timestamp('should_proccess_at')->useCurrent()->nullable()->comment('Date and time that the message should be sent.');
            $table->string('message_status_id')->default('scheduled')->comment('Status of the message.');
            $table->string('reply_to')->comment('Message sender email.');
            $table->string('to')->comment('Message recipients.');
            $table->string('cc')->nullable()->comment('Copy recipients of the message.');
            $table->string('bcc')->nullable()->comment('Blind copy recipients of the message.');
            $table->string('subject')->comment('Message subject.');
            $table->longText('content')->nullable()->comment('Message content, in HTML.');
            $table->string('message_template_id')->nullable()->comment('Message template, used to generate the subject and the content.');
            $table->json('params')->nullable()->comment('Message params use to generate the content.');

            $table->foreign('message_template_id')->references('id')->on('message_template');
            $table->foreign('message_status_id')->references('id')->on('message_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}