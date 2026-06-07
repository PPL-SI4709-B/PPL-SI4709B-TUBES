<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPendanaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sumber_pendanaan_id',
        'jumlah_pengajuan',
        'tujuan_pendanaan',
        'deskripsi_kebutuhan',
        'dokumen_pendukung',
        'status',
        'catatan',
        'reviewed_by',
        'reviewed_at',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at'    => 'datetime',
            'reviewed_at'     => 'datetime',
            'jumlah_pengajuan' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sumberPendanaan()
    {
        return $this->belongsTo(SumberPendanaan::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get human-readable status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'diajukan'             => 'Diajukan',
            'menunggu_verifikasi'  => 'Menunggu Verifikasi',
            'diproses'             => 'Diproses',
            'disetujui'            => 'Disetujui',
            'ditolak'              => 'Ditolak',
            default                => ucfirst($this->status),
        };
    }
}
