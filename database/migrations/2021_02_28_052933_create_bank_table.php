<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank', function (Blueprint $table) {
            // PK
            $table->id()->comment('Bank details ID');

            // Bank data
            $table->unsignedSmallInteger('bank_code')->comment();
            $table->unsignedSmallInteger('agency')->comment();
            $table->string('account')->comment();

            // Unique index
            $table->index(['bank_code', 'agency', 'account']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank');
    }
}
