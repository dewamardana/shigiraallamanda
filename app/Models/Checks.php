<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checks extends Model
{
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poinRecord()
    {
        return $this->hasOne(CheckRecords::class, 'check_id');
    }

        protected $casts = [
        'date' => 'date', // supaya otomatis jadi Carbon
    ];
}
