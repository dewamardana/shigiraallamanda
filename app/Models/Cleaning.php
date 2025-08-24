<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cleaning extends Model
{
    protected $guarded = ['id'];

    public function members()
    {
        return $this->belongsToMany(User::class, 'cleaning_user');
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poinRecord()
    {
        return $this->hasOne(CleaningRecords::class);
    }


}
