<?php

use App\Models\Billing\User;
use App\Models\Billing\UserPrivilege;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegeXUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privilege_x_user', function (Blueprint $table) {
            // PK
            $table->foreignIdFor(User::class, 'user_id')
                ->references('id')
                ->on('user')
                ->comment('User ID.');

            $table->foreignIdFor(UserPrivilege::class, 'user_privilege_id')
                ->references('id')
                ->on('user_privilege')
                ->comment('Privilege ID.');

            $table->primary(['user_id', 'user_privilege_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privilege_x_user');
    }
}
