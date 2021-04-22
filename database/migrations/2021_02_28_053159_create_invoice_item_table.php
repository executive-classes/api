<?php

use App\Models\Billing\Invoice;
use App\Models\Billing\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_item', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Invoice Item ID.');

            // Timestamps
            $table->timestamps();

            // Item data
            $table->foreignIdFor(Invoice::class, 'invoice_id')
                ->references('id')
                ->on('invoice')
                ->comment('Invoice of this item.');

            $table->foreignIdFor(Student::class, 'student_id')
                ->references('id')
                ->on('student')
                ->comment('Student of this item.');

            $table->string('description')
                ->comment('Item description.');

            $table->integer('qty')
                ->comment('Item quantity.');

            $table->double('unity_price')
                ->comment('Item unit price.');

            $table->double('price')
                ->comment('Item total price.');
        });

        // Adding columns comments.
        Schema::table('invoice_item', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Invoice item creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Invoice item last update date.')
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
        Schema::dropIfExists('invoice_item');
    }
}
