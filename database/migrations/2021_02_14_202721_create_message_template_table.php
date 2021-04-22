<?php

use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use App\Models\Mailing\MessageType;
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
            $table->string('id')
                ->comment('Message template ID.');

            $table->primary('id');

            // Timestamps
            $table->timestamps();

            // Template data
            $table->foreignIdFor(MessageType::class, 'message_type_id')
                ->references('id')
                ->on('message_type')
                ->comment('Type of the template.');

            $table->string('description')
                ->comment('Message template description.');

            $table->string('subject')
                ->comment('Message template subject.');

            $table->longText('content')
                ->comment('Message template content, in HTML.');

            $table->foreignIdFor(MessageHeader::class, 'message_header_id')
                ->references('id')
                ->on('message_header')
                ->comment('Header of the template.');

            $table->foreignIdFor(MessageFooter::class, 'message_footer_id')
                ->references('id')
                ->on('message_footer')
                ->comment('Footer of the template.');
        });

        // Adding columns comments.
        Schema::table('message_template', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Message template creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Message template update date.')
                ->change();
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