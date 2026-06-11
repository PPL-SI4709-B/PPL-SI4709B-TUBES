@extends('layouts.app')

@section('title', 'Feedback Event - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="event-history" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.event.history') }}" style="color: var(--color-text-muted); text-decoration: none;">Riwayat Event</a>
        <span style="margin: 0 0.5rem;">&rsaquo;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Feedback</span>
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
<div class="flex flex-col gap-6" style="max-width: 46rem; margin: 0 auto;">
    <div class="page-header" style="margin-bottom: 0;">
        <div>
            <div class="page-kicker">Feedback Event</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">{{ $event->name ?? $event->title ?? 'Event' }}</h1>
            <p class="page-subtitle">Berikan ulasan Anda terhadap event atau pelatihan yang telah diikuti.</p>
        </div>
    </div>

    <section class="form-card">
        <form action="{{ route('umkm.event-feedback.store', $event->id) }}" method="POST" class="flex flex-col gap-5">
            @csrf

            <div class="form-group">
                <label for="rating" class="form-label">Rating (1 - 5) <span style="color: var(--color-danger);">*</span></label>
                <select id="rating" name="rating" class="form-control" required>
                    <option value="">Pilih Rating</option>
                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 - Baik</option>
                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 - Cukup</option>
                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 - Buruk</option>
                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 - Sangat Buruk</option>
                </select>
                @error('rating')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="feedback" class="form-label">Ulasan / Feedback</label>
                <textarea id="feedback" name="feedback" rows="4" class="form-control" style="resize: vertical;" placeholder="Tuliskan pengalaman atau saran Anda untuk event ini.">{{ old('feedback') }}</textarea>
                @error('feedback')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="action-group" style="padding-top: var(--space-4); border-top: 1px solid var(--color-border);">
                <a href="{{ route('umkm.event.history') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Kirim Feedback</button>
            </div>
        </form>
    </section>
</div>
@endsection
