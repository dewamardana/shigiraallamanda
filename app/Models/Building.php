<?php

namespace App\Models;
use App\Models\Reservations;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function cleanings()
    {
        return $this->hasMany(Cleaning::class);
    }
    
}
