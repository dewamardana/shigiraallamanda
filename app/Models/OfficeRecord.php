<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class OfficeRecord extends Model
{
    protected $fillable = ['task_group_id', 'date'];

    public function details()
    {
        return $this->hasMany(OfficeTaskDetail::class, 'office_record_id');
    }

    public function group()
    {
        return $this->belongsTo(TaskGroup::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dailyPoints()
    {
        return $this->morphMany(DailyPoint::class, 'activity');
    }

    protected static function booted()
    {
        static::deleting(function ($record) {
            // hapus semua detail (jadi collection dulu)
            $record->details()->get()->each(function ($detail) {
                $detail->delete();
            });

            // hapus daily points
            $record->dailyPoints()->delete();
        });
    }
}
