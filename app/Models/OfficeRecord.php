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
}
