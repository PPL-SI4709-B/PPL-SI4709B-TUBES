@props(['status'])

@php
$class = match($status) {
    'diajukan'            => 'badge-pendanaan-diajukan',
    'menunggu_verifikasi' => 'badge-pendanaan-menunggu',
    'diproses'            => 'badge-pendanaan-diproses',
    'disetujui'           => 'badge-pendanaan-disetujui',
    'ditolak'             => 'badge-pendanaan-ditolak',
    default               => 'badge-pendanaan-diajukan',
};
$label = match($status) {
    'diajukan'            => 'Diajukan',
    'menunggu_verifikasi' => 'Menunggu Verifikasi',
    'diproses'            => 'Diproses',
    'disetujui'           => 'Disetujui',
    'ditolak'             => 'Ditolak',
    default               => ucfirst($status),
};
@endphp

<span class="badge {{ $class }}" style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: var(--radius-full); font-size: 0.7rem; font-weight: 600; letter-spacing: 0.025em;">{{ $label }}</span>
