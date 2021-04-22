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
        // Creating table.
        Schema::create('message_header', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Header ID.');
            $table->primary('id');

            // Timestamp
            $table->timestamps();
            
            // Message header data
            $table->string('description')
                ->comment('Header description');

            $table->longText('content')
                ->comment('Message header content, in HTML.');
        });

        // Adding columns comments.
        Schema::table('message_header', function (Blueprint $table) {
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
        Schema::dropIfExists('message_header');
    }
}
