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
            $table->id()
                ->comment('Building ID.');

            // Timestamps
            $table->timestamps();

            // Building Data
            $table->string('zip_code')
                ->comment('Zip Code.');

            $table->string('street')
                ->comment('Address.');

            $table->string('number')
                ->nullable()
                ->comment('Address Number.');

            $table->string('complement')
                ->nullable()
                ->comment('Address complement.');

            $table->string('district')
                ->comment('Address district.');

            $table->string('city')
                ->comment('City.');

            $table->integer('city_code')
                ->comment('City code used in Invoice.');

            $table->string('state', 2)
                ->comment('State.');

            $table->integer('state_code')
                ->comment('State code used in Invoice.');

            $table->string('country')
                ->comment('Country.');

            $table->integer('country_code')
                ->comment('Country code used in Invoice.');
        });

        // Adding columns comments.
        Schema::table('building', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Building creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Building update date')
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
        Schema::dropIfExists('building');
    }
}
