<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'report_type',
        'description',
        'date',
        'point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->hasMany(ReportMedia::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'report_members');
    }
}
