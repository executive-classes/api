<?php

use App\Enums\Billing\BillerStatusEnum;
use App\Models\Billing\BillerStatus;
use App\Models\Billing\Address;
use App\Models\Billing\Customer;
use App\Models\Billing\PaymentInterval;
use App\Models\Billing\PaymentMethod;
use App\Models\Billing\TaxType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biller', function (Blueprint $table) {
            // PK
            $table->id()->comment('Biller ID.');

            // Timestamps
            $table->timestamps();

            $table->timestamp('inactive_at')
                ->nullable()
                ->comment('Biller inactivate date.');

            $table->timestamp('reactive_at')
                ->nullable()
                ->comment('Biller reactivate date.');

            // Biller Data
            $table->foreignIdFor(Customer::class, 'customer_id')
                ->references('id')
                ->on('customer')
                ->comment('Customer that have this biller.');

            $table->foreignIdFor(BillerStatus::class, 'biller_status_id')
                ->default(BillerStatusEnum::ACTIVE)
                ->references('id')
                ->on('customer_status')
                ->comment('Determine the status of the biller.');

            $table->string('name')
                ->comment('Biller name.');

            $table->foreignIdFor(TaxType::class, 'tax_type_id')
                ->references('id')
                ->on('tax_type')
                ->comment('Biller tax type.');

            $table->string('tax_code')
                ->unique()
                ->comment('Biller tax code.');

            // Biller contact data
            $table->foreignIdFor(Address::class, 'address_id')
                ->references('id')
                ->on('address')
                ->comment('Determine the address of the biller.');

            $table->string('email')
                ->nullable()
                ->comment('The contact e-mail for the biller.');

            $table->string('phone')
                ->nullable()
                ->comment('The contact phone for the biller.');

            $table->string('phone_alt')
                ->nullable()
                ->comment('A second contact phone for the biller.');

            // Biller payment data
            $table->foreignIdFor(PaymentInterval::class, 'payment_interval_id')
                ->references('id')
                ->on('payment_interval')
                ->comment('Payment interval of this biller.');

            $table->foreignIdFor(PaymentMethod::class, 'payment_method_id')
                ->references('id')
                ->on('payment_method')
                ->comment('Payment method of this biller.');
        });

        // Adding columns comments.
        Schema::table('biller', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Biller creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Biller last update date.')
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
        Schema::dropIfExists('biller');
    }
}
