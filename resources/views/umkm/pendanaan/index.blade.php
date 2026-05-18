@extends('layouts.app')

@section('title', 'Pengajuan Pendanaan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="pendanaan" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Pengajuan Pendanaan <span style="margin: 0 0.5rem;">&#8250;</span> <span style="color: var(--color-primary); font-weight: 700;">Riwayat & Status</span>
    </div>
    <div class="flex items-center gap-6">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 64rem; margin: 0 auto;">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900" style="font-size: 1.5rem;">Pengajuan Pendanaan UMKM</h1>
            <p class="text-gray-500 text-sm mt-1">Ajukan permohonan pendanaan usaha dan pantau statusnya.</p>
        </div>
        @if(Auth::user()->profile_status === 'verified')
            <a href="{{ route('umkm.pendanaan.create') }}"
                style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #16a34a; color: white; border: none; border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 600; cursor: pointer; text-decoration: none;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Ajukan Pendanaan
            </a>
        @endif
    </div>

    @if(Auth::user()->profile_status !== 'verified')
        <div style="background-color: #fefce8; border-left: 4px solid #f59e0b; padding: 1rem 1.25rem; border-radius: var(--radius-md); font-size: var(--text-sm); color: #92400e; display: flex; justify-content: space-between; align-items: center;">
            <span><strong>Akun belum diverifikasi.</strong> Anda belum dapat mengajukan pendanaan. Pastikan profil usaha sudah lengkap.</span>
            <a href="{{ route('umkm.profile.show') }}" style="font-weight: 600; text-decoration: underline; white-space: nowrap; margin-left: 1rem;">Cek Profil →</a>
        </div>
    @endif

    @if(session('success'))
        <div style="background-color: var(--color-success-bg); color: var(--color-success); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500; border-left: 4px solid var(--color-success);">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #fef2f2; color: var(--color-danger); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); border-left: 4px solid var(--color-danger);">
            {{ session('error') }}
        </div>
    @endif

    <div class="card p-0 overflow-hidden">
        <div class="table-container p-6">
            <table class="table w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-bold text-gray-500 tracking-wider">
                        <th class="pb-3">TANGGAL</th>
                        <th class="pb-3">SUMBER PENDANAAN</th>
                        <th class="pb-3 text-right">JUMLAH</th>
                        <th class="pb-3">TUJUAN</th>
                        <th class="pb-3 text-center">STATUS</th>
                        <th class="pb-3 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($pengajuans as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 text-gray-600">{{ $item->submitted_at ? $item->submitted_at->format('d M Y') : $item->created_at->format('d M Y') }}</td>
                            <td class="py-4 font-bold text-gray-900">{{ $item->sumberPendanaan->nama_program ?? '-' }}</td>
                            <td class="py-4 text-gray-900 text-right" style="white-space: nowrap;">Rp {{ number_format($item->jumlah_pengajuan, 0, ',', '.') }}</td>
                            <td class="py-4 text-gray-600">{{ Str::limit($item->tujuan_pendanaan, 30) }}</td>
                            <td class="py-4 text-center">
                                <x-pendanaan-status-badge :status="$item->status" />
                            </td>
                            <td class="py-4 text-center">
                                <a href="{{ route('umkm.pendanaan.show', $item) }}" style="color: var(--color-secondary, var(--color-primary)); font-weight: 600; font-size: var(--text-sm);">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div style="background-color: var(--color-bg, #f1f5f9); padding: 1rem; border-radius: 50%; color: var(--color-text-muted); margin-bottom: 1rem;">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1v22"></path><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada pengajuan pendanaan</h3>
                                    <p class="text-gray-500 text-sm mb-4">Anda belum pernah mengajukan permohonan pendanaan usaha.</p>
                                    @if(Auth::user()->profile_status === 'verified')
                                        <a href="{{ route('umkm.pendanaan.create') }}"
                                            style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem; background-color: #16a34a; color: white; border: none; border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 600; cursor: pointer; text-decoration: none;">
                                            Ajukan Pendanaan
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
