<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@school.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'department' => 'Administration',
            'is_active' => true,
        ]);

        // Create teacher users
        User::create([
            'name' => 'Sarah Johnson',
            'email' => 'teacher@school.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'department' => 'Mathematics',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Michael Chen',
            'email' => 'mchen@school.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'department' => 'Science',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Emily Rodriguez',
            'email' => 'erodriguez@school.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'department' => 'English',
            'is_active' => true,
        ]);

        // Create counselor
        User::create([
            'name' => 'Dr. Lisa Thompson',
            'email' => 'counselor@school.com',
            'password' => Hash::make('password'),
            'role' => 'counselor',
            'department' => 'Student Services',
            'is_active' => true,
        ]);

        // Create principal
        User::create([
            'name' => 'Principal Williams',
            'email' => 'principal@school.com',
            'password' => Hash::make('password'),
            'role' => 'principal',
            'department' => 'Administration',
            'is_active' => true,
        ]);

        // Create inactive user for testing
        User::create([
            'name' => 'Inactive User',
            'email' => 'inactive@school.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'department' => 'History',
            'is_active' => false,
        ]);
    }
}
