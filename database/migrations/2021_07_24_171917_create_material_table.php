<?php

use App\Models\General\Category\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Material ID.');

            // Timestamps
            $table->timestamps();

            // Material Data
            $table->string('name')
                ->comment('Material name.');

            $table->string('title')
                ->comment('Material title.');

            $table->string('content')
                ->comment('Material content (html).');

            $table->string('style')
                ->nullable()
                ->comment('Material style (css).');

            $table->boolean('active')
                ->default(true)
                ->comment('Determine if the material is active');

            $table->foreignIdFor(Category::class, 'category_id')
            ->references('id')
                ->on('category')
                ->comment('Category of this material.');
        });

        // Adding columns comments.
        Schema::table('material', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
            ->comment('Material creation date.')
            ->change();

            $table->timestamp('updated_at')
            ->comment('Material last update date.')
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
        Schema::dropIfExists('material');
    }
}
