<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckRecords extends Model
{
    protected $guarded = ['id'];
    
    public function checking()
    {
        return $this->belongsTo(Checks::class,'check_id');
    }
}
