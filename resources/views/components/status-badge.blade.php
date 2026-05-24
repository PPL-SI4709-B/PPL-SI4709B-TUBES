@props(['status'])

@php
$class = match($status) {
    'approved' => 'badge-approved',
    'rejected' => 'badge-rejected',
    default    => 'badge-pending',
};
$label = match($status) {
    'approved' => 'Disetujui',
    'rejected' => 'Ditolak',
    default    => 'Menunggu',
};
@endphp

<span class="badge {{ $class }}">{{ $label }}</span>
