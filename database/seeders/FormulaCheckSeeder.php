<?php

namespace Database\Seeders;

use App\Models\FormulaCheck;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormulaCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormulaCheck::create([
            'name' => 'Formula Check A',
            'description' => 'Contoh formula aktif',
            'active' => true,
            'jumlah_kamar' => 5,
            'mengajar' => 2.5,
            'pembersihan_khusus' => 1.0,
            'mengangkat_barang' => 2.0,
            'membersihkan_gudang' => 1.5,
            'obat_pool' => 3.0,
            'membersihkan_pool' => 2.0,
            'sampah' => 3.5,
        ]);

        FormulaCheck::create([
            'name' => 'Formula Check B',
            'description' => 'Contoh formula tidak aktif',
            'active' => false,
            'jumlah_kamar' => 3,
            'mengajar' => 1.0,
            'pembersihan_khusus' => 2.5,
            'mengangkat_barang' => 1.0,
            'membersihkan_gudang' => 1.0,
            'obat_pool' => 2.0,
            'membersihkan_pool' => 2.5,
            'sampah' => 2.0,
        ]);
    }
}
