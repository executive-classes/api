<?php

use App\Enums\System\SystemLanguageEnum;
use App\Models\Billing\TaxType\TaxType;
use App\Models\System\SystemLanguage\SystemLanguage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            // PK
            $table->id()->comment('User ID.');

            // Timestamps
            $table->timestamps();

            $table->timestamp('inactive_at')
                ->nullable()
                ->comment('User inactivate date.');

            $table->timestamp('reactive_at')
                ->nullable()
                ->comment('User reactivate date.');
            
            // User Data
            $table->string('name')
                ->comment('User name.');

            $table->string('email')
                ->unique()
                ->comment('User e-mail.');

            $table->timestamp('email_verified_at')
                ->nullable()
                ->comment('E-mail verification date.');

            $table->string('password')
                ->comment('User password.');

            $table->string('password_reminder')
                ->nullable()
                ->comment('User password reminder.');

            $table->rememberToken()
                ->comment('Token user in the remember me function.');
                
            $table->boolean('active')
                ->default(true)
                ->comment('Determine if the user is active');

            // User Info
            $table->foreignIdFor(TaxType::class, 'tax_type_id')
                ->references('id')
                ->on('tax_type')
                ->comment('Tax type of the user.');

            $table->string('tax_code')
                ->unique()
                ->comment('Tax code of the user.');

            $table->foreignIdFor(TaxType::class, 'tax_type_alt_id')
                ->nullable()
                ->references('id')
                ->on('tax_type')
                ->comment('User alternative tax type.');

            $table->string('tax_code_alt')
                ->nullable()
                ->unique()
                ->comment('User alternative tax code.');

            $table->string('phone')
                ->nullable()
                ->comment('User phone.');

            $table->string('phone_alt')
                ->nullable()
                ->comment('User alternate phone');

            // User settings
            $table->foreignIdFor(SystemLanguage::class, 'system_language_id')
                ->references('id')
                ->on('system_language')
                ->default(SystemLanguageEnum::EN)
                ->comment('User preffer language.');
        });

        // Adding columns comments.
        Schema::table('user', function (Blueprint $table) {
            // Timestamps comments
            $table->timestamp('created_at')
                ->comment('User creation date.')
                ->change();

            $table->timestamp('updated_at')
                ->comment('User last update date.')
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
        Schema::dropIfExists('users');
    }
}
