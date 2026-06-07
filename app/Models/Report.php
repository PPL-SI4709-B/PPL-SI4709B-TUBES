<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'status',
        'catatan_petugas',
        'income',
        'expense',
        'profit',
        'catatan_usaha',
        'report_date',
        'period',
        'due_date',
        'reviewed_by',
        'reviewed_at',
        'lampiran',
    ];

    protected $casts = [
        'report_date' => 'date',
        'due_date' => 'date',
        'reviewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
