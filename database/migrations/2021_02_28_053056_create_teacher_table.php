<?php

use App\Enums\Billing\TeacherStatusEnum;
use App\Models\Billing\TeacherStatus;
use App\Models\Billing\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Teacher ID.');

            // Timestamps
            $table->timestamps();

            // Collection Data
            $table->foreignIdFor(User::class, 'user_id')
                ->unique()
                ->references('id')
                ->on('user')
                ->comment('User of this teacher.');

            $table->foreignIdFor(TeacherStatus::class, 'teacher_status_id')
                ->default(TeacherStatusEnum::ACTIVE)
                ->references('id')
                ->on('teacher_status')
                ->comment('Status of the teacher.');
        });

        // Adding columns comments.
        Schema::table('teacher', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Teacher creation date.')
                ->change();
                
            $table->timestamp('updated_at')
                ->comment('Teacher last update date.')
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
        Schema::dropIfExists('teacher');
    }
}
