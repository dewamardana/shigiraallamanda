<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckerRecordDetail extends Model
{

    use HasFactory;

    protected $fillable = [
        'checker_record_id',
        'checker_task_id',
        'value',
        'formula',
        'calculated',
    ];

    public function record()
    {
        return $this->belongsTo(CheckerRecord::class, 'checker_record_id');
    }

    public function task()
    {
        return $this->belongsTo(CheckerTask::class, 'checker_task_id');
    }
}
