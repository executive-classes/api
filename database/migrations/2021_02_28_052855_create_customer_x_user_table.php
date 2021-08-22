<?php

use App\Models\Billing\Customer\Customer;
use App\Models\Billing\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerXUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_x_user', function (Blueprint $table) {
            // PK
            $table->foreignIdFor(Customer::class, 'customer_id')
                ->comment('Customer ID.');
                
            $table->foreignIdFor(User::class, 'user_id')
                ->comment('User ID.');
                
            $table->primary(['customer_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_x_user');
    }
}
