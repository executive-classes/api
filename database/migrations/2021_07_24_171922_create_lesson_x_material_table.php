<?php

use App\Models\Classroom\Lesson\Lesson;
use App\Models\Classroom\Material\Material;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonXMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_x_material', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Lesson Material ID.');

            // Timestamps
            $table->timestamps();

            // Lesson Material Data
            $table->foreignIdFor(Lesson::class, 'lesson_id')
                ->references('id')
                ->on('lesson')
                ->comment('The lesson.');

            $table->foreignIdFor(Material::class, 'material_id')
                ->references('id')
                ->on('material')
                ->comment('The material.');

            $table->integer('precedence')
                ->default(0)
                ->comment('The material precedence.');
        });

        // Adding columns comments.
        Schema::table('lesson_x_material', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Lesson Material creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Lesson Material last update date.')
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
        Schema::dropIfExists('lesson_x_material');
    }
}
