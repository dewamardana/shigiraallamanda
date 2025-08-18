<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'Customer Service',
            'Housekeeping',
            'Food and Beverage Service',
            'Front Office Management',
            'Reservation Handling',
            'Event Planning',
            'Room Preparation',
            'Bartending',
            'Menu Knowledge',
            'Communication Skills',
            'Problem Solving',
            'Multitasking',
            'Foreign Language',
            'Cashiering',
            'Teamwork'
        ];
            foreach ($skills as $skill) {
            Skill::firstOrCreate(['name' => $skill]);
        }
    }
}
