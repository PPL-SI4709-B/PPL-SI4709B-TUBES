@extends('layouts.app')

@section('title', 'Buat Laporan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="reports" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('reports.index') }}" style="color: var(--color-text-muted); text-decoration: none;">Laporan Perkembangan</a>
        <span style="margin: 0 0.5rem;">&rsaquo;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Buat Laporan Baru</span>
    </div>
    <div class="flex items-center gap-6">
        <div style="width: 1px; height: 32px; background-color: var(--color-border);"></div>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 50rem; margin: 0 auto;">
    <div class="page-header" style="margin-bottom: 0;">
        <div>
            <div class="page-kicker">Form Laporan</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Buat Laporan Perkembangan</h1>
            <p class="page-subtitle">Lengkapi data periode, keuangan, dan perkembangan usaha untuk ditinjau Dinas.</p>
        </div>
    </div>

    <section class="form-card">
        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
            @csrf

            <div class="form-group">
                <label for="judul" class="form-label">
                    Judul Laporan <span style="color: var(--color-danger);">*</span>
                </label>
                <input id="judul" type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Laporan Perkembangan Usaha April 2026" class="form-control" style="border-color: {{ $errors->has('judul') ? 'var(--color-danger)' : 'var(--color-border)' }};">
                @error('judul')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="period" class="form-label">
                        Periode Laporan <span style="color: var(--color-danger);">*</span>
                    </label>
                    <input id="period" type="month" name="period" value="{{ old('period', date('Y-m')) }}" class="form-control" style="border-color: {{ $errors->has('period') ? 'var(--color-danger)' : 'var(--color-border)' }};">
                    @error('period')
                        <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="report_date" class="form-label">
                        Tanggal Laporan <span style="color: var(--color-danger);">*</span>
                    </label>
                    <input id="report_date" type="date" name="report_date" value="{{ old('report_date', date('Y-m-d')) }}" class="form-control" style="border-color: {{ $errors->has('report_date') ? 'var(--color-danger)' : 'var(--color-border)' }};">
                    @error('report_date')
                        <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="due_date" class="form-label">
                    Batas Waktu Laporan <span style="color: var(--color-danger);">*</span>
                </label>
                <input id="due_date" type="date" name="due_date" value="{{ old('due_date', date('Y-m-t')) }}" class="form-control" style="border-color: {{ $errors->has('due_date') ? 'var(--color-danger)' : 'var(--color-border)' }};">
                @error('due_date')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="income" class="form-label">
                        Pemasukan (Rp) <span style="color: var(--color-danger);">*</span>
                    </label>
                    <input id="income" type="number" name="income" value="{{ old('income') }}" min="0" placeholder="0" class="form-control" style="border-color: {{ $errors->has('income') ? 'var(--color-danger)' : 'var(--color-border)' }};">
                    @error('income')
                        <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="expense" class="form-label">
                        Pengeluaran (Rp) <span style="color: var(--color-danger);">*</span>
                    </label>
                    <input id="expense" type="number" name="expense" value="{{ old('expense') }}" min="0" placeholder="0" class="form-control" style="border-color: {{ $errors->has('expense') ? 'var(--color-danger)' : 'var(--color-border)' }};">
                    @error('expense')
                        <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi" class="form-label">
                    Deskripsi Perkembangan Usaha <span style="color: var(--color-danger);">*</span>
                </label>
                <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan perkembangan usaha Anda pada periode ini." class="form-control" style="resize: vertical; border-color: {{ $errors->has('deskripsi') ? 'var(--color-danger)' : 'var(--color-border)' }};">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="catatan_usaha" class="form-label">Catatan Usaha</label>
                <textarea id="catatan_usaha" name="catatan_usaha" rows="3" placeholder="Tuliskan catatan tambahan mengenai operasional, kendala, atau rencana tindak lanjut." class="form-control" style="resize: vertical; border-color: {{ $errors->has('catatan_usaha') ? 'var(--color-danger)' : 'var(--color-border)' }};">{{ old('catatan_usaha') }}</textarea>
                @error('catatan_usaha')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="lampiran" class="form-label">
                    Lampiran <span style="font-weight: 400; color: var(--color-text-muted);">(Opsional - PDF/PNG/JPG, maks 2MB)</span>
                </label>
                <input id="lampiran" type="file" name="lampiran" accept=".pdf,.png,.jpg,.jpeg" class="form-control" style="border-color: {{ $errors->has('lampiran') ? 'var(--color-danger)' : 'var(--color-border)' }};">
                @error('lampiran')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="action-group" style="padding-top: var(--space-4); border-top: 1px solid var(--color-border);">
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" id="submit-report" class="btn btn-primary">Kirim Laporan</button>
            </div>
        </form>
    </section>
</div>
@endsection
