<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckerRecordLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'checker_record_detail_id',
        'cleaning_group_id',
        'rooms',
    ];

    protected $casts = [
        'rooms' => 'array',
    ];

    public function detail()
    {
        return $this->belongsTo(CheckerRecordDetail::class, 'checker_record_detail_id');
    }

    public function group()
    {
        return $this->belongsTo(CleaningGroup::class, 'cleaning_group_id');
    }
}
