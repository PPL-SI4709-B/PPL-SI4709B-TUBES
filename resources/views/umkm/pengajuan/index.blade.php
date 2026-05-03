@extends('layouts.app')

@section('sidebar')
<!-- The UMKM Dashboard uses the same Dark Blue sidebar, but different menu items -->
<aside class="sidebar">
    <div class="sidebar-brand flex items-center gap-3">
        <div style="background: white; border-radius: var(--radius-sm); padding: 0.25rem;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        </div>
        <div>
            <div class="brand-title" style="font-size: 1rem; line-height: 1.1;">PORTAL UMKM</div>
            <div class="brand-subtitle" style="font-size: 0.65rem; color: rgba(255,255,255,0.7);">KABUPATEN BANDUNG</div>
        </div>
    </div>
    
    <nav class="nav-menu">
        <a href="{{ route('umkm.dashboard') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
            Beranda
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Profil Usaha
        </a>
        <a href="{{ route('umkm.pengajuan.index') }}" class="nav-item active" style="background-color: rgba(255,255,255,0.1); color: white;">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></span>
            Pengajuan Program
        </a>
        <a href="{{ route('umkm.event') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Event &amp; Pelatihan
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg></span>
            Edukasi
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Laporan Perkembangan
        </a>
    </nav>
    
    <div class="sidebar-bottom">
        <a href="#" class="logout-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Pengajuan Program <span style="margin: 0 0.5rem;">&#8250;</span> <span style="color: var(--color-primary); font-weight: 700;">Riwayat & Status</span>
    </div>
    <div class="flex items-center gap-6">
        <button class="text-gray-400 hover:text-gray-600">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        </button>
        <div style="width: 1px; height: 32px; background-color: var(--color-border);"></div>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::check() ? Auth::user()->name : 'Budi Santoso' }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <img src="https://ui-avatars.com/api/?name={{ Auth::check() ? urlencode(Auth::user()->name) : 'Budi+Santoso' }}&background=ef4444&color=fff&rounded=true" alt="User" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 64rem; margin: 0 auto;">
    
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pengajuan Program</h1>
            <p class="text-gray-500 text-sm mt-1">Pantau riwayat dan status pengajuan program Anda secara mandiri.</p>
        </div>
        <button type="button" class="btn" style="background-color: var(--color-primary); color: white; display: flex; align-items: center; gap: 0.5rem;" onclick="document.getElementById('modal-pengajuan').style.display='flex'">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Ajukan Program
        </button>
    </div>

    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert" style="background-color: var(--color-success-bg); color: var(--color-success); border-left: 4px solid var(--color-success);">
            <span class="font-bold">Berhasil!</span> {{ session('success') }}
        </div>
    @endif

    <div class="card p-0 overflow-hidden">
        <div class="table-container p-6">
            <table class="table w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-bold text-gray-500 tracking-wider">
                        <th class="pb-3">TANGGAL</th>
                        <th class="pb-3">NAMA PROGRAM</th>
                        <th class="pb-3">KEBUTUHAN USAHA</th>
                        <th class="pb-3 text-right">STATUS</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($pengajuans as $pengajuan)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 text-gray-600">{{ $pengajuan->created_at->format('d M Y') }}</td>
                            <td class="py-4 font-bold text-gray-900">{{ $pengajuan->program_name }}</td>
                            <td class="py-4 text-gray-600">{{ Str::limit($pengajuan->kebutuhan_usaha, 50) }}</td>
                            <td class="py-4 text-right">
                                @if($pengajuan->status == 'pending')
                                    <span style="display:inline-flex; align-items:center; background-color: #fef3c7; color: #d97706; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 99px; letter-spacing: 0.05em; text-transform: uppercase;">
                                        Menunggu
                                    </span>
                                @elseif($pengajuan->status == 'approved')
                                    <span style="display:inline-flex; align-items:center; background-color: #d1fae5; color: #059669; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 99px; letter-spacing: 0.05em; text-transform: uppercase;">
                                        Disetujui
                                    </span>
                                @elseif($pengajuan->status == 'rejected')
                                    <span style="display:inline-flex; align-items:center; background-color: #fee2e2; color: #dc2626; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 99px; letter-spacing: 0.05em; text-transform: uppercase;">
                                        Ditolak
                                    </span>
                                @else
                                    <span style="display:inline-flex; align-items:center; background-color: #f3f4f6; color: #4b5563; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 99px; letter-spacing: 0.05em; text-transform: uppercase;">
                                        {{ $pengajuan->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div style="background-color: var(--color-bg); padding: 1rem; border-radius: 50%; color: var(--color-text-muted); margin-bottom: 1rem;">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada pengajuan</h3>
                                    <p class="text-gray-500 text-sm mb-4">Anda belum pernah mengajukan program apapun.</p>
                                    <button type="button" onclick="document.getElementById('modal-pengajuan').style.display='flex'" class="btn" style="background-color: var(--color-primary); color: white; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem;">
                                        Mulai Ajukan Sekarang
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Pengajuan (Matches PBI 13 Form) -->
<div id="modal-pengajuan" class="fixed inset-0 z-50 items-center justify-center p-4 bg-black/50 backdrop-blur-sm" style="display: none;">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Ajukan Program</h3>
            <button onclick="document.getElementById('modal-pengajuan').style.display='none'" type="button" class="text-gray-400 hover:text-gray-600">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        
        <form action="{{ route('umkm.pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Program</label>
                <input type="text" value="Pendampingan Akses Layanan Pembiayaan" disabled class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-500 cursor-not-allowed">
            </div>
            
            <div class="mb-5">
                <label for="kebutuhan_usaha" class="block text-sm font-bold text-gray-700 mb-2">Kebutuhan Usaha <span class="text-red-500">*</span></label>
                <textarea id="kebutuhan_usaha" name="kebutuhan_usaha" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Jelaskan secara singkat apa yang dibutuhkan usaha Anda..."></textarea>
            </div>
            
            <div class="mb-6">
                <label for="dokumen_pendukung" class="block text-sm font-bold text-gray-700 mb-2">Dokumen Pendukung <span class="text-xs font-normal text-gray-500">(Opsional)</span></label>
                <div class="flex items-center justify-center w-full">
                    <label for="dokumen_pendukung" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk unggah</span> atau drag file</p>
                            <p class="text-xs text-gray-500">PDF, PNG, JPG (Maks 2MB)</p>
                        </div>
                        <input id="dokumen_pendukung" name="dokumen_pendukung" type="file" class="hidden" accept=".pdf,.png,.jpg,.jpeg" />
                    </label>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="document.getElementById('modal-pengajuan').style.display='none'" class="px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 text-sm font-medium text-white rounded-lg hover:opacity-90" style="background-color: var(--color-primary);">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
