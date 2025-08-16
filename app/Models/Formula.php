<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Building;

class Formula extends Model
{
    protected $fillable = [
        'building_slug',
        'member_count',
        'oa',
        'ov',
        'stay',
        'vec',
        'premier'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_slug', 'slug');
    }

}
