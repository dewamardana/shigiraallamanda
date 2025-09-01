<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeTaskDetail extends Model
{
    protected $fillable = ['office_record_id', 'task_id', 'user_id', 'point'];

    public function record()
    {
        return $this->belongsTo(OfficeRecord::class, 'office_record_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
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
        static::deleting(function ($office) {
            $office->dailyPoints()->delete();
        });
    }
}
