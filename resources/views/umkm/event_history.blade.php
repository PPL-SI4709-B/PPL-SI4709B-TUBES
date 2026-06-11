@extends('layouts.app')

@section('title', 'Riwayat Event - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="event-history" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Riwayat Event</div>
        <div class="page-subtitle">Pantau event dan pelatihan yang pernah Anda ikuti.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="support-page">
    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Event dan Pelatihan</div>
            <h1>Riwayat Event</h1>
            <p class="page-subtitle">Daftar event dan pelatihan yang sudah Anda daftar atau ikuti.</p>
        </div>
        <a href="{{ route('umkm.event') }}" class="btn btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Event
        </a>
    </div>

    <section class="content-card">
        <div class="section-list">
            @forelse ($registrations as $registration)
                @php
                    $event = $registration->event;
                    $isEventPast = $event?->event_date ? $event->event_date->isPast() : false;
                    $isEventCompleted = in_array($event?->status, ['inactive', 'completed'], true) || $isEventPast;
                    $registrationStatus = $registration->status ?? 'registered';
                    $keepsOwnStatus = in_array($registrationStatus, ['rejected', 'cancelled'], true);

                    if ($isEventCompleted && ! $keepsOwnStatus) {
                        $statusClass = 'badge-success';
                        $statusLabel = 'Selesai';
                    } else {
                        $statusClass = match ($registrationStatus) {
                            'registered' => 'badge-info',
                            'approved' => 'badge-success',
                            'rejected' => 'badge-danger',
                            'completed' => 'badge-success',
                            'cancelled' => 'badge-danger',
                            default => 'badge-warning',
                        };
                        $statusLabel = match ($registrationStatus) {
                            'registered' => 'Menunggu Pelaksanaan',
                            'pending' => 'Menunggu Konfirmasi',
                            'approved' => 'Terdaftar',
                            'rejected' => 'Ditolak',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                            default => ucfirst($registrationStatus),
                        };
                    }
                @endphp
                <article class="list-card support-list-card">
                    <div style="flex: 1; min-width: 0;">
                        <div class="support-meta">
                            <span class="badge badge-info">{{ ucfirst($event?->type ?? 'Event') }}</span>
                            <span>{{ optional($event?->event_date)->format('d M Y, H:i') ?? 'Tanggal belum tersedia' }}</span>
                            <span>{{ $event?->location ?? 'Lokasi belum tersedia' }}</span>
                        </div>
                        <h2 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin: var(--space-3) 0 var(--space-2);">
                            {{ $event?->title ?? 'Event belum tersedia' }}
                        </h2>
                        <span class="badge {{ $statusClass }}">Status: {{ $statusLabel }}</span>
                    </div>

                    @if($event)
                        <a href="{{ route('umkm.event.show', $event) }}" class="btn btn-secondary" style="white-space: nowrap;">Detail Event</a>
                    @endif
                </article>
            @empty
                <div class="support-empty-state">
                    <span class="support-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </span>
                    <h3>Belum ada riwayat</h3>
                    <p>Anda belum berpartisipasi dalam event atau pelatihan.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection
