<?php

use App\Models\Eloquent\Billing\AddressState\AddressState;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_city', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('City ID.');

            // City Data
            $table->string('name', 255)
                ->comment('City name.');

            $table->boolean('capital')
                ->comment('Indicate if a city is capital of its state.');

            $table->foreignIdFor(AddressState::class, 'state_id')
                ->references('id')
                ->on('address_state')
                ->comment('Determine the state of the city.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_city');
    }
}
