<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckerRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'total_point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(CheckerRecordDetail::class);
    }
}
