<?php

use App\Models\Classroom\Course;
use App\Models\Classroom\Module;
use App\Models\General\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Lesson ID.');

            // Timestamps
            $table->timestamps();

            // Lesson Data
            $table->foreignIdFor(Course::class, 'course_id')
            ->nullable()
                ->references('id')
                ->on('course')
                ->comment('Course of this lesson.');

            $table->foreignIdFor(Module::class, 'module_id')
                ->nullable()
                ->references('id')
                ->on('module')
                ->comment('Module of this lesson.');

            $table->string('name')
                ->comment('Lesson name.');

            $table->boolean('active')
                ->default(true)
                ->comment('Determine if the lesson is active');

            $table->foreignIdFor(Category::class, 'category_id')
            ->references('id')
                ->on('category')
                ->comment('Category of this lesson.');
        });

        // Adding columns comments.
        Schema::table('lesson', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Lesson creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Lesson last update date.')
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
        Schema::dropIfExists('lesson');
    }
}
