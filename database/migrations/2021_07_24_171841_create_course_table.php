<?php

use App\Models\General\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Course ID.');

            // Timestamps
            $table->timestamps();

            // Course Data
            $table->string('name')
                ->comment('Course name.');

            $table->boolean('active')
                ->default(true)
                ->comment('Determine if the course is active');

            $table->foreignIdFor(Category::class, 'category_id')
                ->references('id')
                ->on('category')
                ->comment('Category of this course.');
        });

        // Adding columns comments.
        Schema::table('course', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Course creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Course last update date.')
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
        Schema::dropIfExists('course');
    }
}
