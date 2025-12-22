<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['room_name', 'cleaning_group_id'];

    public function group()
    {
        return $this->belongsTo(CleaningGroup::class, 'cleaning_group_id');
    }
}
