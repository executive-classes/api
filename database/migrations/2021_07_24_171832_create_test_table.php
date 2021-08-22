<?php

use App\Models\General\Category\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Test ID.');

            // Timestamps
            $table->timestamps();

            // Test Data
            $table->string('name')
                ->comment('Test name.');

            $table->boolean('active')
                ->default(true)
                ->comment('Determine if the test is active');

            $table->foreignIdFor(Category::class, 'category_id')
                ->references('id')
                ->on('category')
                ->comment('Category of this test.');
        });

        // Adding columns comments.
        Schema::table('test', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Test creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Test last update date.')
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
        Schema::dropIfExists('test');
    }
}
