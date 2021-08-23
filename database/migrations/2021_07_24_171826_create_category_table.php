<?php

use App\Models\Eloquent\General\Category\Category;
use App\Models\Eloquent\General\CategoryType\CategoryType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Category ID.');

            // Category type data
            $table->string('name')
                ->comment('Category type name.');

            $table->string('description')
                ->comment('Category type description.');

            $table->foreignIdFor(CategoryType::class, 'category_type_id')
                ->references('id')
                ->on('category_type')
                ->comment('Category Type of the category.');

            $table->foreignIdFor(Category::class, 'parent_id')
                ->nullable()
                ->references('id')
                ->on('category')
                ->comment('Category Parent of the category. This field indicate that the category is a subcategory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
