<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $managers = [
            [
                'name' => 'John Manager',
                'email' => 'john.manager@example.com',
                'password' => bcrypt('password'),
                'role' => 'manager',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sarah Manager',
                'email' => 'sarah.manager@example.com',
                'password' => bcrypt('password'),
                'role' => 'manager',
                'email_verified_at' => now(),
            ],
        ];

        $employees = [
            [
                'name' => 'Alice Employee',
                'email' => 'alice.employee@example.com',
                'password' => bcrypt('password'),
                'role' => 'employee',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Bob Employee',
                'email' => 'bob.employee@example.com',
                'password' => bcrypt('password'),
                'role' => 'employee',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Charlie Employee',
                'email' => 'charlie.employee@example.com',
                'password' => bcrypt('password'),
                'role' => 'employee',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Diana Employee',
                'email' => 'diana.employee@example.com',
                'password' => bcrypt('password'),
                'role' => 'employee',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($managers as $manager) {
            User::create($manager);
        }

        foreach ($employees as $employee) {
            User::create($employee);
        }

        $this->command->info('Users created successfully!');
        $this->command->info('Admin: admin@example.com');
        $this->command->info('Managers: john.manager@example.com, sarah.manager@example.com');
        $this->command->info('Employees: alice.employee@example.com, bob.employee@example.com, etc.');
        $this->command->info('All passwords: password');
    }
}
