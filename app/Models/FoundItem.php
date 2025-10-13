<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoundItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'found_by_id',
        'name',
        'location',
        'description',
        'serial_number',
        'media_files',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'media_files' => 'array',
    ];

    // Relasi opsional ke user (jika digunakan)
    public function foundBy()
    {
        return $this->belongsTo(User::class);
    }
}
