@extends('layouts.app')

@section('title', 'Notifikasi Dinas - Portal UMKM')

@section('sidebar')
<x-dinas-sidebar active="notifications" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Notifikasi Dinas</div>
        <div class="page-subtitle">Pembaruan tugas verifikasi dan informasi layanan Dinas.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="support-page">
    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Pembaruan Dinas</div>
            <h1>Daftar Notifikasi</h1>
            <p class="page-subtitle">Tinjau notifikasi terbaru dan tandai sebagai dibaca setelah selesai diproses.</p>
        </div>
    </div>

    <section class="content-card">
        <div class="section-list">
            @forelse($notifications as $notification)
                @php
                    $data = is_string($notification->data) ? json_decode($notification->data, true) : $notification->data;
                    $data = is_array($data) ? $data : [];
                @endphp
                <article class="list-card" style="background-color: {{ $notification->read_at ? '#FFFFFF' : 'var(--color-primary-soft)' }};">
                    <div class="stat-card-row">
                        <div style="flex: 1; min-width: 0;">
                            <span class="badge {{ $notification->read_at ? 'badge-secondary' : 'badge-info' }}">{{ str_replace('_', ' ', $notification->type) }}</span>
                            <p style="color: var(--color-gray-900); font-size: var(--text-sm); line-height: 1.6; margin-top: var(--space-3);">
                                @if(isset($data['message']))
                                    {{ $data['message'] }}
                                @else
                                    Notifikasi baru.
                                @endif
                            </p>
                            <span class="stat-note" style="display: block; margin-top: var(--space-2);">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>

                        @if(!$notification->read_at)
                            <form action="{{ route('dinas.notifications.markAsRead', $notification) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="link-action">Tandai sudah dibaca</button>
                            </form>
                        @endif
                    </div>
                </article>
            @empty
                <div class="support-empty-state">
                    <span class="support-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    </span>
                    <h3>Belum ada notifikasi</h3>
                    <p>Belum ada notifikasi untuk akun Dinas saat ini.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection
