<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
