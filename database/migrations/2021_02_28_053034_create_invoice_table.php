<?php

use App\Enums\Billing\InvoiceStatusEnum;
use App\Models\Billing\Collection\Collection;
use App\Models\Billing\InvoiceStatus\InvoiceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Invoice ID.');

            // Timestamps
            $table->timestamps();

            // Collection Data
            $table->foreignIdFor(Collection::class, 'collection_id')
                ->references('id')
                ->on('collection')
                ->comment('Collection of this invoice.');

            $table->foreignIdFor(InvoiceStatus::class, 'invoice_status_id')
                ->default(InvoiceStatusEnum::CREATED)
                ->references('id')
                ->on('invoice_status')
                ->comment('Determine the status of the collection.');

            $table->longText('xml')
                ->nullable()
                ->comment('The invoice XML.');

            $table->longText('receipt')
                ->nullable()
                ->comment('The sent invoice receipt.');

            $table->longText('error_message')
                ->nullable()
                ->comment('The error in the processing of the invoice.');
        });

        // Adding columns comments.
        Schema::table('invoice', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Invoice creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Invoice last update date.')
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
        Schema::dropIfExists('invoice');
    }
}
