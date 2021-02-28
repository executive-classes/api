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
        // Creating table.
        Schema::create('message_footer', function (Blueprint $table) {
            // PK
            $table->string('id')->comment('Footer ID.');
            $table->primary('id');
            
            // Timestamp
            $table->timestamps();
            
            // Message footer data
            $table->string('description')->comment('Footer description.');
            $table->longText('content')->comment('Footer content, in HTML.');
        });

        // Adding columns comments.
        Schema::table('message_footer', function (Blueprint $table) {
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
        Schema::dropIfExists('message_footer');
    }
}
