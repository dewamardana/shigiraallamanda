<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CleaningGroup extends Model
{
    use HasFactory;

    protected $fillable = ['building_name', 'slug', 'description', 'foto', 'status'];


    public function tasks()
    {
        return $this->belongsToMany(CleaningTask::class, 'cleaning_group_tasks')
            ->withPivot('formula')
            ->withTimestamps();
    }

    public function records()
    {
        return $this->hasMany(CleaningRecord::class);
    }


    public function rooms()
    {
        return $this->hasMany(Room::class, 'cleaning_group_id');
    }

    public function checkerLocations()
    {
        return $this->hasMany(CheckerRecordLocation::class, 'cleaning_group_id');
    }


    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
