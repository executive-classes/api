<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Employee\Employee;
use App\Models\Eloquent\Billing\Student\Student;
use App\Models\Eloquent\Billing\Teacher\Teacher;
use App\Models\Eloquent\Billing\User\User;
use Database\Seeders\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the local database seeds.
     *
     * @return void
     */
    protected function local()
    {
        // Creating test users
        User::factory()->persist()
            ->has(Employee::factory()->persist()->developer(), 'employee')
            ->create(config('test.user.type.dev'));
        
        // Create a admin
        User::factory()->persist()
            ->has(Employee::factory()->persist()->administrator(), 'employee')
            ->create(config('test.user.type.adm'));

        // Create a financial
        User::factory()->persist()
            ->has(Employee::factory()->persist()->financial(), 'employee')
            ->create(config('test.user.type.fin'));

        // Create a technician
        User::factory()->persist()
            ->has(Employee::factory()->persist()->technician(), 'employee')
            ->create(config('test.user.type.tech'));

        // Create a teacher
        User::factory()->persist()
            ->has(Teacher::factory()->persist(), 'teacher')
            ->create(config('test.user.type.teacher'));

        // Create a student
        User::factory()->persist()
            ->has(Student::factory()->persist(), 'student')
            ->create(config('test.user.type.student'));

        // Creating user for every tax
        User::factory()->persist()->cnpj()->create();
        User::factory()->persist()->cpf()->create();

        // Creating user for every status
        User::factory()->persist()->active()->create();
        User::factory()->persist()->inactive()->create();

        // Creating user for every language
        User::factory()->persist()->en()->create();
        User::factory()->persist()->pt_BR()->create();

    }

    /**
     * Run the test database seeds.
     *
     * @return void
     */
    protected function test()
    {
        // Creating test users
        User::factory()->persist()
            ->has(Employee::factory()->persist()->developer(), 'employee')
            ->create(config('test.user.type.dev'));
    }
}
