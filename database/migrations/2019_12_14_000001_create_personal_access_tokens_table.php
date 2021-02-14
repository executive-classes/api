<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Token id.');
            $table->morphs('tokenable');
            $table->string('name')->comment('Token name.');
            $table->string('token', 64)->unique()->comment('Token hash.');
            $table->text('abilities')->nullable()->comment('Token privileges.');
            $table->timestamp('last_used_at')->nullable()->comment('Last token use.');
            $table->timestamps();
            $table->text('language')->default('en')->comment('Token language.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }
}
