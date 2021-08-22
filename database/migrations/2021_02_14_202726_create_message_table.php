<?php

use App\Models\Mailing\MessageStatus\MessageStatus;
use App\Enums\Mailing\MessageStatusEnum;
use App\Models\Mailing\MessageTemplate\MessageTemplate;
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
            // PK
            $table->id()
                ->comment('Message ID.');

            // Timestamps
            $table->timestamp('created_at')
                ->useCurrent()
                ->nullable()
                ->comment('Creation date of the message.');

            $table->timestamp('sent_at')
                ->nullable()
                ->comment('Sent date of the message.');

            $table->timestamp('should_proccess_at')
                ->useCurrent()
                ->nullable()
                ->comment('Date and time that the message should be sent.');

            // Message data
            $table->foreignIdFor(MessageStatus::class, 'message_status_id')
                ->default(MessageStatusEnum::SCHEDULED)
                ->references('id')
                ->on('message_status')
                ->comment('Status of the message.');

            $table->string('reply_to')
                ->comment('Message sender email.');

            $table->string('to')
                ->comment('Message recipients.');

            $table->string('cc')
                ->nullable()
                ->comment('Copy recipients of the message.');

            $table->string('bcc')
                ->nullable()
                ->comment('Blind copy recipients of the message.');

            $table->string('subject')
                ->nullable()
                ->comment('Message subject.');

            $table->longText('content')
                ->nullable()
                ->comment('Message content, in HTML.');
            
            // Message template data
            $table->foreignIdFor(MessageTemplate::class, 'message_template_id')
                ->nullable()
                ->references('id')
                ->on('message_template')
                ->comment('Message template, used to generate the subject and the content.');

            $table->json('params')
                ->nullable()
                ->comment('Message params use to generate the content.');
            
            // Message error data
            $table->integer('retries')
                ->default(5)
                ->comment('Number of attempts to send the message.');

            $table->string('error_message')
                ->nullable()
                ->comment('The last error message.');
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
