<?php

use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_position', function (Blueprint $table) {
            // PK
            $table->string('id')
                ->comment('Employee position ID.');

            $table->primary('id');

            // Message status data
            $table->string('name')
                ->comment('Position name.');

            $table->foreignIdFor(EmployeePosition::class, 'parent_id')
                ->nullable()
                ->references('id')
                ->on('employee_position')
                ->comment('Position parent.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_position');
    }
}
