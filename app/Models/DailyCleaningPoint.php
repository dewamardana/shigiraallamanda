<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyCleaningPoint extends Model
{
    protected $fillable = [
        'user_id', 
        'date', 
        'activity_type', 
        'activity_detail', 
        'point'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
