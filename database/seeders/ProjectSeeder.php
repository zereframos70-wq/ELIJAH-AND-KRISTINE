<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'portfolio' => 'fabia',
                'title' => 'SafeDorm+',
                'description' => 'A dormitory safety system concept designed to help monitor residents, alerts, sensors, and room safety information through a centralized application.',
                'tech_stack' => ['Flutter', 'Dart', 'Firebase', 'UI/UX Design'],
                'image_path' => '/fabia-portfolio-assets/safedorm-logo.png',
                'display_order' => 1,
            ],
            [
                'portfolio' => 'fabia',
                'title' => 'Student Management System',
                'description' => 'A student management application designed to organize student information and demonstrate authentication and database integration.',
                'tech_stack' => ['Flutter', 'Dart', 'Firebase Authentication', 'Firebase'],
                'image_path' => '/fabia-portfolio-assets/student-management-system.webp',
                'display_order' => 2,
            ],
            [
                'portfolio' => 'fabia',
                'title' => 'Responsive Student Dashboard',
                'description' => 'A responsive academic dashboard interface designed to present grades, attendance, subjects, announcements, schedules, and student profile information.',
                'tech_stack' => ['Flutter', 'Dart', 'Responsive UI', 'Material Design'],
                'image_path' => '/fabia-portfolio-assets/responsive-student-dashboard.jpg',
                'display_order' => 3,
            ],
            [
                'portfolio' => 'ramos',
                'title' => 'Birthday, connected',
                'description' => 'A personal IoT project built around my birthday, using an ESP32 to bring a little hardware experimentation to a special occasion.',
                'tech_stack' => ['ESP32', 'IoT', 'Electronics'],
                'image_path' => '/portfolio-assets/esp32.jpg',
                'display_order' => 1,
            ],
            [
                'portfolio' => 'ramos',
                'title' => 'SafeDorm System',
                'description' => "A system project we're currently developing for SafeDorm.",
                'tech_stack' => ['SafeDorm', 'System', 'In progress'],
                'image_path' => '/portfolio-assets/safedorm.png',
                'display_order' => 2,
            ],
            [
                'portfolio' => 'ramos',
                'title' => 'IoT, in the classroom',
                'description' => 'A simple IoT project built as a demo for my block, sharing a hands-on look at connected technology.',
                'tech_stack' => ['ESP32', 'IoT', 'Demo'],
                'image_path' => '/portfolio-assets/demo.jpg',
                'display_order' => 3,
            ],
        ];

        foreach ($projects as $project) {
            Project::query()->firstOrCreate(
                ['portfolio' => $project['portfolio'], 'title' => $project['title']],
                $project,
            );
        }
    }
}
