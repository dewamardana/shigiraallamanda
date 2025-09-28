<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckerTask extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'formula', 'active'];

    public function details()
    {
        return $this->hasMany(CheckerRecordDetail::class, 'checker_task_id');
    }
}
