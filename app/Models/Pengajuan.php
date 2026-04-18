<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $fillable = [
        'user_id',
        'program_name',
        'kebutuhan_usaha',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
