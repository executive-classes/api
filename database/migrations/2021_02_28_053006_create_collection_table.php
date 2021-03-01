<?php

use App\Models\Billing\CollectionStatus;
use Database\Seeders\Billing\CollectionStatusSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Collection\CollectionInterface;

class CreateCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection', function (Blueprint $table) {
            // PK
            $table->id()->comment('Collection ID.');

            // Timestamps
            $table->timestamp('created_at')->nullable()->comment('Collection creation date.');
            $table->timestamp('updated_at')->nullable()->comment('Collection last update date.');

            // Collection Data
            $table->unsignedBigInteger('biller_id')->comment('Biller of this collection.');
            $table->string('collection_status_id')->default(CollectionStatus::SCHEDULED)->comment('Determine the status of the collection.');
            $table->double('value')->comment('Collection value.');

            // Collection payment data
            $table->unsignedTinyInteger('payment_interval_id')->comment('Payment interval of this collection.');
            $table->string('payment_method_id')->comment('Payment method of this collection.');
            $table->unsignedBigInteger('credit_card_id')->nullable()->comment('Credit card that pays this collection.');
            $table->unsignedBigInteger('bank_id')->nullable()->comment('Bank that receives the payment for this collection.');

            // Foreign Key
            $table->foreign('biller_id')->references('id')->on('biller');
            $table->foreign('collection_status_id')->references('id')->on('collection_status');
            $table->foreign('payment_interval_id')->references('id')->on('payment_interval');
            $table->foreign('payment_method_id')->references('id')->on('payment_method');
            $table->foreign('credit_card_id')->references('id')->on('credit_card');
            $table->foreign('bank_id')->references('id')->on('bank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection');
    }
}
