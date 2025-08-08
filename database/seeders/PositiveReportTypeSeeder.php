<?php

namespace Database\Seeders;

use App\Models\PositiveReportType;
use Illuminate\Database\Seeder;

class PositiveReportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Academic Excellence',
                'description' => 'Outstanding academic performance or improvement',
                'icon' => '📚',
            ],
            [
                'name' => 'Leadership',
                'description' => 'Demonstrating leadership qualities or taking initiative',
                'icon' => '👑',
            ],
            [
                'name' => 'Sports Achievement',
                'description' => 'Excellence in sports or physical activities',
                'icon' => '🏆',
            ],
            [
                'name' => 'Community Service',
                'description' => 'Helping others or contributing to the community',
                'icon' => '🤝',
            ],
            [
                'name' => 'Good Behavior',
                'description' => 'Consistently good behavior and attitude',
                'icon' => '👍',
            ],
            [
                'name' => 'Helping Others',
                'description' => 'Assisting classmates or teachers',
                'icon' => '💝',
            ],
            [
                'name' => 'Improvement',
                'description' => 'Significant improvement in any area',
                'icon' => '📈',
            ],
            [
                'name' => 'Special Recognition',
                'description' => 'Other notable achievements or positive actions',
                'icon' => '⭐',
            ],
        ];

        foreach ($types as $type) {
            PositiveReportType::create($type);
        }
    }
} 