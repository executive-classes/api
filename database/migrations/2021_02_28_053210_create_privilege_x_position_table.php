<?php

use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;
use App\Models\Eloquent\Billing\UserPrivilege\UserPrivilege;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegeXPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privilege_x_position', function (Blueprint $table) {
            // PK
            $table->foreignIdFor(EmployeePosition::class, 'position_id')
                ->references('id')
                ->on('employee_position')
                ->comment('Position ID.');

            $table->foreignIdFor(UserPrivilege::class, 'privilege_id')
                ->references('id')
                ->on('user_privilege')
                ->comment('Privilege ID.');

            $table->primary(['position_id', 'privilege_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privilege_x_position');
    }
}
