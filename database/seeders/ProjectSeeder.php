<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $managers = User::where('role', 'manager')->get();

        if ($managers->isEmpty()) {
            $this->command->error('No managers found! Run UserSeeder first.');

            return;
        }

        $projects = [
            // Manager 1 Projects
            [
                'name' => 'E-Commerce Platform',
                'description' => 'Build a full-featured e-commerce platform with payment integration, product management, and customer portal.',
                'manager_id' => $managers[0]->id,
                'created_at' => now()->subMonths(3),
            ],
            [
                'name' => 'Mobile Banking App',
                'description' => 'Develop a secure mobile banking application for iOS and Android with biometric authentication.',
                'manager_id' => $managers[0]->id,
                'created_at' => now()->subMonths(2),
            ],
            [
                'name' => 'Customer Portal Redesign',
                'description' => 'Complete UI/UX overhaul of existing customer portal with modern design principles.',
                'manager_id' => $managers[0]->id,
                'created_at' => now()->subMonths(6),
            ],

            // Manager 2 Projects
            [
                'name' => 'CRM System Implementation',
                'description' => 'Implement and customize Salesforce CRM for sales and marketing teams.',
                'manager_id' => $managers[1]->id,
                'created_at' => now()->subMonths(4),
            ],
            [
                'name' => 'Data Migration Project',
                'description' => 'Migrate legacy database to new cloud-based infrastructure with zero downtime.',
                'manager_id' => $managers[1]->id,
                'created_at' => now()->subMonth(),
            ],
            [
                'name' => 'API Development',
                'description' => 'Create RESTful API for third-party integrations with comprehensive documentation.',
                'manager_id' => $managers[1]->id,
                'created_at' => now()->subMonths(5),
            ],
            [
                'name' => 'AI Chatbot Integration',
                'description' => 'Integrate AI-powered chatbot for customer support with natural language processing.',
                'manager_id' => $managers[0]->id,
                'created_at' => now()->subWeeks(2),
            ],
            [
                'name' => 'Marketing Automation',
                'description' => 'Set up marketing automation workflows and email campaign management.',
                'manager_id' => $managers[1]->id,
                'created_at' => now()->subWeek(),
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        $this->command->info('Projects created successfully!');
        $this->command->info('Total projects: ' . count($projects));
    }
}
