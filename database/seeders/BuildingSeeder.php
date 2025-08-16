<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = [
            'ラグーン館 (Lagoon)',
            '本館 (Main Building)',
            'ジャグジー館 (Jacuzzi)',
            'ロイヤル (Royal)',
            // 'プレミア (Premier)',
        ];

        foreach ($buildings as $name) {
            Building::create([
                'building_name' => $name,
                'slug'          => Str::slug($name),
                'description'   => 'Sample description for ' . $name,
                'foto'          => null // kalau nanti pakai foto default / upload belakangan
            ]);
        }
    }
}
