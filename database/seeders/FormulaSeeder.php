<?php

namespace Database\Seeders;

use App\Models\Formula;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formulas = [
            'lagoon|2' => ['oa' => 4, 'ov' => 3, 'stay' => 3, 'vec' => 2],
            'lagoon|3' => ['oa' => 3, 'ov' => 2, 'stay' => 2, 'vec' => 1.5],
            'jacuzzi|2' => ['oa' => 3, 'ov' => 2, 'stay' => 2, 'vec' => 1.5],
            'jacuzzi|3' => ['oa' => 3, 'ov' => 2, 'stay' => 2, 'vec' => 1.5],
            'main-building|2' => ['oa' => 2.5, 'ov' => 2, 'stay' => 2, 'vec' => 1.5],
            'main-building|3' => ['oa' => 2.5, 'ov' => 2, 'stay' => 2, 'vec' => 1.5],
            'premier|2' => ['oa' => 3.5, 'ov' => 3, 'stay' => 2.5, 'vec' => 2],
            'premier|3' => ['oa' => 3, 'ov' => 2.5, 'stay' => 2, 'vec' => 1.5],
            'royal|random' => ['oa' => 5, 'ov' => 4, 'stay' => 4, 'vec' => 3, 'premier' => 6.5],
            'royal|2' => ['oa' => 5, 'ov' => 4, 'stay' => 4, 'vec' => 3, 'premier' => 6.5],
        ];

        foreach ($formulas as $key => $values) {
            [$buildingSlug, $memberCount] = explode('|', $key);

            Formula::create([
                'building_slug' => $buildingSlug,
                'member_count'  => $memberCount,
                'oa'            => $values['oa'],
                'ov'            => $values['ov'],
                'stay'          => $values['stay'],
                'vec'           => $values['vec'],
                'premier'       => $values['premier'] ?? null,
            ]);
        }
    }
}
