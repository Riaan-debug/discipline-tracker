<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncidentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incidentTypes = [
            // Minor incidents
            ['name' => 'Classroom Disruption', 'description' => 'Talking out of turn, making noise, or other minor disruptions', 'severity' => 'minor'],
            ['name' => 'Late to Class', 'description' => 'Arriving late to class without proper excuse', 'severity' => 'minor'],
            ['name' => 'Inappropriate Language', 'description' => 'Using mild inappropriate language', 'severity' => 'minor'],
            ['name' => 'Dress Code Violation', 'description' => 'Minor violations of school dress code', 'severity' => 'minor'],
            
            // Moderate incidents
            ['name' => 'Bullying', 'description' => 'Verbal or physical bullying of other students', 'severity' => 'moderate'],
            ['name' => 'Defiance', 'description' => 'Refusing to follow teacher instructions or school rules', 'severity' => 'moderate'],
            ['name' => 'Cheating', 'description' => 'Academic dishonesty on assignments or tests', 'severity' => 'moderate'],
            ['name' => 'Disrespect to Staff', 'description' => 'Disrespectful behavior toward teachers or staff', 'severity' => 'moderate'],
            ['name' => 'Fighting', 'description' => 'Physical altercation with another student', 'severity' => 'moderate'],
            
            // Major incidents
            ['name' => 'Vandalism', 'description' => 'Damaging school property or facilities', 'severity' => 'major'],
            ['name' => 'Theft', 'description' => 'Stealing from other students or school', 'severity' => 'major'],
            ['name' => 'Substance Use', 'description' => 'Possession or use of prohibited substances', 'severity' => 'major'],
            ['name' => 'Threats', 'description' => 'Making threats to students or staff', 'severity' => 'major'],
            
            // Critical incidents
            ['name' => 'Weapons Possession', 'description' => 'Bringing weapons or dangerous objects to school', 'severity' => 'critical'],
            ['name' => 'Assault', 'description' => 'Physical assault on students or staff', 'severity' => 'critical'],
            ['name' => 'Drug Distribution', 'description' => 'Selling or distributing drugs on school grounds', 'severity' => 'critical'],
        ];

        foreach ($incidentTypes as $type) {
            \App\Models\IncidentType::create($type);
        }
    }
}
