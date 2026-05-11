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
            <h1 class="text-2xl font-bold text-gray-900">Pengajuan Program</h1>
            <p class="text-gray-500 text-sm mt-1">Ajukan pendanaan atau pembinaan, dan pantau statusnya.</p>
        </div>
        @if($programs->isNotEmpty() && Auth::user()->profile_status === 'verified')
            <div class="flex gap-2">
                <button type="button" onclick="openModal('pendanaan')"
                    style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #16a34a; color: white; border: none; border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 600; cursor: pointer;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Pendanaan
                </button>
                <button type="button" onclick="openModal('pembinaan')"
                    style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: var(--color-primary); color: white; border: none; border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 600; cursor: pointer;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Pembinaan
                </button>
            </div>
        @endif
    </div>

    @if(Auth::user()->profile_status !== 'verified')
        <div style="background-color: #fefce8; border-left: 4px solid #f59e0b; padding: 1rem 1.25rem; border-radius: var(--radius-md); font-size: var(--text-sm); color: #92400e;">
            <strong>Akun belum diverifikasi.</strong> Anda belum dapat mengajukan program. Tunggu petugas dinas memverifikasi akun Anda.
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
                        <th class="pb-3">JENIS</th>
                        <th class="pb-3">NAMA PROGRAM</th>
                        <th class="pb-3">KEBUTUHAN USAHA</th>
                        <th class="pb-3 text-right">STATUS</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($pengajuans as $pengajuan)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 text-gray-600">{{ $pengajuan->created_at->format('d M Y') }}</td>
                            <td class="py-4">
                                @if($pengajuan->jenis === 'pendanaan')
                                    <span style="display:inline-flex; align-items:center; background-color: #dcfce7; color: #16a34a; font-size: 0.65rem; font-weight: 700; padding: 0.2rem 0.6rem; border-radius: 99px; text-transform: uppercase;">Pendanaan</span>
                                @else
                                    <span style="display:inline-flex; align-items:center; background-color: #dbeafe; color: #1d4ed8; font-size: 0.65rem; font-weight: 700; padding: 0.2rem 0.6rem; border-radius: 99px; text-transform: uppercase;">Pembinaan</span>
                                @endif
                            </td>
                            <td class="py-4 font-bold text-gray-900">{{ $pengajuan->program?->name ?? '-' }}</td>
                            <td class="py-4 text-gray-600">{{ Str::limit($pengajuan->kebutuhan_usaha, 40) }}</td>
                            <td class="py-4 text-right">
                                @php
                                    $colors = match($pengajuan->status) {
                                        'approved' => ['bg' => '#d1fae5', 'text' => '#059669'],
                                        'rejected' => ['bg' => '#fee2e2', 'text' => '#dc2626'],
                                        default    => ['bg' => '#fef3c7', 'text' => '#d97706'],
                                    };
                                    $label = match($pengajuan->status) {
                                        'approved' => 'Disetujui',
                                        'rejected' => 'Ditolak',
                                        default    => 'Menunggu',
                                    };
                                @endphp
                                <span style="display:inline-flex; align-items:center; background-color: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 99px; text-transform: uppercase;">
                                    {{ $label }}
                                </span>
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
                                    <p class="text-gray-500 text-sm mb-4">Anda belum pernah mengajukan program apapun.</p>
                                    @if($programs->isNotEmpty() && Auth::user()->profile_status === 'verified')
                                        <div class="flex gap-2">
                                            <button type="button" onclick="openModal('pendanaan')"
                                                style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem; background-color: #16a34a; color: white; border: none; border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 600; cursor: pointer;">
                                                Ajukan Pendanaan
                                            </button>
                                            <button type="button" onclick="openModal('pembinaan')"
                                                style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem; background-color: var(--color-primary); color: white; border: none; border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 600; cursor: pointer;">
                                                Ajukan Pembinaan
                                            </button>
                                        </div>
                                    @elseif($programs->isEmpty())
                                        <p class="text-gray-400 text-xs">Belum ada program aktif saat ini.</p>
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

{{-- Modal Pengajuan --}}
<div id="modal-pengajuan" class="fixed inset-0 z-50 items-center justify-center p-4 bg-black/50 backdrop-blur-sm" style="display: none;">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg overflow-hidden">

        {{-- Tab Header --}}
        <div style="display: flex; border-bottom: 1px solid #e5e7eb;">
            <button id="tab-pendanaan" type="button" onclick="switchTab('pendanaan')"
                style="flex: 1; padding: 1rem; font-size: 0.875rem; font-weight: 700; border: none; cursor: pointer; border-bottom: 3px solid transparent; transition: all 0.2s;">
                💰 Pendanaan
            </button>
            <button id="tab-pembinaan" type="button" onclick="switchTab('pembinaan')"
                style="flex: 1; padding: 1rem; font-size: 0.875rem; font-weight: 700; border: none; cursor: pointer; border-bottom: 3px solid transparent; transition: all 0.2s;">
                📚 Pembinaan
            </button>
            <button onclick="closeModal()" type="button"
                style="padding: 1rem; border: none; background: none; cursor: pointer; color: #9ca3af;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form action="{{ route('umkm.pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            {{-- Program dropdown -- filtered by JS --}}
            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Program <span class="text-red-500">*</span></label>
                <select id="program_id" name="program_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Program --</option>
                    @foreach($programsPendanaan as $program)
                        <option value="{{ $program->id }}" data-jenis="pendanaan" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                    @endforeach
                    @foreach($programsPembinaan as $program)
                        <option value="{{ $program->id }}" data-jenis="pembinaan" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                    @endforeach
                </select>
                <p id="no-program-msg" style="display:none; font-size: 0.75rem; color: #6b7280; margin-top: 4px;">Tidak ada program aktif untuk jenis ini.</p>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Kebutuhan Usaha <span class="text-red-500">*</span></label>
                <textarea id="kebutuhan_usaha" name="kebutuhan_usaha" rows="4" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    id="kebutuhan-placeholder">{{ old('kebutuhan_usaha') }}</textarea>
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
                <button type="submit" id="btn-submit" class="px-5 py-2 text-sm font-medium text-white rounded-lg hover:opacity-90" style="background-color: var(--color-primary);">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let activeTab = 'pendanaan';

function openModal(jenis) {
    document.getElementById('modal-pengajuan').style.display = 'flex';
    switchTab(jenis);
}

function closeModal() {
    document.getElementById('modal-pengajuan').style.display = 'none';
}

function switchTab(jenis) {
    activeTab = jenis;

    const tabPendanaan = document.getElementById('tab-pendanaan');
    const tabPembinaan = document.getElementById('tab-pembinaan');
    const btnSubmit    = document.getElementById('btn-submit');
    const select       = document.getElementById('program_id');
    const noMsg        = document.getElementById('no-program-msg');

    // Reset tabs
    tabPendanaan.style.borderBottomColor = 'transparent';
    tabPendanaan.style.color = '#6b7280';
    tabPendanaan.style.backgroundColor = 'white';
    tabPembinaan.style.borderBottomColor = 'transparent';
    tabPembinaan.style.color = '#6b7280';
    tabPembinaan.style.backgroundColor = 'white';

    if (jenis === 'pendanaan') {
        tabPendanaan.style.borderBottomColor = '#16a34a';
        tabPendanaan.style.color = '#16a34a';
        tabPendanaan.style.backgroundColor = '#f0fdf4';
        btnSubmit.style.backgroundColor = '#16a34a';
    } else {
        tabPembinaan.style.borderBottomColor = 'var(--color-primary)';
        tabPembinaan.style.color = 'var(--color-primary)';
        tabPembinaan.style.backgroundColor = '#eff6ff';
        btnSubmit.style.backgroundColor = 'var(--color-primary)';
    }

    // Filter dropdown options
    const options = select.querySelectorAll('option[data-jenis]');
    let hasOption = false;
    select.value = '';

    options.forEach(opt => {
        if (opt.dataset.jenis === jenis) {
            opt.style.display = '';
            hasOption = true;
        } else {
            opt.style.display = 'none';
        }
    });

    noMsg.style.display = hasOption ? 'none' : 'block';
}

// Init on page load if modal was open due to validation error
document.addEventListener('DOMContentLoaded', function () {
    @if(old('program_id'))
        document.getElementById('modal-pengajuan').style.display = 'flex';
        @php
            $oldProgram = $programs->find(old('program_id'));
        @endphp
        @if($oldProgram)
            switchTab('{{ $oldProgram->jenis }}');
        @else
            switchTab('pendanaan');
        @endif
    @else
        switchTab('pendanaan');
    @endif
});
</script>
@endsection
