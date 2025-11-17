<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting database seeding...');
        $this->command->newLine();

        $this->call([
            UserSeeder::class,
            ProjectSeeder::class,
            TaskSeeder::class,
        ]);

        $this->command->newLine();
        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->newLine();
        $this->command->info('📧 Login credentials:');
        $this->command->info('   Admin: admin@example.com');
        $this->command->info('   Manager: john.manager@example.com');
        $this->command->info('   Employee: alice.employee@example.com');
        $this->command->info('   Password: password');
    }
}
