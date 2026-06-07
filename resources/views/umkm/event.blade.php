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
<div class="flex flex-col gap-6" style="max-width: 72rem; margin: 0 auto;">

    @if(session('success'))
    <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #bbf7d0; font-weight: 600;">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #fecaca; font-weight: 600;">
        {{ session('error') }}
    </div>
    @endif

    <div>
        <h1 class="text-2xl font-bold text-gray-900">Event &amp; Pelatihan</h1>
        <p class="text-gray-500 text-sm mt-1">Program pelatihan dan bootcamp yang diselenggarakan oleh Dinas untuk pelaku UMKM.</p>
    </div>

    {{-- PBI-11: search & filter --}}
    <form method="GET" action="{{ route('umkm.event') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama event..."
            style="flex: 1; min-width: 12rem; padding: 0.5rem 0.875rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.875rem;">
        <select name="type" style="padding: 0.5rem 0.875rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: 0.875rem; background: white;">
            <option value="">Semua Jenis</option>
            @foreach($types as $t)
                <option value="{{ $t }}" {{ ($type ?? '') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary" style="font-size: 0.875rem;">Cari</button>
        @if(!empty($search) || !empty($type))
            <a href="{{ route('umkm.event') }}" style="font-size: 0.8rem; color: var(--color-text-muted);">Reset</a>
        @endif
    </form>

    @forelse ($events as $event)
        @php
            $typeColors = match(strtolower($event->type)) {
                'bootcamp'  => ['bg' => '#fef3c7', 'text' => '#92400e'],
                'pelatihan' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                'seminar'   => ['bg' => '#f3e8ff', 'text' => '#6b21a8'],
                'workshop'  => ['bg' => '#dcfce7', 'text' => '#166534'],
                default     => ['bg' => '#f1f5f9', 'text' => '#475569'],
            };
        @endphp
        @if($loop->first)
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem;">
        @endif

            <div style="background: white; border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden; display: flex; flex-direction: column; transition: box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.boxShadow='none'">

                {{-- Type banner --}}
                <div style="background: linear-gradient(135deg, var(--color-brand) 0%, #1e40af 100%); padding: 1.25rem 1.25rem 1rem; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,0.06);"></div>
                    <div style="position: absolute; bottom: -30px; right: 10px; width: 60px; height: 60px; border-radius: 50%; background: rgba(255,255,255,0.04);"></div>
                    <span style="display: inline-block; background-color: {{ $typeColors['bg'] }}; color: {{ $typeColors['text'] }}; font-size: 0.65rem; font-weight: 700; padding: 0.2rem 0.6rem; border-radius: 99px; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">
                        {{ ucfirst($event->type) }}
                    </span>
                    <h3 style="font-size: 0.95rem; font-weight: 700; color: white; margin: 0; line-height: 1.3;">{{ $event->title }}</h3>
                </div>

                {{-- Card body --}}
                <div style="padding: 1rem 1.25rem; flex: 1; display: flex; flex-direction: column; gap: 0.6rem;">

                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; color: #4b5563;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0; color: #9ca3af;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        {{ $event->event_date->format('d M Y, H:i') }}
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; color: #4b5563;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0; color: #9ca3af;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        {{ $event->location }}
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; color: #4b5563;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0; color: #9ca3af;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        Kuota: <strong>{{ $event->quota }} peserta</strong>
                    </div>

                    @if($event->description)
                        <p style="font-size: 0.78rem; color: #6b7280; margin: 0.25rem 0 0; line-height: 1.5; flex: 1;">
                            {{ Str::limit($event->description, 90) }}
                        </p>
                    @endif

                </div>

                {{-- Card footer: kuota + register (PBI-29) + detail --}}
                @php
                    $registeredCount = $event->registrants()->count();
                    $isFull = $registeredCount >= $event->quota;
                    $isRegistered = in_array($event->id, $registeredEventIds ?? []);
                @endphp
                <div style="padding: 0.75rem 1.25rem; border-top: 1px solid #f3f4f6; display: flex; flex-direction: column; gap: 0.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.7rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                        <span>Kuota</span>
                        @if($isFull)
                            <span style="color: #dc2626;">Penuh</span>
                        @else
                            <span style="color: #111827;">{{ $registeredCount }} / {{ $event->quota }} peserta</span>
                        @endif
                    </div>

                    @if($isRegistered)
                        <button type="button" disabled
                            style="width: 100%; padding: 0.5rem; background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; border-radius: 6px; font-size: 0.8rem; font-weight: 600; cursor: default;">Sudah Terdaftar</button>
                    @elseif($isFull)
                        <button type="button" disabled
                            style="width: 100%; padding: 0.5rem; background-color: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 0.8rem; font-weight: 600; cursor: not-allowed;">Penuh</button>
                    @else
                        <form action="{{ route('umkm.event.register', $event->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit"
                                style="width: 100%; padding: 0.5rem; background-color: var(--color-brand); color: white; border: none; border-radius: 6px; font-size: 0.8rem; font-weight: 600; cursor: pointer;">Daftar Sekarang</button>
                        </form>
                    @endif

                    <a href="{{ route('umkm.event.show', $event) }}"
                        style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; width: 100%; padding: 0.5rem; color: var(--color-brand); border: 1px solid var(--color-brand); border-radius: 6px; font-size: 0.8rem; font-weight: 600; text-decoration: none;">
                        Lihat Detail
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

        @if($loop->last)
        </div>
        @endif
    @empty
        <div class="card" style="padding: 4rem; text-align: center;">
            <div style="color: #d1d5db; margin-bottom: 1rem;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display: inline-block;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </div>
            <div style="font-size: 1rem; font-weight: 600; color: #111827; margin-bottom: 0.25rem;">Belum ada event tersedia</div>
            <div style="font-size: 0.875rem; color: #6b7280;">Pantau halaman ini untuk event dan pelatihan terbaru dari Dinas.</div>
        </div>
    @endforelse
</div>
@endsection
