<?php

use App\Models\Eloquent\Classroom\Course\Course;
use App\Models\Eloquent\General\Category\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Module ID.');

            // Timestamps
            $table->timestamps();

            // Module Data
            $table->foreignIdFor(Course::class, 'course_id')
                ->nullable()
                ->references('id')
                ->on('course')
                ->comment('Course of this module.');

            $table->string('name')
                ->comment('Module name.');

            $table->boolean('active')
                ->default(true)
                ->comment('Determine if the module is active');

            $table->foreignIdFor(Category::class, 'category_id')
                ->references('id')
                ->on('category')
                ->comment('Category of this module.');
        });

        // Adding columns comments.
        Schema::table('module', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Module creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Module last update date.')
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
        Schema::dropIfExists('module');
    }
}
