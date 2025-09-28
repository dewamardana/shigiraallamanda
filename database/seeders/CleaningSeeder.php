<?php

namespace Database\Seeders;

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

        // Data building + task
        $groups = [
            [
                'building_name' => 'Lagoon',
                'slug' => 'lagoon',
                'description' => 'Gedung Lagoon',
                'foto' => null,
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
                'tasks' => [
                    ['name' => 'OA',      'formula' => 5],
                    ['name' => 'OV',      'formula' => 4],
                    ['name' => 'Stay',    'formula' => 4],
                    ['name' => 'Vec',     'formula' => 3],
                    ['name' => 'Premier', 'formula' => 6.5],
                ]
            ],
        ];

        $startDate = Carbon::now()->subDays(6); // 7 hari ke belakang

        foreach ($groups as $groupData) {
            $tasks = $groupData['tasks'];
            unset($groupData['tasks']);

            // Buat cleaning group
            $group = CleaningGroup::firstOrCreate(
                ['slug' => $groupData['slug']],
                $groupData
            );

            // Attach tasks ke group (pivot dengan formula)
            foreach ($tasks as $taskData) {
                $task = CleaningTask::firstOrCreate(
                    ['name' => $taskData['name']]
                );

                // hubungkan lewat pivot dengan formula
                $group->tasks()->syncWithoutDetaching([
                    $task->id => ['formula' => $taskData['formula']]
                ]);
            }

            // Generate cleaning record selama 7 hari
            for ($i = 0; $i < 7; $i++) {
                $date = $startDate->copy()->addDays($i)->toDateString();
                $memberCount = ($group->slug == 'royal') ? rand(2, 5) : rand(2, 3);
                $memberCount = min($memberCount, $users->count());

                // pilih siapa yg input
                $inputter = $users->random();

                // Buat record
                $record = CleaningRecord::create([
                    'cleaning_group_id' => $group->id,
                    'user_id'           => $inputter->id,
                    'member_count'      => $memberCount,
                    'total_room'        => 0,
                    'date'              => $date,
                ]);

                // assign members ke record
                $assignedUsers = $users->random($memberCount)->pluck('id');
                $record->members()->attach($assignedUsers);

                // isi detail task
                $totalRoomCalc = 0;
                foreach ($group->tasks as $task) {
                    $value = rand(0, 5); // jumlah kamar
                    $formula = $task->pivot->formula; // formula dari pivot
                    $calculated = $value * $formula;

                    CleaningRecordDetail::create([
                        'cleaning_record_id' => $record->id,
                        'cleaning_task_id'   => $task->id,
                        'value'              => $value,
                        'formula'            => $formula,
                        'calculated'         => $calculated,
                    ]);

                    $totalRoomCalc += $value;
                }

                // update total room & total_point
                $record->update([
                    'total_room'  => $totalRoomCalc,
                    'total_point' => $record->details()->sum('calculated'),
                ]);

                // Tambahkan ke DailyPoint untuk semua member yang ikut cleaning
                foreach ($assignedUsers as $uid) {
                    $this->addDailyPoint(
                        $uid,
                        $date,
                        $record->total_point / $memberCount, // bagi rata poin
                        'cleaning',
                        $record->id,
                        [
                            'group'   => $group->building_name,
                            'tasks'   => $record->details->pluck('value', 'cleaning_task_id'),
                        ]
                    );
                }
            }
        }
    }
}
