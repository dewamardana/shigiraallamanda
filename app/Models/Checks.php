<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checks extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poinRecord()
    {
        return $this->hasOne(CheckRecords::class, 'check_id');
    }
    public function dailyPoints()
    {
        return $this->morphMany(DailyPoint::class, 'activity');
    }

    protected $casts = [
        'date' => 'date', // supaya otomatis jadi Carbon
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($check) {
            // 1. Hapus record formula poin
            $check->poinRecord()->delete();

            // 2. Hapus semua daily_points yg terkait checker ini
            DailyPoint::where('activity_type', Checks::class)
                ->where('activity_id', $check->id)
                ->delete();
        });
    }
}
