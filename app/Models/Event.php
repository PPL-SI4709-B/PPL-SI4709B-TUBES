<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'event_date',
        'quota',
        'type',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
        ];
    }
}
