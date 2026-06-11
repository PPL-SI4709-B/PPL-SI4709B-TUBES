@extends('layouts.app')

@section('title', 'Detail Event - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="event" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.event') }}" style="color: var(--color-text-muted);">Event</a>
        <span style="margin: 0 0.5rem;">&rsaquo;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Detail</span>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 56rem; margin: 0 auto;">
    <div class="page-header" style="margin-bottom: 0;">
        <div>
            <a href="{{ route('umkm.event') }}" class="link-action">Kembali ke Event</a>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-2);">{{ $event->title }}</h1>
            <p class="page-subtitle">Detail jadwal, lokasi, kuota, dan deskripsi event atau pelatihan.</p>
        </div>
        <span class="badge badge-success">{{ ucfirst($event->type) }}</span>
    </div>

    <section class="content-card">
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-label">Tanggal & Waktu</div>
                <div class="detail-value">{{ $event->event_date->format('d M Y, H:i') }} WIB</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Lokasi</div>
                <div class="detail-value">{{ $event->location }}</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Kuota</div>
                <div class="detail-value">{{ $event->quota }} peserta</div>
            </div>
        </div>

        <div class="detail-section" style="margin-top: var(--space-5);">
            <div class="detail-label">Deskripsi</div>
            <div class="soft-panel" style="white-space: pre-line;">{{ $event->description ?: 'Belum tersedia' }}</div>
        </div>
    </section>
</div>
@endsection
