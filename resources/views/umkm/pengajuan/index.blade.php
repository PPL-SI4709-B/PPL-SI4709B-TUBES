@extends('layouts.app')

@section('sidebar')
<x-umkm-sidebar active="pengajuan" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Pengajuan Program <span style="margin: 0 0.5rem;">&#8250;</span> <span style="color: var(--color-primary); font-weight: 700;">Riwayat & Status</span>
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
            <h1 class="text-2xl font-bold text-gray-900">Pengajuan Pendanaan</h1>
            <p class="text-gray-500 text-sm mt-1">Ajukan program pendanaan dan pantau statusnya.</p>
        </div>
        @if($programsPendanaan->isNotEmpty() && Auth::user()->profile_status === 'verified')
            <button type="button" onclick="openModal()"
                style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #16a34a; color: white; border: none; border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 600; cursor: pointer;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Ajukan Pendanaan
            </button>
        @endif
    </div>

    @if(Auth::user()->profile_status !== 'verified')
        <div style="background-color: #fefce8; border-left: 4px solid #f59e0b; padding: 1rem 1.25rem; border-radius: var(--radius-md); font-size: var(--text-sm); color: #92400e; display: flex; justify-content: space-between; align-items: center;">
            <span><strong>Akun belum diverifikasi.</strong> Anda belum dapat mengajukan program. Pastikan profil usaha sudah lengkap.</span>
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

    @if($errors->any())
        <div style="background-color: #fef2f2; color: var(--color-danger); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); border-left: 4px solid var(--color-danger);">
            <ul style="margin: 0; padding-left: 1rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                        <th class="pb-3">CATATAN DINAS</th>
                        <th class="pb-3 text-right">STATUS & RIWAYAT</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($pengajuans as $pengajuan)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 text-gray-600">{{ $pengajuan->created_at->format('d M Y') }}</td>
                            <td class="py-4 font-bold text-gray-900">{{ $pengajuan->program?->name ?? '-' }}</td>
                            <td class="py-4 text-gray-600">{{ Str::limit($pengajuan->kebutuhan_usaha, 40) }}</td>
                            <td class="py-4 text-gray-600" style="max-width: 16rem;">
                                @if($pengajuan->notes)
                                    {{ $pengajuan->notes }}
                                @else
                                    <span class="text-xs text-gray-400 italic">Belum ada catatan</span>
                                @endif
                            </td>
                            <td class="py-4 text-right">
                                <x-status-badge :status="$pengajuan->status" />
                                {{-- PBI-20: timeline status --}}
                                <div style="margin-top: 0.5rem; font-size: 0.7rem; color: #6b7280; line-height: 1.5;">
                                    <div>● Diajukan — {{ $pengajuan->created_at->format('d M Y') }}</div>
                                    @if($pengajuan->reviewed_at)
                                        <div>● {{ $pengajuan->status === 'approved' ? 'Disetujui' : 'Ditolak' }} — {{ $pengajuan->reviewed_at->format('d M Y') }}</div>
                                    @else
                                        <div style="color: #9ca3af;">○ Menunggu peninjauan</div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div style="background-color: var(--color-bg); padding: 1rem; border-radius: 50%; color: var(--color-text-muted); margin-bottom: 1rem;">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada pengajuan</h3>
                                    <p class="text-gray-500 text-sm mb-4">Anda belum pernah mengajukan program pendanaan.</p>
                                    @if($programsPendanaan->isNotEmpty() && Auth::user()->profile_status === 'verified')
                                        <button type="button" onclick="openModal()"
                                            style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem; background-color: #16a34a; color: white; border: none; border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 600; cursor: pointer;">
                                            Ajukan Pendanaan
                                        </button>
                                    @elseif($programsPendanaan->isEmpty())
                                        <p class="text-gray-400 text-xs">Belum ada program pendanaan aktif saat ini.</p>
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

{{-- Modal Pengajuan Pendanaan --}}
<div id="modal-pengajuan" class="fixed inset-0 z-50 items-center justify-center p-4 bg-black/50 backdrop-blur-sm" style="display: none;">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg overflow-hidden">

        <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb;">
            <div>
                <h2 style="font-size: 1rem; font-weight: 700; color: #111827; margin: 0;">Ajukan Pendanaan</h2>
                <p style="font-size: 0.75rem; color: #6b7280; margin: 2px 0 0;">Pilih program dan jelaskan kebutuhan usaha Anda.</p>
            </div>
            <button onclick="closeModal()" type="button"
                style="padding: 0.4rem; border: none; background: none; cursor: pointer; color: #9ca3af;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form action="{{ route('umkm.pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <input type="hidden" name="jenis" value="pendanaan">

            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Program <span class="text-red-500">*</span></label>
                <select name="program_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Program Pendanaan --</option>
                    @foreach($programsPendanaan as $program)
                        <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Kebutuhan Usaha <span class="text-red-500">*</span></label>
                <textarea name="kebutuhan_usaha" rows="4" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Jelaskan kebutuhan dan tujuan pendanaan Anda...">{{ old('kebutuhan_usaha') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Dokumen Pendukung <span class="text-xs font-normal text-gray-500">(Opsional)</span></label>
                <label for="dokumen_pendukung" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <div class="flex flex-col items-center justify-center pt-3 pb-4">
                        <svg class="w-6 h-6 mb-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                        <p class="text-xs text-gray-500"><span class="font-semibold">Klik untuk unggah</span> — PDF, PNG, JPG (Maks 2MB)</p>
                    </div>
                    <input id="dokumen_pendukung" name="dokumen_pendukung" type="file" class="hidden" accept=".pdf,.png,.jpg,.jpeg" />
                </label>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="closeModal()" class="px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 text-sm font-medium text-white rounded-lg hover:opacity-90" style="background-color: #16a34a;">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modal-pengajuan').style.display = 'flex';
}

function closeModal() {
    document.getElementById('modal-pengajuan').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    @if(old('program_id'))
        document.getElementById('modal-pengajuan').style.display = 'flex';
    @endif
});
</script>
@endsection
