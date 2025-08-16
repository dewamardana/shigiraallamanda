<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Building;
use App\Models\Cleaning;
use App\Models\CleaningRecords;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\DailyCleaningPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CleaningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = Building::all();
        $users = User::pluck('id');
        $startDate = Carbon::now()->subDays(6); // 7 hari ke belakang

        // Formula poin per building & member count
        $formulas = [
            'lagoon|2'         => ['oa' => 4, 'ov' => 3, 'stay' => 3, 'vec' => 2],
            'lagoon|3'         => ['oa' => 3, 'ov' => 2, 'stay' => 2, 'vec' => 1.5],
            'jacuzzi|2'        => ['oa' => 3, 'ov' => 2, 'stay' => 2, 'vec' => 1.5],
            'jacuzzi|3'        => ['oa' => 3, 'ov' => 2, 'stay' => 2, 'vec' => 1.5],
            'main-building|2'  => ['oa' => 2.5, 'ov' => 2, 'stay' => 2, 'vec' => 1.5],
            'main-building|3'  => ['oa' => 2.5, 'ov' => 2, 'stay' => 2, 'vec' => 1.5],
            'premier|2'        => ['oa' => 3.5, 'ov' => 3, 'stay' => 2.5, 'vec' => 2],
            'premier|3'        => ['oa' => 3, 'ov' => 2.5, 'stay' => 2, 'vec' => 1.5],
            'royal|random'     => ['oa' => 5, 'ov' => 4, 'stay' => 4, 'vec' => 3, 'premier' => 6.5],
        ];

        for ($i = 0; $i < 7; $i++) {
            foreach ($buildings as $building) {
                $buildingSlug = $building->slug;

                // Tentukan jumlah member
                $memberCount = ($buildingSlug == 'royal') ? rand(1, 5) : rand(2, 3);

                // Generate angka random
                $oa      = rand(0, 5);
                $ov      = rand(0, 5);
                $stay    = rand(0, 5);
                $vec     = rand(0, 5);
                $premier = ($buildingSlug == 'royal') ? rand(0, 3) : 0;

                // Tentukan user inputter
                $inputter = $users->random();

                // Tentukan tanggal cleaning
                $date = $startDate->copy()->toDateString();
                $createdAt = Carbon::parse($date)->addHours(rand(6, 18));

                // Simpan cleaning
                $cleaning = Cleaning::create([
                    'building_id' => $building->id,
                    'user_id'     => $inputter,
                    'oa'          => $oa,
                    'ov'          => $ov,
                    'stay'        => $stay,
                    'vec'         => $vec,
                    'premier'     => $premier,
                    'total_room'  => $oa + $ov + $stay + $vec + $premier,
                    'date'        => $date,
                    'created_at'  => $createdAt,
                    'updated_at'  => $createdAt,
                ]);

                // Assign random member
                $assignedUsers = $users->random($memberCount);
                $cleaning->members()->attach($assignedUsers);

                // Hitung poin
                $formulaKey = ($buildingSlug == 'royal') ? 'royal|random' : "{$buildingSlug}|{$memberCount}";
                $formula = $formulas[$formulaKey] ?? ['oa' => 0, 'ov' => 0, 'stay' => 0, 'vec' => 0, 'premier' => 0];

                $totalPoin = (
                    ($oa * $formula['oa']) +
                    ($ov * $formula['ov']) +
                    ($stay * $formula['stay']) +
                    ($vec * $formula['vec']) +
                    ($buildingSlug == 'royal' ? ($premier * ($formula['premier'] ?? 0)) : 0)
                );

                $poinPerUser = $memberCount > 0 ? $totalPoin / $memberCount : 0;

                // Simpan ke tabel poin_records
                CleaningRecords::create([
                    'cleaning_id'   => $cleaning->id,
                    'user_id' => $inputter,
                    'member_count'  => $memberCount,
                    'oa'          => $oa,
                    'ov'          => $ov,
                    'stay'        => $stay,
                    'vec'         => $vec,
                    'premier'     => $premier,
                ]);

                // Simpan ke daily_cleaning_points menggunakan format baru
                    foreach ($assignedUsers as $userId) {
                        $detailArray = [
                            'OA'      => $oa,
                            'OV'      => $ov,
                            'Stay'    => $stay,
                            'Vec'     => $vec,
                        ];

                        if ($buildingSlug == 'royal') {
                            $detailArray['Premier'] = $premier;
                        }

                        DailyCleaningPoint::create([
                            'user_id'         => $userId,
                            'date'            => $date,
                            'activity_type'   => 'Cleaning',
                            'activity_detail' => collect($detailArray)
                                                    ->map(fn($val, $key) => "$key: $val")
                                                    ->implode(', '),
                            'point'           => $poinPerUser,
                            'created_at'      => $createdAt,
                            'updated_at'      => $createdAt,
                        ]);
                    }
            }

            $startDate->addDay();
        }
    }

}
