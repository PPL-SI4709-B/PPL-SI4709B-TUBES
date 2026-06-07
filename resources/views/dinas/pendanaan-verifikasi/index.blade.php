@extends('layouts.app')

@section('title', 'Verifikasi Pengajuan Pendanaan')

@section('sidebar')
<x-dinas-sidebar active="pendanaan-verifikasi" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Verifikasi Pengajuan Pendanaan</div>
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
        <div style="background-color: var(--color-success-bg); color: var(--color-success); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background-color: #fef2f2; color: var(--color-danger); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500;">
            {{ session('error') }}
        </div>
    @endif

    <div class="card" style="padding: var(--space-6);">
        <div class="flex justify-between items-center mb-6">
            <div>
                <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900);">Daftar Pengajuan Pendanaan</div>
                <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 2px;">Verifikasi pengajuan pendanaan UMKM dan pemberian keputusan administratif.</div>
            </div>
            <form method="GET" action="{{ route('dinas.pendanaan-verifikasi.index') }}" class="flex items-center gap-2">
                <label for="status" style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 600;">Status</label>
                <select id="status" name="status" onchange="this.form.submit()" style="padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm); background: white;">
                    <option value="">Semua Status</option>
                    @foreach ($allowedStatuses as $status)
                        <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-bottom: var(--space-4);">
            {{ $pengajuans->total() }} pengajuan ditemukan
        </div>

        <div class="table-container">
            <table class="table w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-bold text-gray-500 tracking-wider">
                        <th class="pb-3">TANGGAL</th>
                        <th class="pb-3">PEMOHON</th>
                        <th class="pb-3">USAHA</th>
                        <th class="pb-3">SUMBER PENDANAAN</th>
                        <th class="pb-3 text-right">JUMLAH</th>
                        <th class="pb-3 text-center">STATUS</th>
                        <th class="pb-3 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse ($pengajuans as $pengajuan)
                        @php
                            $profile = $pengajuan->user?->umkmProfile;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 text-gray-600" style="white-space: nowrap;">{{ ($pengajuan->submitted_at ?? $pengajuan->created_at)->format('d M Y') }}</td>
                            <td class="py-4">
                                <div style="font-weight: 600; color: var(--color-gray-900);">{{ $pengajuan->user?->name ?? '-' }}</div>
                                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $pengajuan->user?->email ?? '-' }}</div>
                            </td>
                            <td class="py-4 text-gray-600">{{ $profile?->business_name ?? '-' }}</td>
                            <td class="py-4 text-gray-600">{{ $pengajuan->sumberPendanaan?->nama_program ?? '-' }}</td>
                            <td class="py-4 text-gray-900 text-right" style="white-space: nowrap;">Rp {{ number_format($pengajuan->jumlah_pengajuan, 0, ',', '.') }}</td>
                            <td class="py-4 text-center">
                                <x-pendanaan-status-badge :status="$pengajuan->status" />
                            </td>
                            <td class="py-4 text-center">
                                <a href="{{ route('dinas.pendanaan-verifikasi.show', $pengajuan) }}" style="color: var(--color-secondary); font-weight: 600; font-size: var(--text-sm);">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center">
                                <div style="font-size: var(--text-sm); color: var(--color-text-muted);">Belum ada pengajuan pendanaan.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pengajuans->hasPages())
            <div class="mt-4">
                {{ $pengajuans->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
