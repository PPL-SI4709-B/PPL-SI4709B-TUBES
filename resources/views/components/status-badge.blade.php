@props(['status'])

@php
$class = match($status) {
    'approved', 'verified', 'reviewed' => 'badge-approved',
    'rejected' => 'badge-rejected',
    default => 'badge-pending',
};
$label = match($status) {
    'approved' => 'Disetujui',
    'verified' => 'Terverifikasi',
    'reviewed' => 'Direview',
    'rejected' => 'Ditolak',
    default => 'Menunggu',
};
@endphp

<span class="badge {{ $class }}">{{ $label }}</span>
