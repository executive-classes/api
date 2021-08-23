<?php

use App\Models\Eloquent\General\Category\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Question ID.');

            // Timestamps
            $table->timestamps();

            // Question Data
            $table->string('name')
                ->comment('Question name.');
            
            $table->string('question')
                ->comment('Question.');

            $table->boolean('active')
                ->default(true)
                ->comment('Determine if the question is active');

            $table->foreignIdFor(Category::class, 'category_id')
            ->references('id')
                ->on('category')
                ->comment('Category of this question.');
        });

        // Adding columns comments.
        Schema::table('question', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Question creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Question last update date.')
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
        Schema::dropIfExists('question');
    }
}
