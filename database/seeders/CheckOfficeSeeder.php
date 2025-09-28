<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Checks;
use App\Models\DailyPoint;
use App\Models\CheckerTask;
use App\Models\CheckRecords;
use App\Models\FormulaCheck;
use App\Models\CheckerRecord;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\DailyCleaningPoint;
use App\Models\CheckerRecordDetail;
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

        // Ambil semua task aktif
        $tasks = CheckerTask::where('active', true)->get();
        if ($tasks->isEmpty()) {
            $this->command->info('Tidak ada CheckerTask aktif.');
            return;
        }

        for ($i = 0; $i < 7; $i++) {
            foreach ($users as $user) {
                $date = $startDate->copy()->toDateString();
                $createdAt = Carbon::parse($date)->addHours(rand(6, 18));

                // Buat record utama
                $record = CheckerRecord::create([
                    'user_id'     => $user->id,
                    'date'        => $date,
                    'total_point' => 0, // dihitung setelah detail masuk
                    'created_at'  => $createdAt,
                    'updated_at'  => $createdAt,
                ]);

                $totalPoint = 0;
                $activityDetail = [];

                // Generate detail untuk setiap task
                foreach ($tasks as $task) {
                    if ($task->type === 'number') {
                        $value = rand(1, 10); // contoh jumlah kamar
                    } else {
                        $value = rand(0, 1);  // contoh checkbox
                    }

                    $calculated = $value * $task->formula;
                    $totalPoint += $calculated;

                    CheckerRecordDetail::create([
                        'checker_record_id' => $record->id,
                        'checker_task_id'   => $task->id,
                        'value'             => $value,
                        'formula'           => $task->formula,
                        'calculated'        => $calculated,
                        'created_at'        => $createdAt,
                        'updated_at'        => $createdAt,
                    ]);

                    $activityDetail[] = $task->name . ': ' . $value;
                }

                // Update total point
                $record->update(['total_point' => $totalPoint]);

                // Simpan ke DailyPoint
                DailyPoint::create([
                    'user_id'        => $user->id,
                    'date'           => $date,
                    'activity_type'  => 'Checker',
                    'activity_id'    => $record->id,
                    'activity_detail' => implode(', ', $activityDetail),
                    'point'          => $totalPoint,
                    'created_at'     => $createdAt,
                    'updated_at'     => $createdAt,
                ]);
            }

            $startDate->addDay();
        }
    }
}
