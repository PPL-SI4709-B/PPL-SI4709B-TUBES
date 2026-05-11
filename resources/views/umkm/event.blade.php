@extends('layouts.app')

@section('sidebar')
<x-umkm-sidebar active="event" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Event &amp; Pelatihan
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
<div class="flex flex-col gap-6" style="max-width: 64rem; margin: 0 auto;">

    <div>
        <h1 class="text-2xl font-bold text-gray-900">Event &amp; Pelatihan</h1>
        <p class="text-gray-500 text-sm mt-1">Daftar event dan pelatihan yang tersedia.</p>
    </div>

    @forelse ($events as $event)
        <div class="card" style="padding: var(--space-5);">
            <div class="flex justify-between items-start">
                <div style="flex: 1;">
                    <div style="font-size: var(--text-xs); font-weight: 600; text-transform: uppercase; color: var(--color-secondary); margin-bottom: var(--space-1);">{{ ucfirst($event->type) }}</div>
                    <div style="font-size: var(--text-base); font-weight: 700; color: var(--color-gray-900); margin-bottom: var(--space-2);">{{ $event->title }}</div>
                    <div style="font-size: var(--text-sm); color: var(--color-text-muted);">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline; margin-right: 4px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        {{ $event->event_date->format('d M Y, H:i') }}
                        &nbsp;&bull;&nbsp;
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline; margin-right: 4px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        {{ $event->location }}
                        &nbsp;&bull;&nbsp; Kuota: {{ $event->quota }}
                    </div>
                    @if($event->description)
                        <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: var(--space-2);">{{ Str::limit($event->description, 100) }}</div>
                    @endif
                </div>
                <a href="{{ route('umkm.event.show', $event) }}" class="btn btn-primary" style="margin-left: var(--space-4); white-space: nowrap; font-size: var(--text-sm);">
                    Lihat Detail
                </a>
            </div>
        </div>
    @empty
        <div class="card" style="padding: var(--space-12); text-align: center;">
            <div style="color: var(--color-text-muted); margin-bottom: var(--space-2);">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display: inline-block;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </div>
            <div style="font-size: var(--text-base); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada event tersedia</div>
            <div style="font-size: var(--text-sm); color: var(--color-text-muted);">Pantau halaman ini untuk event dan pelatihan terbaru.</div>
        </div>
    @endforelse

</div>
@endsection
