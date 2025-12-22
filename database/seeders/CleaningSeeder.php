<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use App\Models\CleaningTask;
use App\Models\CleaningGroup;
use App\Models\CleaningRecord;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Traits\HandlesDailyPoints;
use App\Models\CleaningRecordDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CleaningSeeder extends Seeder
{
    use HandlesDailyPoints;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        if ($users->isEmpty()) {
            $this->command->warn('Tidak ada user ditemukan, seeder dihentikan.');
            return;
        }

        // Data group dan task
        $groups = [
            [
                'building_name' => 'Lagoon',
                'slug' => 'lagoon',
                'description' => 'Gedung Lagoon',
                'foto' => null,
                'room_count' => 50,
                'tasks' => [
                    ['name' => 'OA',   'formula' => 4],
                    ['name' => 'OV',   'formula' => 3],
                    ['name' => 'Stay', 'formula' => 3],
                    ['name' => 'Vec',  'formula' => 2],
                ]
            ],
            [
                'building_name' => 'Jacuzzi',
                'slug' => 'jacuzzi',
                'description' => 'Gedung Jacuzzi',
                'foto' => null,
                'room_count' => 30,
                'tasks' => [
                    ['name' => 'OA',   'formula' => 3],
                    ['name' => 'OV',   'formula' => 2],
                    ['name' => 'Stay', 'formula' => 2],
                    ['name' => 'Vec',  'formula' => 1.5],
                ]
            ],
            [
                'building_name' => 'Main Building',
                'slug' => 'main-building',
                'description' => 'Gedung Utama',
                'foto' => null,
                'room_count' => 60,
                'tasks' => [
                    ['name' => 'OA',   'formula' => 2.5],
                    ['name' => 'OV',   'formula' => 2],
                    ['name' => 'Stay', 'formula' => 2],
                    ['name' => 'Vec',  'formula' => 1.5],
                ]
            ],
            [
                'building_name' => 'Premier',
                'slug' => 'premier',
                'description' => 'Gedung Premier',
                'foto' => null,
                'room_count' => 40,
                'tasks' => [
                    ['name' => 'OA',   'formula' => 3.5],
                    ['name' => 'OV',   'formula' => 3],
                    ['name' => 'Stay', 'formula' => 2.5],
                    ['name' => 'Vec',  'formula' => 2],
                ]
            ],
            [
                'building_name' => 'Royal',
                'slug' => 'royal',
                'description' => 'Gedung Royal',
                'foto' => null,
                'room_count' => 80,
                'tasks' => [
                    ['name' => 'OA',      'formula' => 5],
                    ['name' => 'OV',      'formula' => 4],
                    ['name' => 'Stay',    'formula' => 4],
                    ['name' => 'Vec',     'formula' => 3],
                    ['name' => 'Premier', 'formula' => 6.5],
                ]
            ],
        ];

        $startDate = Carbon::now()->subDays(6);

        foreach ($groups as $groupData) {
            $tasks = $groupData['tasks'];
            $roomCount = $groupData['room_count'];
            unset($groupData['tasks'], $groupData['room_count']);

            // Buat group
            $group = CleaningGroup::firstOrCreate(
                ['slug' => $groupData['slug']],
                $groupData
            );

            // Tambahkan Room untuk setiap Group
            for ($i = 1; $i <= $roomCount; $i++) {
                Room::firstOrCreate([
                    'room_name' => "{$group->building_name} - {$i}",
                ], [
                    'cleaning_group_id' => $group->id,
                ]);
            }

            // Hubungkan task ke group (pivot)
            foreach ($tasks as $taskData) {
                $task = CleaningTask::firstOrCreate(['name' => $taskData['name']]);
                $group->tasks()->syncWithoutDetaching([
                    $task->id => ['formula' => $taskData['formula']]
                ]);
            }

            // Generate record selama 7 hari
            for ($i = 0; $i < 7; $i++) {
                $date = $startDate->copy()->addDays($i)->toDateString();
                $memberCount = rand(2, 4);
                $inputter = $users->random();

                $record = CleaningRecord::create([
                    'cleaning_group_id' => $group->id,
                    'user_id'           => $inputter->id,
                    'member_count'      => $memberCount,
                    'total_room'        => 0,
                    'date'              => $date,
                ]);

                $assignedUsers = $users->random($memberCount)->pluck('id');
                $record->members()->attach($assignedUsers);

                $totalRoomCalc = 0;
                foreach ($group->tasks as $task) {
                    $value = rand(1, 5);
                    $formula = $task->pivot->formula;
                    $calculated = $value * $formula;

                    $rooms = $group->rooms()->inRandomOrder()->limit($value)->pluck('id')->toArray();

                    CleaningRecordDetail::create([
                        'cleaning_record_id' => $record->id,
                        'cleaning_task_id'   => $task->id,
                        'value'              => $value,
                        'rooms'              => $rooms,
                        'formula'            => $formula,
                        'calculated'         => $calculated,
                    ]);

                    $totalRoomCalc += $value;
                }

                $record->update([
                    'total_room'  => $totalRoomCalc,
                    'total_point' => $record->details()->sum('calculated'),
                ]);

                foreach ($assignedUsers as $uid) {
                    $this->addDailyPoint(
                        $uid,
                        $date,
                        $record->total_point / $memberCount,
                        'cleaning',
                        $record->id,
                        [
                            'group' => $group->building_name,
                            'tasks' => $record->details->pluck('value', 'cleaning_task_id'),
                        ]
                    );
                }
            }
        }
    }
}
