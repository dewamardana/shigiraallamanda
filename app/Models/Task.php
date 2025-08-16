<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_group_id', 'name', 'point'];

    public function group()
    {
        return $this->belongsTo(TaskGroup::class, 'task_group_id');
    }

    public function details()
    {
        return $this->hasMany(OfficeTaskDetail::class, 'task_id');
    }
}
