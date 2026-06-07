@extends('layouts.app')

@section('title', 'Master Data - Portal UMKM')

@section('sidebar')
<x-dinas-sidebar active="master-data" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Master Data
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-bold" style="font-size: var(--text-xl); color: var(--color-text-dark);">Master Data</h1>
            <p class="text-sm text-muted mt-1">Kelola referensi data: Kategori Usaha, Wilayah, dan Skala Usaha.</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background-color: var(--color-status-approve-bg); color: var(--color-status-approve-text); padding: var(--space-3) var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 600; display: flex; align-items: center; gap: var(--space-2);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabs --}}
    <div style="border-bottom: 2px solid var(--color-border); display: flex; gap: 0;">
        @foreach([['key' => 'category', 'label' => 'Kategori Usaha', 'count' => $categories->count()], ['key' => 'region', 'label' => 'Wilayah', 'count' => $regions->count()], ['key' => 'scale', 'label' => 'Skala Usaha', 'count' => $scales->count()]] as $tab)
        <button onclick="switchTab('{{ $tab['key'] }}')" id="tab-{{ $tab['key'] }}"
            style="padding: 0.75rem 1.25rem; font-size: 0.875rem; font-weight: 600; border: none; background: none; cursor: pointer; border-bottom: 2px solid transparent; margin-bottom: -2px; transition: all 0.15s; color: var(--color-text-muted);">
            {{ $tab['label'] }}
            <span id="badge-{{ $tab['key'] }}" style="display: inline-block; background-color: var(--color-input-bg); color: var(--color-text-muted); font-size: 0.7rem; font-weight: 700; padding: 0.1rem 0.45rem; border-radius: 99px; margin-left: 0.35rem;">{{ $tab['count'] }}</span>
        </button>
        @endforeach
    </div>

    {{-- Category Panel --}}
    <div id="panel-category">
        <div class="flex justify-between items-center mb-4">
            <p class="text-sm text-muted">Klasifikasi standar untuk data UMKM.</p>
            <a href="{{ route('dinas.category.create') }}" class="btn btn-brand" style="font-size: 0.8rem; padding: 0.45rem 1rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Kategori
            </a>
        </div>
        @include('dinas.master-data._table', ['items' => $categories, 'type' => 'category', 'editRoute' => 'dinas.category.edit', 'deleteRoute' => 'dinas.category.destroy', 'deleteConfirm' => 'Yakin ingin menghapus kategori ini?'])
    </div>

    {{-- Region Panel --}}
    <div id="panel-region" style="display: none;">
        <div class="flex justify-between items-center mb-4">
            <p class="text-sm text-muted">Data wilayah untuk profil UMKM.</p>
            <a href="{{ route('dinas.region.create') }}" class="btn btn-brand" style="font-size: 0.8rem; padding: 0.45rem 1rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Wilayah
            </a>
        </div>
        @include('dinas.master-data._table', ['items' => $regions, 'type' => 'region', 'editRoute' => 'dinas.region.edit', 'deleteRoute' => 'dinas.region.destroy', 'deleteConfirm' => 'Yakin ingin menghapus wilayah ini?'])
    </div>

    {{-- Scale Panel --}}
    <div id="panel-scale" style="display: none;">
        <div class="flex justify-between items-center mb-4">
            <p class="text-sm text-muted">Klasifikasi skala usaha UMKM.</p>
            <a href="{{ route('dinas.scale.create') }}" class="btn btn-brand" style="font-size: 0.8rem; padding: 0.45rem 1rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Skala
            </a>
        </div>
        @include('dinas.master-data._table', ['items' => $scales, 'type' => 'scale', 'editRoute' => 'dinas.scale.edit', 'deleteRoute' => 'dinas.scale.destroy', 'deleteConfirm' => 'Yakin ingin menghapus skala usaha ini?'])
    </div>

</div>

<script>
const tabs = ['category', 'region', 'scale'];

function switchTab(active) {
    tabs.forEach(key => {
        const tab   = document.getElementById('tab-' + key);
        const panel = document.getElementById('panel-' + key);
        const badge = document.getElementById('badge-' + key);

        if (key === active) {
            panel.style.display = '';
            tab.style.borderBottomColor = 'var(--color-primary)';
            tab.style.color = 'var(--color-primary)';
            badge.style.backgroundColor = 'var(--color-primary)';
            badge.style.color = 'white';
        } else {
            panel.style.display = 'none';
            tab.style.borderBottomColor = 'transparent';
            tab.style.color = 'var(--color-text-muted)';
            badge.style.backgroundColor = 'var(--color-input-bg)';
            badge.style.color = 'var(--color-text-muted)';
        }
    });
}

document.addEventListener('DOMContentLoaded', () => switchTab('category'));
</script>
@endsection
