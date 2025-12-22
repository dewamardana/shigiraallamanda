<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CleaningRecordDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cleaning_record_id',
        'cleaning_task_id',
        'value',
        'rooms',
        'personal_value',
        'formula',
        'calculated',
    ];

    public function record()
    {
        return $this->belongsTo(CleaningRecord::class, 'cleaning_record_id');
    }

    public function task()
    {
        return $this->belongsTo(CleaningTask::class, 'cleaning_task_id');
    }

    protected $casts = [
        'rooms' => 'array', // ✅ tambahkan ini
    ];
}
