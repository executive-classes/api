<?php

use App\Enums\Billing\CollectionStatusEnum;
use App\Models\Billing\Biller;
use App\Models\Billing\CollectionStatus;
use App\Models\Billing\PaymentInterval;
use App\Models\Billing\PaymentMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
            $table->id()
                ->comment('Collection ID.');


            // Timestamps
            $table->timestamps();

            $table->timestamp('expire_at')
                ->default(DB::raw("DATE_ADD(CURDATE(), INTERVAL 1 MONTH)"))
                ->comment('Collection expiration date.');

            // Collection Data
            $table->foreignIdFor(Biller::class, 'biller_id')
                ->references('id')
                ->on('biller')
                ->comment('Biller of this collection.');

            $table->foreignIdFor(CollectionStatus::class, 'collection_status_id')
                ->default(CollectionStatusEnum::SCHEDULED)
                ->references('id')
                ->on('collection_status')
                ->comment('Determine the status of the collection.');

            $table->double('amount')
                ->comment('Collection amount.');

            $table->string('description')
                ->comment('Collection description.');

            $table->string('truncatedDescription', 22)
                ->comment('Collection truncated description.');

            // Collection payment data
            $table->foreignIdFor(PaymentInterval::class, 'payment_interval_id')
                ->references('id')
                ->on('payment_interval')
                ->comment('Payment interval of this collection.');

            $table->foreignIdFor(PaymentMethod::class, 'payment_method_id')
                ->references('id')
                ->on('payment_method')
                ->comment('Payment method of this collection.');

            $table->string('token_id')
                ->nullable()
                ->comment('Credit card token id.');
        });

        // Adding columns comments.
        Schema::table('collection', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Collection creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Collection last update date.')
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
        Schema::dropIfExists('collection');
    }
}
