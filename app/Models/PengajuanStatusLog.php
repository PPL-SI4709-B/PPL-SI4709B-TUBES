<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanStatusLog extends Model
{
    protected $fillable = [
        'pengajuan_id',
        'status',
        'catatan',
        'created_by',
    ];

    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(PengajuanPendanaan::class, 'pengajuan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
