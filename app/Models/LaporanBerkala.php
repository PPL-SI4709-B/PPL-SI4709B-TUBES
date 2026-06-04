<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBerkala extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tahun',
        'kuartal',
        'omzet',
        'jumlah_karyawan',
        'kendala',
        'strategi_kedepan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
