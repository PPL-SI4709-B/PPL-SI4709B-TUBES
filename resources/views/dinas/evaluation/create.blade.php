@extends('layouts.app')

@section('title', 'Evaluasi Laporan - Portal UMKM')

@section('sidebar')
<x-dinas-sidebar active="report" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Evaluasi Laporan</div>
        <div class="page-subtitle">Berikan skor, catatan, dan status akhir laporan UMKM.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()?->name }}</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()?->name ?? 'P', 0, 1)) }}
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="support-page narrow">
    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Review Laporan</div>
            <h1>Evaluasi Laporan UMKM</h1>
            <p class="page-subtitle">Laporan {{ $report['umkm_name'] }} untuk periode {{ $report['period'] }}.</p>
        </div>
    </div>

    <section class="content-card">
        <div style="margin-bottom: var(--space-5);">
            <h2 class="section-title">Isi Laporan</h2>
            <p class="section-subtitle">Ringkasan konten laporan yang akan dievaluasi.</p>
        </div>
        <div style="background: var(--color-gray-50); border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: var(--space-5); color: var(--color-gray-900); font-size: var(--text-sm); line-height: 1.7;">
            {{ $report['report_content'] }}
        </div>
    </section>

    <section class="form-card">
        <form action="{{ route('dinas.evaluation.store', $report['id']) }}" method="POST" class="flex flex-col gap-5">
            @csrf

            <div class="form-group">
                <label class="form-label">Skor Evaluasi (1-5) <span style="color: var(--color-danger);">*</span></label>
                <div style="display: flex; gap: var(--space-3); flex-wrap: wrap;">
                    @for ($i = 1; $i <= 5; $i++)
                        <label class="list-card" style="display: inline-flex; align-items: center; gap: var(--space-2); padding: var(--space-3) var(--space-4); cursor: pointer;">
                            <input type="radio" name="score" value="{{ $i }}" {{ old('score') == $i ? 'checked' : '' }} required>
                            <span style="font-size: var(--text-sm); font-weight: 800; color: var(--color-gray-900);">{{ $i }}</span>
                        </label>
                    @endfor
                </div>
                @error('score')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="notes" class="form-label">Catatan Evaluasi <span style="color: var(--color-danger);">*</span></label>
                <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Masukkan analisis dan saran untuk UMKM..." required>{{ old('notes') }}</textarea>
                @error('notes')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status Akhir Laporan <span style="color: var(--color-danger);">*</span></label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">Pilih Status</option>
                    <option value="passed" {{ old('status') == 'passed' ? 'selected' : '' }}>Lulus Evaluasi</option>
                    <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Tidak Lulus</option>
                    <option value="revision" {{ old('status') == 'revision' ? 'selected' : '' }}>Perlu Revisi</option>
                </select>
                @error('status')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="action-group" style="padding-top: var(--space-4); border-top: 1px solid var(--color-border);">
                <a href="{{ route('dinas.report.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Evaluasi</button>
            </div>
        </form>
    </section>
</div>
@endsection
