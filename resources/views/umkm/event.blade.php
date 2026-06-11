@extends('layouts.app')

@section('title', 'Event dan Pelatihan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="event" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Event dan Pelatihan
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
<div class="flex flex-col gap-6" style="max-width: 72rem; margin: 0 auto;">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-kicker">Event UMKM</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Event dan Pelatihan</h1>
            <p class="page-subtitle">Program pelatihan, seminar, dan bootcamp dari Dinas untuk pelaku UMKM.</p>
        </div>
    </div>

    <form method="GET" action="{{ route('umkm.event') }}" class="content-card" style="display: flex; gap: var(--space-3); flex-wrap: wrap; align-items: end;">
        <div class="form-group" style="flex: 1; min-width: 14rem;">
            <label for="search" class="form-label">Cari Event</label>
            <input id="search" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama event..." class="form-control">
        </div>
        <div class="form-group" style="min-width: 12rem;">
            <label for="type" class="form-label">Jenis</label>
            <select id="type" name="type" class="form-control">
                <option value="">Semua Jenis</option>
                @foreach($types as $t)
                    <option value="{{ $t }}" {{ ($type ?? '') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
        @if(!empty($search) || !empty($type))
            <a href="{{ route('umkm.event') }}" class="btn btn-secondary">Reset</a>
        @endif
    </form>

    @if($events->count())
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(19rem, 100%), 1fr)); gap: var(--space-5);">
            @foreach ($events as $event)
                @php
                    $typeColors = match(strtolower($event->type)) {
                        'bootcamp' => ['bg' => '#FEF3C7', 'text' => '#92400E'],
                        'pelatihan' => ['bg' => 'var(--color-primary-soft)', 'text' => 'var(--color-primary)'],
                        'seminar' => ['bg' => '#EFF6FF', 'text' => '#1D4ED8'],
                        'workshop' => ['bg' => '#DCFCE7', 'text' => '#166534'],
                        default => ['bg' => '#F1F5F9', 'text' => 'var(--color-text-muted)'],
                    };
                    $registeredCount = $event->registrants()->count();
                    $isFull = $registeredCount >= $event->quota;
                    $isRegistered = in_array($event->id, $registeredEventIds ?? []);
                @endphp

                <article class="content-card" style="display: flex; flex-direction: column; gap: var(--space-4); padding: 0; overflow: hidden;">
                    <div style="background: var(--color-primary); padding: var(--space-5);">
                        <span class="badge" style="background-color: {{ $typeColors['bg'] }}; color: {{ $typeColors['text'] }}; margin-bottom: var(--space-3);">
                            {{ ucfirst($event->type) }}
                        </span>
                        <h2 style="font-size: 1rem; font-weight: 800; color: white; margin: 0; line-height: 1.4;">{{ $event->title }}</h2>
                    </div>

                    <div style="padding: 0 var(--space-5); display: flex; flex-direction: column; gap: var(--space-3); flex: 1;">
                        <div class="detail-section">
                            <div class="detail-label">Tanggal</div>
                            <div class="detail-value">{{ $event->event_date->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="detail-section">
                            <div class="detail-label">Lokasi</div>
                            <div class="detail-value">{{ $event->location }}</div>
                        </div>
                        @if($event->description)
                            <p style="font-size: var(--text-sm); color: var(--color-text-muted); margin: 0; line-height: 1.6;">
                                {{ \Illuminate\Support\Str::limit($event->description, 96) }}
                            </p>
                        @endif
                    </div>

                    <div style="padding: var(--space-4) var(--space-5) var(--space-5); border-top: 1px solid var(--color-border); display: flex; flex-direction: column; gap: var(--space-3);">
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 800; text-transform: uppercase;">
                            <span>Kuota</span>
                            @if($isFull)
                                <span style="color: var(--color-danger);">Penuh</span>
                            @else
                                <span style="color: var(--color-gray-900);">{{ $registeredCount }} / {{ $event->quota }} peserta</span>
                            @endif
                        </div>

                        @if($isRegistered)
                            <button type="button" disabled class="btn btn-secondary" style="width: 100%; color: var(--color-success); background: var(--color-success-bg);">Sudah Terdaftar</button>
                        @elseif($isFull)
                            <button type="button" disabled class="btn btn-secondary" style="width: 100%; opacity: 0.75; cursor: not-allowed;">Penuh</button>
                        @else
                            <form action="{{ route('umkm.event.register', $event->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Daftar Sekarang</button>
                            </form>
                        @endif

                        <a href="{{ route('umkm.event.show', $event) }}" class="btn btn-secondary" style="width: 100%;">Lihat Detail</a>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <section class="content-card">
            <div class="empty-state">
                <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada event tersedia</h3>
                <p>Pantau halaman ini untuk event dan pelatihan terbaru dari Dinas.</p>
            </div>
        </section>
    @endif
</div>
@endsection
