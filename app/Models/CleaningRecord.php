<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CleaningRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'cleaning_group_id',
        'user_id',
        'member_count',
        'total_room',
        'total_point',
        'date',
    ];

    public function group()
    {
        return $this->belongsTo(CleaningGroup::class, 'cleaning_group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // leader/pencatat
    }

    public function details()
    {
        return $this->hasMany(CleaningRecordDetail::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'cleaning_record_user')
            ->withTimestamps();
    }
}
