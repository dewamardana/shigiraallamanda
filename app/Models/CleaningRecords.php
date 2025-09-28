<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleaningRecords extends Model
{
    protected $guarded = ['id'];

    public function cleaning()
    {
        return $this->belongsTo(Cleaning::class);
    }
}
