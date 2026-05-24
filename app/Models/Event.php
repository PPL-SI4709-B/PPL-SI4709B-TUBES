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
        'date',
        'location',
        'quota',
        'status',
    ];

    public function registrants()
    {
        return $this->belongsToMany(User::class, 'event_registrations')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
