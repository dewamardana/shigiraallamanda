<?php

namespace Database\Seeders;

use App\Models\ReportType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,
            SkillSeeder::class,
            UserSeeder::class,
            BuildingSeeder::class,
            CleaningSeeder::class,
            FormulaSeeder::class,
            FormulaCheckSeeder::class,
            CheckOfficeSeeder::class,
            TaskSeeder::class,
            ReportTypeSeeder::class,
            // PostSeeder::class,
            // CommentSeeder::class,
        ]);
    }
}
