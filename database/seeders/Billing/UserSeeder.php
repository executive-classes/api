<?php

namespace Database\Seeders\Billing;

use App\Models\Eloquent\Billing\Employee\Employee;
use App\Models\Eloquent\Billing\Student\Student;
use App\Models\Eloquent\Billing\Teacher\Teacher;
use App\Models\Eloquent\Billing\User\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a dev
        User::factory()
            ->has(Employee::factory()->developer(), 'employee')
            ->create(config('test.user.type.dev'));
        
        if (!isTest()) {
            // Create a admin
            User::factory()
                ->has(Employee::factory()->administrator(), 'employee')
                ->create(config('test.user.type.adm'));
    
            // Create a financial
            User::factory()
                ->has(Employee::factory()->financial(), 'employee')
                ->create(config('test.user.type.fin'));
    
            // Create a technician
            User::factory()
                ->has(Employee::factory()->technician(), 'employee')
                ->create(config('test.user.type.tech'));
    
            // Create a teacher
            User::factory()
                ->has(Teacher::factory(), 'teacher')
                ->create(config('test.user.type.teacher'));
    
            // Create a student
            User::factory()
                ->has(Student::factory(), 'student')
                ->create(config('test.user.type.student'));
        }

    }
}
