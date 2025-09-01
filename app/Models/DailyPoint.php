<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyPoint extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'activity_id',
        'activity_type',
        'activity_detail',
        'point'
    ];

    protected $casts = [
        'activity_detail' => 'array', // otomatis jadi array saat diambil
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Polymorphic relation
    public function activity()
    {
        return $this->morphTo();
    }
}
