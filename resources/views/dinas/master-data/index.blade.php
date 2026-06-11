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
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">
    <div class="page-header">
        <div>
            <div class="page-kicker">Referensi UMKM</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Master Data</h1>
            <p class="page-subtitle">Kelola referensi kategori usaha, wilayah, dan skala usaha untuk profil UMKM.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="content-card">
        <div style="border-bottom: 1px solid var(--color-border); display: flex; gap: var(--space-2); flex-wrap: wrap; margin: calc(var(--space-6) * -1) calc(var(--space-6) * -1) var(--space-5); padding: var(--space-4) var(--space-6) 0;">
            @foreach([['key' => 'category', 'label' => 'Kategori Usaha', 'count' => $categories->count()], ['key' => 'region', 'label' => 'Wilayah', 'count' => $regions->count()], ['key' => 'scale', 'label' => 'Skala Usaha', 'count' => $scales->count()]] as $tab)
                <button onclick="switchTab('{{ $tab['key'] }}')" id="tab-{{ $tab['key'] }}"
                    style="padding: 0.75rem 1rem; font-size: var(--text-sm); font-weight: 800; border: none; background: none; cursor: pointer; border-bottom: 3px solid transparent; margin-bottom: -1px; transition: all 0.15s; color: var(--color-text-muted);">
                    {{ $tab['label'] }}
                    <span id="badge-{{ $tab['key'] }}" class="badge badge-secondary" style="margin-left: var(--space-1);">{{ $tab['count'] }}</span>
                </button>
            @endforeach
        </div>

        <div id="panel-category">
            <div class="page-header" style="margin-bottom: var(--space-4);">
                <div>
                    <h2 class="section-title">Kategori Usaha</h2>
                    <p class="section-subtitle">Klasifikasi standar untuk data UMKM.</p>
                </div>
                <a href="{{ route('dinas.category.create') }}" class="btn btn-primary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Tambah Kategori
                </a>
            </div>
            @include('dinas.master-data._table', ['items' => $categories, 'type' => 'category', 'editRoute' => 'dinas.category.edit', 'deleteRoute' => 'dinas.category.destroy', 'deleteConfirm' => 'Yakin ingin menghapus kategori ini?'])
        </div>

        <div id="panel-region" style="display: none;">
            <div class="page-header" style="margin-bottom: var(--space-4);">
                <div>
                    <h2 class="section-title">Wilayah</h2>
                    <p class="section-subtitle">Data wilayah untuk profil UMKM.</p>
                </div>
                <a href="{{ route('dinas.region.create') }}" class="btn btn-primary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Tambah Wilayah
                </a>
            </div>
            @include('dinas.master-data._table', ['items' => $regions, 'type' => 'region', 'editRoute' => 'dinas.region.edit', 'deleteRoute' => 'dinas.region.destroy', 'deleteConfirm' => 'Yakin ingin menghapus wilayah ini?'])
        </div>

        <div id="panel-scale" style="display: none;">
            <div class="page-header" style="margin-bottom: var(--space-4);">
                <div>
                    <h2 class="section-title">Skala Usaha</h2>
                    <p class="section-subtitle">Klasifikasi skala usaha UMKM.</p>
                </div>
                <a href="{{ route('dinas.scale.create') }}" class="btn btn-primary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Tambah Skala
                </a>
            </div>
            @include('dinas.master-data._table', ['items' => $scales, 'type' => 'scale', 'editRoute' => 'dinas.scale.edit', 'deleteRoute' => 'dinas.scale.destroy', 'deleteConfirm' => 'Yakin ingin menghapus skala usaha ini?'])
        </div>
    </section>
</div>

<script>
const tabs = ['category', 'region', 'scale'];

function switchTab(active) {
    tabs.forEach(key => {
        const tab = document.getElementById('tab-' + key);
        const panel = document.getElementById('panel-' + key);
        const badge = document.getElementById('badge-' + key);

        if (key === active) {
            panel.style.display = '';
            tab.style.borderBottomColor = 'var(--color-primary)';
            tab.style.color = 'var(--color-primary)';
            badge.className = 'badge badge-success';
        } else {
            panel.style.display = 'none';
            tab.style.borderBottomColor = 'transparent';
            tab.style.color = 'var(--color-text-muted)';
            badge.className = 'badge badge-secondary';
        }
    });
}

document.addEventListener('DOMContentLoaded', () => switchTab('category'));
</script>
@endsection
