<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building', function (Blueprint $table) {
            // PK
            $table->id()->comment('Building ID.');

            // Timestamps
            $table->timestamps();

            // Building Data
            $table->string('zip_code')->comment('Zip Code.');
            $table->string('address')->comment('Address.');
            $table->string('number')->nullable()->comment('Address Number.');
            $table->string('complement')->nullable()->comment('Address complement.');
            $table->string('city')->comment('City.');
            $table->string('state', 2)->comment('State.');
            $table->string('country')->comment('Country.');
        });

        // Adding columns comments.
        Schema::table('building', function (Blueprint $table) {
            $table->timestamp('created_at')->comment('Building creation date.')->change();
            $table->timestamp('updated_at')->comment('Building update date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('building');
    }
}
