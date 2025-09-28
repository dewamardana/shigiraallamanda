<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CleaningTask extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function groups()
    {
        return $this->belongsToMany(CleaningGroup::class, 'cleaning_group_tasks')
            ->withPivot('formula')
            ->withTimestamps();
    }

    public function recordDetails()
    {
        return $this->hasMany(CleaningRecordDetail::class);
    }
}
