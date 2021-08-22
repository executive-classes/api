<?php

use App\Enums\Billing\EmployeeStatusEnum;
use App\Models\Billing\EmployeePosition\EmployeePosition;
use App\Models\Billing\EmployeeStatus\EmployeeStatus;
use App\Models\Billing\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            // PK
            $table->id()
                ->comment('Employee ID.');

            // Timestamps
            $table->timestamps();

            // Collection Data
            $table->foreignIdFor(User::class, 'user_id')
                ->unique()
                ->references('id')
                ->on('user')
                ->comment('User of this employee.');

            $table->foreignIdFor(EmployeePosition::class, 'employee_position_id')
                ->references('id')
                ->on('employee_position')
                ->comment('The position of this employee.');

            $table->foreignIdFor(EmployeeStatus::class, 'employee_status_id')
                ->default(EmployeeStatusEnum::ACTIVE)
                ->references('id')
                ->on('employee_status')
                ->comment('Status of the employee.');
        });

        // Adding columns comments.
        Schema::table('employee', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('Employee creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('Employee last update date.')
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
        Schema::dropIfExists('employee');
    }
}
