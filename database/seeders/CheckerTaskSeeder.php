<?php

namespace Database\Seeders;

use App\Models\CheckerTask;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CheckerTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'name'    => 'Cek Jumlah Kamar',
                'type'    => 'number',
                'formula' => 2.5,
                'active'  => true,
            ],
            [
                'name'    => 'Mengajar',
                'type'    => 'boolean',
                'formula' => 5,
                'active'  => true,
            ],
            [
                'name'    => 'Pembersihan Khusus',
                'type'    => 'boolean',
                'formula' => 3,
                'active'  => true,
            ],
            [
                'name'    => 'Mengangkat Barang',
                'type'    => 'boolean',
                'formula' => 2,
                'active'  => true,
            ],
            [
                'name'    => 'Membersihkan Gudang',
                'type'    => 'boolean',
                'formula' => 4,
                'active'  => true,
            ],
            [
                'name'    => 'Obat Pool',
                'type'    => 'boolean',
                'formula' => 3,
                'active'  => true,
            ],
            [
                'name'    => 'Membersihkan Pool',
                'type'    => 'boolean',
                'formula' => 4,
                'active'  => true,
            ],
            [
                'name'    => 'Membuang Sampah',
                'type'    => 'boolean',
                'formula' => 1,
                'active'  => true,
            ],
        ];

        foreach ($tasks as $task) {
            CheckerTask::updateOrCreate(
                ['name' => $task['name']], // biar tidak dobel
                $task
            );
        }
    }
}
