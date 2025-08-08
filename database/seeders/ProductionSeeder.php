<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\IncidentType;
use App\Models\PositiveReportType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        // Create only the essential admin user
        User::create([
            'name' => 'School Administrator',
            'email' => 'admin@school.edu',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'department' => 'Administration',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create basic incident types
        $incidentTypes = [
            [
                'name' => 'Disruptive Behavior',
                'description' => 'General classroom disruption',
                'severity' => 'minor',
                'is_active' => true,
            ],
            [
                'name' => 'Bullying',
                'description' => 'Bullying or harassment of other students',
                'severity' => 'major',
                'is_active' => true,
            ],
            [
                'name' => 'Academic Dishonesty',
                'description' => 'Cheating, plagiarism, or academic misconduct',
                'severity' => 'major',
                'is_active' => true,
            ],
            [
                'name' => 'Violence',
                'description' => 'Physical violence or threats',
                'severity' => 'critical',
                'is_active' => true,
            ],
            [
                'name' => 'Tardiness',
                'description' => 'Late arrival to class',
                'severity' => 'minor',
                'is_active' => true,
            ],
        ];

        foreach ($incidentTypes as $type) {
            IncidentType::create($type);
        }

        // Create basic positive report types
        $positiveTypes = [
            [
                'name' => 'Academic Excellence',
                'description' => 'Outstanding academic performance or improvement',
                'icon' => '📚',
                'is_active' => true,
            ],
            [
                'name' => 'Leadership',
                'description' => 'Demonstrating leadership qualities or taking initiative',
                'icon' => '👑',
                'is_active' => true,
            ],
            [
                'name' => 'Good Citizenship',
                'description' => 'Exemplary behavior and positive contribution to school community',
                'icon' => '🌟',
                'is_active' => true,
            ],
            [
                'name' => 'Helping Others',
                'description' => 'Going above and beyond to help classmates or staff',
                'icon' => '🤝',
                'is_active' => true,
            ],
            [
                'name' => 'Perfect Attendance',
                'description' => 'Excellent attendance record',
                'icon' => '📅',
                'is_active' => true,
            ],
        ];

        foreach ($positiveTypes as $type) {
            PositiveReportType::create($type);
        }
    }
}
