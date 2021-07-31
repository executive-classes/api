<?php

use App\Models\Billing\Student;
use App\Models\Classroom\Course;
use App\Models\Classroom\Module;
use App\Models\Classroom\ModuleStatus;
use App\Models\Classroom\Test;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleXStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_x_student', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Module ID.');

            // Timestamps
            $table->timestamps();

            $table->timestamp('start_at')
                ->nullable()
                ->comment('Module start date.');

            $table->timestamp('finish_at')
                ->nullable()
                ->comment('Module finish date.');

            // Module Data
            $table->foreignIdFor(Course::class, 'course_id')
                ->nullable()
                ->references('id')
                ->on('course')
                ->comment('The course.');

            $table->foreignIdFor(Module::class, 'module_id')
                ->references('id')
                ->on('module')
                ->comment('The module.');

            $table->foreignIdFor(Student::class, 'student_id')
                ->references('id')
                ->on('student')
                ->comment('Student that made the module.');

            $table->foreignIdFor(ModuleStatus::class, 'module_status_id')
                ->references('id')
                ->on('module_status')
                ->comment('Module status.');

            $table->foreignIdFor(Test::class, 'test_id')
                ->references('id')
                ->on('test')
                ->comment('Module final test.');
        });

        // Adding columns comments.
        Schema::table('module_x_student', function (Blueprint $table) {
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
        Schema::dropIfExists('module_x_student');
    }
}
