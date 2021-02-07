<?php

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
            $table->engine = 'InnoDB';

            // PK
            $table->id()->comment('ID do usuário.');

            // Timestamps
            $table->timestamp('created_at')->nullable()->comment('Data da criação do usuário.');
            $table->timestamp('updated_at')->nullable()->comment('Data da última atualização do usuário.');
            $table->timestamp('inactve_at')->nullable()->comment('Data da inativação do usuário.');
            $table->timestamp('reactive_at')->nullable()->comment('Data da reativação do usuário.');

            // User Data
            $table->string('name')->comment('Nome do usuário.');
            $table->string('email')->unique()->comment('E-mail do usuário.');
            $table->timestamp('email_verified_at')->nullable()->comment('Data da verificação do e-mail.');
            $table->string('password')->comment('Senha do usuário.');
            $table->string('password_reminder')->nullable()->comment('Lembrete de senha do usuário.');
            $table->string('salt')->unique()->comment('Salt do usuário.');
            $table->rememberToken()->comment('Token usado para a função Lembre de Mim.');
            $table->boolean('active')->default(true)->comment('Indica se o usuário está ativo.');

            // User Info
            $table->string('tax_type_id')->comment('Indica o tipo de documento do usuário.');
            $table->string('tax_code')->unique()->comment('Código do documento do usuário.');
            $table->string('phone')->nullable()->comment('Telefone do usuário.');
            $table->string('phone_alt')->nullable()->comment('Telefone alternativo do usuário');
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
