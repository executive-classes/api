<?php

use App\Models\Billing\Collection\Collection;
use App\Models\Billing\Student\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_item', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Collection Item ID.');

            // Timestamps
            $table->timestamps();

            // Item data
            $table->foreignIdFor(Collection::class, 'collection_id')
                ->references('id')
                ->on('collection')
                ->comment('Collection of this item.');

            $table->foreignIdFor(Student::class, 'student_id')
                ->references('id')
                ->on('student')
                ->comment('Student of this item.');

            $table->double('amount')
                ->comment('Price of this item.');
        });

        // Adding columns comments.
        Schema::table('collection_item', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Collection item creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Collection item last update date.')
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
        Schema::dropIfExists('collection_item');
    }
}
