@extends('layouts.app')

@section('title', 'Kelola Event')

@section('sidebar')
<x-dinas-sidebar active="event" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Kelola Event dan Pelatihan</div>
    <div class="flex items-center gap-6">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()?->name }}</div>
                <div class="user-role">PETUGAS DINAS</div>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()?->name ?? 'P', 0, 1)) }}
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-kicker">Event dan Pelatihan</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Daftar Event</h1>
            <p class="page-subtitle">{{ $events->total() }} event terdaftar untuk publikasi kepada UMKM.</p>
        </div>
        <a href="{{ route('dinas.event.create') }}" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Event
        </a>
    </div>

    <section class="content-card">
        <div class="flex flex-col gap-3">
            @forelse ($events as $event)
                <div class="list-card">
                    <div style="flex: 1; min-width: 0;">
                        <div style="display: flex; align-items: center; gap: var(--space-3); flex-wrap: wrap;">
                            <h2 style="font-weight: 800; font-size: var(--text-base); color: var(--color-gray-900); margin: 0;">{{ $event->title }}</h2>
                            @php
                                $eventStatusLabel = $event->status === 'active' ? 'Aktif' : 'Selesai';
                                $eventStatusClass = $event->status === 'active' ? 'badge-success' : 'badge-secondary';
                            @endphp
                            <span class="badge {{ $eventStatusClass }}">
                                {{ $eventStatusLabel }}
                            </span>
                        </div>
                        @if ($event->description)
                            <p style="font-size: var(--text-sm); color: var(--color-text-muted); margin: var(--space-2) 0 0; line-height: 1.6;">{{ \Illuminate\Support\Str::limit($event->description, 120) }}</p>
                        @endif
                        <div style="display: flex; gap: var(--space-4); flex-wrap: wrap; margin-top: var(--space-3); font-size: var(--text-xs); color: var(--color-text-muted);">
                            <span>Tanggal: <strong style="color: var(--color-gray-900);">{{ $event->event_date?->format('d M Y, H:i') ?? 'Belum tersedia' }}</strong></span>
                            <span>Lokasi: <strong style="color: var(--color-gray-900);">{{ $event->location }}</strong></span>
                            <span>Kuota: <strong style="color: var(--color-gray-900);">{{ $event->quota }}</strong></span>
                            <span>Pendaftar: <strong style="color: var(--color-gray-900);">{{ $event->registrants_count }} / {{ $event->quota }}</strong></span>
                        </div>

                        <div style="margin-top: var(--space-4); border-top: 1px solid var(--color-border); padding-top: var(--space-4);">
                            <div class="stat-card-row" style="margin-bottom: var(--space-3);">
                                <div>
                                    <div class="stat-label">Peserta Terdaftar</div>
                                    <div class="stat-note">UMKM yang sudah mendaftar pada event ini.</div>
                                </div>
                                <span class="badge badge-info">{{ $event->registrants_count }} pendaftar</span>
                            </div>

                            @if($event->registrants->isNotEmpty())
                                <div class="table-container">
                                    <table class="data-table">
                                        <thead>
                                            <tr>
                                                <th>Nama Pemilik/User</th>
                                                <th>Nama UMKM</th>
                                                <th>Email</th>
                                                <th>Tanggal Daftar</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($event->registrants as $registrant)
                                                <tr>
                                                    <td style="font-weight: 700; color: var(--color-gray-900);">{{ $registrant->name }}</td>
                                                    <td>{{ $registrant->umkmProfile?->business_name ?? 'Belum tersedia' }}</td>
                                                    <td>{{ $registrant->email }}</td>
                                                    <td>{{ $registrant->pivot?->created_at?->format('d M Y, H:i') ?? 'Belum tersedia' }}</td>
                                                    <td>
                                                        @php
                                                            $participantStatus = $registrant->pivot?->status ?? 'registered';
                                                            $participantLabel = match ($participantStatus) {
                                                                'registered' => 'Terdaftar',
                                                                'pending' => 'Menunggu Konfirmasi',
                                                                'approved' => 'Terdaftar',
                                                                'rejected' => 'Ditolak',
                                                                'completed' => 'Selesai',
                                                                'cancelled' => 'Dibatalkan',
                                                                default => ucfirst($participantStatus),
                                                            };
                                                        @endphp
                                                        <span class="badge badge-success">{{ $participantLabel }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="support-empty-state" style="padding: var(--space-5);">
                                    <h3 style="margin-top: 0;">Belum ada peserta</h3>
                                    <p>Peserta akan muncul setelah UMKM mendaftar event ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="action-group">
                        @if ($event->status === 'active')
                            <form action="{{ route('dinas.event.complete', $event) }}" method="POST" onsubmit="return confirm('Tandai event ini selesai?');" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="link-action" style="background: none; border: none; cursor: pointer; padding: 0;">Tandai Selesai</button>
                            </form>
                        @else
                            <span class="badge badge-secondary">Selesai</span>
                        @endif
                        <a href="{{ route('dinas.event.edit', $event) }}" class="link-action">Edit</a>
                        <form action="{{ route('dinas.event.destroy', $event) }}" method="POST" onsubmit="return confirm('Hapus event ini?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="font-size: var(--text-sm); color: var(--color-danger); font-weight: 700; background: none; border: none; cursor: pointer;">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada event</h3>
                    <p style="margin-bottom: var(--space-4);">Tambahkan event atau pelatihan agar UMKM dapat mendaftar.</p>
                    <a href="{{ route('dinas.event.create') }}" class="btn btn-primary">Tambah Event Pertama</a>
                </div>
            @endforelse
        </div>

        @if ($events->hasPages())
            <div style="margin-top: var(--space-4);">
                {{ $events->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
