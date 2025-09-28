<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CleaningGroup extends Model
{
    use HasFactory;

    protected $fillable = ['building_name', 'slug', 'description', 'status', 'foto', 'status'];

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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
