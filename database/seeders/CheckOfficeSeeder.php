<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Checks;
use App\Models\DailyPoint;
use App\Models\CheckRecords;
use App\Models\FormulaCheck;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\DailyCleaningPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CheckOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $startDate = Carbon::now()->subDays(6); // 7 hari ke belakang

        $formula = FormulaCheck::where('active', true)->first();
        if (!$formula) {
            $this->command->info('Formula aktif tidak ditemukan.');
            return;
        }

        for ($i = 0; $i < 7; $i++) {
            foreach ($users as $user) {
                // Random nilai input
                $jumlah_kamar = rand(1, 10);
                $mengajar = rand(0, 1);
                $pembersihan_khusus = rand(0, 1);
                $mengangkat_barang = rand(0, 1);
                $membersihkan_gudang = rand(0, 1);
                $obat_pool = rand(0, 1);
                $membersihkan_pool = rand(0, 1);
                $sampah = rand(0, 1);

                $date = $startDate->copy()->toDateString();
                $createdAt = Carbon::parse($date)->addHours(rand(6, 18));

                // Simpan ke tabel checks
                $check = Checks::create([
                    'user_id'               => $user->id,
                    'jumlah_kamar'          => $jumlah_kamar,
                    'mengajar'              => $mengajar,
                    'pembersihan_khusus'    => $pembersihan_khusus,
                    'mengangkat_barang'     => $mengangkat_barang,
                    'membersihkan_gudang'   => $membersihkan_gudang,
                    'obat_pool'             => $obat_pool,
                    'membersihkan_pool'     => $membersihkan_pool,
                    'sampah'                => $sampah,
                    'date'                  => $date,
                    'created_at'            => $createdAt,
                    'updated_at'            => $createdAt,
                ]);

                // Hitung total poin
                $total =
                    ($jumlah_kamar * $formula->jumlah_kamar) +
                    ($mengajar * $formula->mengajar) +
                    ($pembersihan_khusus * $formula->pembersihan_khusus) +
                    ($mengangkat_barang * $formula->mengangkat_barang) +
                    ($membersihkan_gudang * $formula->membersihkan_gudang) +
                    ($obat_pool * $formula->obat_pool) +
                    ($membersihkan_pool * $formula->membersihkan_pool) +
                    ($sampah * $formula->sampah);

                // Simpan check record
                CheckRecords::create([
                    'check_id'              => $check->id,
                    'jumlah_kamar'          => $jumlah_kamar,
                    'mengajar'              => $mengajar * $formula->mengajar,
                    'pembersihan_khusus'    => $pembersihan_khusus * $formula->pembersihan_khusus,
                    'mengangkat_barang'     => $mengangkat_barang * $formula->mengangkat_barang,
                    'membersihkan_gudang'   => $membersihkan_gudang * $formula->membersihkan_gudang,
                    'obat_pool'             => $obat_pool * $formula->obat_pool,
                    'membersihkan_pool'     => $membersihkan_pool * $formula->membersihkan_pool,
                    'sampah'                => $sampah * $formula->sampah,
                    'total'                 => $total,
                    'created_at'            => $createdAt,
                    'updated_at'            => $createdAt,
                ]);

                // DailyCleaningPoint untuk Check Seeder
                $detailArray = [
                    'Kamar'              => $jumlah_kamar,
                    'Mengajar'           => $mengajar,
                    'Pembersihan Khusus' => $pembersihan_khusus,
                    'Mengangkat Barang'  => $mengangkat_barang,
                    'Membersihkan Gudang' => $membersihkan_gudang,
                    'Obat Pool'          => $obat_pool,
                    'Membersihkan Pool'  => $membersihkan_pool,
                    'Sampah'             => $sampah
                ];

                $detailString = collect($detailArray)
                    ->map(fn($val, $key) => "$key: $val")
                    ->implode(', ');

                DailyPoint::create([
                    'user_id'        => $user->id,
                    'date'           => $date,
                    'activity_type'  => Checks::class,
                    'activity_id'    => $check->id,
                    'activity_detail' => $detailString,
                    'point'          => $total,
                    'created_at'     => $createdAt,
                    'updated_at'     => $createdAt,
                ]);
            }

            $startDate->addDay();
        }
    }
}
