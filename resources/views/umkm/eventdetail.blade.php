@extends('layouts.app')

@section('sidebar')
<x-umkm-sidebar active="event" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.event') }}" style="color: var(--color-text-muted);">Event</a>
        <span style="margin: 0 0.5rem;">&#8250;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Detail</span>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 48rem; margin: 0 auto;">

    <div>
        <a href="{{ route('umkm.event') }}" style="font-size: var(--text-sm); color: var(--color-secondary);">← Kembali ke Event</a>
    </div>

    <div class="card" style="padding: var(--space-6);">
        <div style="font-size: var(--text-xs); font-weight: 600; text-transform: uppercase; color: var(--color-secondary); margin-bottom: var(--space-2);">{{ ucfirst($event->type) }}</div>
        <h1 style="font-size: var(--text-xl); font-weight: 700; color: var(--color-gray-900); margin-bottom: var(--space-4);">{{ $event->title }}</h1>

        <div class="flex flex-col gap-3" style="margin-bottom: var(--space-6);">
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal & Waktu</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $event->event_date->format('d M Y, H:i') }} WIB</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Lokasi</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $event->location }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Kuota</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $event->quota }} peserta</div>
            </div>
        </div>

        @if($event->description)
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: var(--space-2);">Deskripsi</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); line-height: 1.6;">{{ $event->description }}</div>
            </div>
        @endif
    </div>

</div>
@endsection
