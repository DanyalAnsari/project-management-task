<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $employees = User::where('role', 'employee')->get();

        if ($projects->isEmpty()) {
            $this->command->error('No projects found! Run ProjectSeeder first.');

            return;
        }

        if ($employees->isEmpty()) {
            $this->command->error('No employees found! Run UserSeeder first.');

            return;
        }

        $taskTemplates = [
            'E-Commerce Platform' => [
                ['name' => 'Set up project repository', 'description' => 'Initialize Git repository and set up branch protection rules', 'status' => 'done', 'days_offset' => -60],
                ['name' => 'Design database schema', 'description' => 'Create ERD and database schema for products, orders, and customers', 'status' => 'done', 'days_offset' => -55],
                ['name' => 'Implement user authentication', 'description' => 'Set up JWT-based authentication system', 'status' => 'done', 'days_offset' => -50],
                ['name' => 'Build product catalog', 'description' => 'Create product listing, search, and filtering functionality', 'status' => 'in_progress', 'days_offset' => -30],
                ['name' => 'Integrate payment gateway', 'description' => 'Implement Stripe payment integration', 'status' => 'in_progress', 'days_offset' => -20],
                ['name' => 'Develop shopping cart', 'description' => 'Build shopping cart with session management', 'status' => 'pending', 'days_offset' => 0],
                ['name' => 'Create order management', 'description' => 'Build order processing and tracking system', 'status' => 'pending', 'days_offset' => 10],
                ['name' => 'Implement admin dashboard', 'description' => 'Create admin panel for product and order management', 'status' => 'pending', 'days_offset' => 20],
                ['name' => 'Add email notifications', 'description' => 'Set up order confirmation and shipping emails', 'status' => 'pending', 'days_offset' => 25],
                ['name' => 'Performance testing', 'description' => 'Conduct load testing and optimize queries', 'status' => 'pending', 'days_offset' => 30],
            ],
            'Mobile Banking App' => [
                ['name' => 'Research compliance requirements', 'description' => 'Review banking regulations and security standards', 'status' => 'done', 'days_offset' => -45],
                ['name' => 'Design app wireframes', 'description' => 'Create UI/UX mockups for all screens', 'status' => 'done', 'days_offset' => -40],
                ['name' => 'Set up React Native project', 'description' => 'Initialize mobile app project with necessary dependencies', 'status' => 'done', 'days_offset' => -35],
                ['name' => 'Implement biometric auth', 'description' => 'Add fingerprint and face recognition login', 'status' => 'in_progress', 'days_offset' => -25],
                ['name' => 'Build account dashboard', 'description' => 'Create main dashboard with account balance and recent transactions', 'status' => 'in_progress', 'days_offset' => -15],
                ['name' => 'Add fund transfer feature', 'description' => 'Implement internal and external money transfers', 'status' => 'pending', 'days_offset' => 5],
                ['name' => 'Create bill payment module', 'description' => 'Build utility bill payment functionality', 'status' => 'pending', 'days_offset' => 15],
                ['name' => 'Implement push notifications', 'description' => 'Set up real-time transaction alerts', 'status' => 'pending', 'days_offset' => 20],
                ['name' => 'Security audit', 'description' => 'Conduct penetration testing and security review', 'status' => 'pending', 'days_offset' => 35],
            ],
            'CRM System Implementation' => [
                ['name' => 'Requirements gathering', 'description' => 'Meet with stakeholders to define CRM requirements', 'status' => 'done', 'days_offset' => -90],
                ['name' => 'Salesforce setup', 'description' => 'Configure Salesforce instance and user permissions', 'status' => 'done', 'days_offset' => -80],
                ['name' => 'Custom field creation', 'description' => 'Create custom fields for company-specific data', 'status' => 'done', 'days_offset' => -70],
                ['name' => 'Data migration', 'description' => 'Import existing customer data into Salesforce', 'status' => 'in_progress', 'days_offset' => -30],
                ['name' => 'Workflow automation', 'description' => 'Set up automated workflows for lead assignment', 'status' => 'in_progress', 'days_offset' => -20],
                ['name' => 'Email integration', 'description' => 'Connect email systems with Salesforce', 'status' => 'pending', 'days_offset' => 5],
                ['name' => 'Dashboard creation', 'description' => 'Build sales performance dashboards', 'status' => 'pending', 'days_offset' => 15],
                ['name' => 'User training', 'description' => 'Conduct training sessions for sales team', 'status' => 'pending', 'days_offset' => 25],
            ],
            'Data Migration Project' => [
                ['name' => 'Database assessment', 'description' => 'Analyze current database structure and data', 'status' => 'done', 'days_offset' => -25],
                ['name' => 'Migration plan creation', 'description' => 'Document migration strategy and timeline', 'status' => 'done', 'days_offset' => -20],
                ['name' => 'Set up target database', 'description' => 'Configure new database environment', 'status' => 'done', 'days_offset' => -15],
                ['name' => 'Data cleaning', 'description' => 'Remove duplicates and fix data inconsistencies', 'status' => 'in_progress', 'days_offset' => -10],
                ['name' => 'Write migration scripts', 'description' => 'Create automated scripts for data transfer', 'status' => 'in_progress', 'days_offset' => -5],
                ['name' => 'Test migration', 'description' => 'Run test migration and validate data integrity', 'status' => 'pending', 'days_offset' => 5],
                ['name' => 'Production migration', 'description' => 'Execute production database migration', 'status' => 'pending', 'days_offset' => 15],
                ['name' => 'Post-migration validation', 'description' => 'Verify all data migrated correctly', 'status' => 'pending', 'days_offset' => 20],
            ],
        ];

        // Generic tasks for projects without specific templates
        $genericTasks = [
            ['name' => 'Project kickoff meeting', 'description' => 'Initial meeting with stakeholders', 'status' => 'done', 'days_offset' => -30],
            ['name' => 'Requirements documentation', 'description' => 'Document all project requirements', 'status' => 'done', 'days_offset' => -25],
            ['name' => 'Technical design', 'description' => 'Create technical architecture and design documents', 'status' => 'done', 'days_offset' => -20],
            ['name' => 'Development phase 1', 'description' => 'Implement core functionality', 'status' => 'in_progress', 'days_offset' => -10],
            ['name' => 'Development phase 2', 'description' => 'Add advanced features', 'status' => 'in_progress', 'days_offset' => 0],
            ['name' => 'Quality assurance', 'description' => 'Testing and bug fixing', 'status' => 'pending', 'days_offset' => 10],
            ['name' => 'User acceptance testing', 'description' => 'Client testing and feedback', 'status' => 'pending', 'days_offset' => 20],
            ['name' => 'Deployment', 'description' => 'Deploy to production environment', 'status' => 'pending', 'days_offset' => 30],
            ['name' => 'Documentation', 'description' => 'Create user and technical documentation', 'status' => 'pending', 'days_offset' => 35],
            ['name' => 'Project closeout', 'description' => 'Final review and handover', 'status' => 'pending', 'days_offset' => 40],
        ];

        $totalTasks = 0;

        foreach ($projects as $project) {
            // Get tasks for this project type or use generic tasks
            $tasks = $taskTemplates[$project->name] ?? $genericTasks;

            foreach ($tasks as $taskData) {
                // Randomly assign to an employee
                $employee = $employees->random();

                // Calculate due date based on offset
                $dueDate = now()->addDays($taskData['days_offset']);

                Task::create([
                    'title' => $taskData['name'],
                    'description' => $taskData['description'],
                    'project_id' => $project->id,
                    'assigned_to' => $employee->id,
                    'status' => $taskData['status'],
                    'due_date' => $dueDate,
                    'created_at' => $dueDate->copy()->subDays(7), // Created a week before due date
                    'updated_at' => now(),
                ]);

                $totalTasks++;
            }
        }

        $this->command->info('Tasks created successfully!');
        $this->command->info('Total tasks: ' . $totalTasks);
    }
}
