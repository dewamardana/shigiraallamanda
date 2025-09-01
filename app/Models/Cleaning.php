<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cleaning extends Model
{
    protected $guarded = ['id'];

    public function members()
    {
        return $this->belongsToMany(User::class, 'cleaning_user');
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poinRecord()
    {
        return $this->hasOne(CleaningRecords::class);
    }
    public function dailyPoints()
    {
        return $this->morphMany(DailyPoint::class, 'activity');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($cleaning) {
            // 1. Hapus pivot members
            $cleaning->members()->detach();

            // 2. Hapus record formula poin
            $cleaning->poinRecord()->delete();

            // 3. Hapus semua daily_points yg terkait cleaning ini
            DailyPoint::where('activity_type', Cleaning::class)
                ->where('activity_id', $cleaning->id)
                ->delete();
        });
    }
}
