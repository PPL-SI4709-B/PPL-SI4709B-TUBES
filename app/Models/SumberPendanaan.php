<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberPendanaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_program',
        'mitra_penyalur',
        'batas_maksimal',
        'deskripsi',
        'persyaratan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'batas_maksimal' => 'decimal:2',
        ];
    }

    /**
     * Pengajuan pendanaan yang menggunakan sumber ini.
     */
    public function pengajuanPendanaans()
    {
        return $this->hasMany(PengajuanPendanaan::class);
    }
}
