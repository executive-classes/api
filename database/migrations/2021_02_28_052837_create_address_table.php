<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Address ID.');

            // Timestamps
            $table->timestamps();

            // Address Data
            $table->string('zip')
                ->comment('Zip Code.');

            $table->string('street')
                ->comment('Address.');

            $table->string('number', 10)
                ->nullable()
                ->comment('Address Number.');

            $table->string('complement', 255)
                ->nullable()
                ->comment('Address complement.');

            $table->string('district')
                ->nullable()
                ->comment('Address district.');

            $table->string('city')
                ->comment('City.');

            $table->string('state', 2)
                ->comment('State.');

            $table->string('country')
                ->comment('Country.');
        });

        // Adding columns comments.
        Schema::table('address', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Address creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Address update date')
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
        Schema::dropIfExists('address');
    }
}
