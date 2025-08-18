<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupsWithTasks = [
            'Pagi' => [
                ['name' => 'Menyapu Halaman', 'point' => 10],
                ['name' => 'Mengepel Lantai Lobi', 'point' => 15],
                ['name' => 'Membersihkan Toilet', 'point' => 20],
                ['name' => 'Mengelap Jendela Depan', 'point' => 12],
                ['name' => 'Merapikan Ruang Tamu', 'point' => 8],
            ],
            'Siang' => [
                ['name' => 'Mengangkat Sampah', 'point' => 14],
                ['name' => 'Membersihkan Pantry', 'point' => 16],
                ['name' => 'Menyapu Tangga', 'point' => 11],
                ['name' => 'Mengecek Kebersihan Gudang', 'point' => 18],
                ['name' => 'Membersihkan Ruang Meeting', 'point' => 13],
            ],
            'Malam' => [
                ['name' => 'Menyapu Basement', 'point' => 17],
                ['name' => 'Mengelap Lift & Pegangan', 'point' => 15],
                ['name' => 'Mengepel Lorong', 'point' => 19],
                ['name' => 'Membersihkan Toilet Umum', 'point' => 20],
                ['name' => 'Cek & Bersihkan Area Parkir', 'point' => 16],
            ],
        ];

        foreach ($groupsWithTasks as $groupName => $tasks) {
            $taskGroup = TaskGroup::create([
                'name' => $groupName,
                'active' => $groupName === 'Pagi', // hanya pagi yang aktif
            ]);

            foreach ($tasks as $task) {
                Task::create([
                    'task_group_id' => $taskGroup->id,
                    'name' => $task['name'],
                    'point' => $task['point'],
                ]);
            }
        }
    }
}
