<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'report_type',
        'group_id',
        'room_id',
        'description',
        'date',
        'reply',
        'point',
        'status',
        'status_updated_by',
    ];

    public function group()
    {
        return $this->belongsTo(CleaningGroup::class, 'group_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->hasMany(ReportMedia::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'report_members');
    }

    public function dailyPoints()
    {
        return $this->morphMany(DailyPoint::class, 'activity');
    }

    protected static function booted()
    {
        static::deleting(function ($report) {
            $report->dailyPoints()->delete();
        });
    }
}
