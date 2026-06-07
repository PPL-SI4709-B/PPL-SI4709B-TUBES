# Full Audit Fix Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Fix all issues from audit: delete dangerous migration, make all navigation complete and working, add missing data to dinas views, fix dead links, make status banners actionable, unify status badge styling.

**Architecture:** Create 2 shared Blade sidebar components (`x-umkm-sidebar`, `x-dinas-sidebar`) to fix all nav inconsistencies at once, then target-fix remaining UX and data issues.

**Tech Stack:** Laravel 13, Blade components, PHP 8.3, custom CSS (public/css/style.css)

---

## Scope of Problems Found

### Nav gaps (all `@section('sidebar')` diverge from full nav):
**UMKM views missing "Profil Usaha":** `umkm/dashboard`, `umkm/pengajuan/index`, `umkm/event`
**UMKM dead links (#):** `umkm/reports/index` lines 22,26 — `umkm/reports/create` lines 22,26
**Dinas views missing nav items:**
- `dinas/dashboard` — missing "Review Laporan", "Master Data"
- `dinas/verification/index` — missing "Review Laporan", "Master Data"
- `dinas/pengajuan/index` — missing "Verifikasi UMKM", "Review Laporan", "Master Data"
- `dinas/pengajuan/show` — missing "Verifikasi UMKM", "Review Laporan", "Master Data"
- `dinas/report/show` — only has Beranda + Review Laporan (missing 4!)
- `dinas/program/index`, `create`, `edit` — only Beranda + Kelola Program (missing 4!)
- `dinas/category/_sidebar`, `region/_sidebar`, `scale/_sidebar` — missing everything

**Master Data (category/region/scale controllers) unreachable from dinas nav** — add "Master Data" link.

### UX fixes needed:
- `auth/login.blade.php:41` — "Lupa Password?" → dead `#`
- `umkm/register/step-3.blade.php:22,46` — edit buttons `type="button"` no handler
- `dinas/pengajuan/show.blade.php` — missing `kebutuhan_usaha` + `dokumen_pendukung` fields
- `umkm/dashboard.blade.php` — no `session('success')` display; status banners have no action links
- `umkm/pengajuan/index.blade.php:86` — unverified warning has no link to profile

### Status badge inconsistency:
Inline `match()` with hardcoded hex colors duplicated in: `umkm/dashboard`, `dinas/dashboard`, `umkm/reports/index`, `dinas/report/index`, `dinas/pengajuan/show`. Fix with `<x-status-badge>` component + CSS classes.

---

## Files

### Create (new):
- `resources/views/components/umkm-sidebar.blade.php` — shared UMKM nav
- `resources/views/components/dinas-sidebar.blade.php` — shared Dinas nav
- `resources/views/components/status-badge.blade.php` — unified badge

### Delete:
- `database/migrations/2026_04_24_000000_create_pengajuans_table.php` — duplicates + drops pengajuans table

### Modify:
- `public/css/style.css` — add `.badge-approved`, `.badge-pending`, `.badge-rejected`
- 8 UMKM views — replace `@section('sidebar')` block
- 12 Dinas views/partials — replace `@section('sidebar')` block or `_sidebar.blade.php` content
- `dinas/pengajuan/show.blade.php` — add kebutuhan_usaha
- `auth/login.blade.php` — remove dead link
- `umkm/register/step-3.blade.php` — fix edit buttons
- `umkm/dashboard.blade.php` — add session flash, fix banners
- `umkm/pengajuan/index.blade.php` — add profile link in unverified banner

---

## Task 1: Delete Dangerous Duplicate Migration

**Files:**
- Delete: `database/migrations/2026_04_24_000000_create_pengajuans_table.php`

The April 24 migration does `Schema::dropIfExists('pengajuans')` then recreates WITHOUT `notes` and `jenis` columns. The April 18 migration correctly uses `if (!Schema::hasTable(...))` guard. The April 24 version is pure risk — on rollback it destroys the table.

- [ ] **Step 1: Delete the file**

```bash
rm "database/migrations/2026_04_24_000000_create_pengajuans_table.php"
```

- [ ] **Step 2: Verify migrations still run correctly**

```bash
php artisan migrate:fresh --seed 2>&1 | tail -20
```

Expected: no errors, `pengajuans` table created with `kebutuhan_usaha`, `dokumen_pendukung`, `status`, `notes`, `jenis` columns (via April 18 + May 2 + May 4 migrations).

- [ ] **Step 3: Commit**

```bash
git add -A
git commit -m "fix: remove duplicate pengajuans migration that drops table on rollback"
```

---

## Task 2: Create x-umkm-sidebar Blade Component

**Files:**
- Create: `resources/views/components/umkm-sidebar.blade.php`

Complete UMKM nav: Beranda, Profil Usaha, Pengajuan Program, Event & Pelatihan, Laporan Perkembangan.

- [ ] **Step 1: Create the component**

```bash
# resources/views/components/umkm-sidebar.blade.php
```

Content:

```blade
@props(['active' => ''])

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
        <a href="{{ route('umkm.dashboard') }}" class="nav-item {{ $active === 'dashboard' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
            Beranda
        </a>
        <a href="{{ route('umkm.profile.show') }}" class="nav-item {{ $active === 'profile' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></span>
            Profil Usaha
        </a>
        <a href="{{ route('umkm.pengajuan.index') }}" class="nav-item {{ $active === 'pengajuan' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></span>
            Pengajuan Program
        </a>
        <a href="{{ route('umkm.event') }}" class="nav-item {{ $active === 'event' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Event &amp; Pelatihan
        </a>
        <a href="{{ route('reports.index') }}" class="nav-item {{ $active === 'reports' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Laporan Perkembangan
        </a>
    </nav>

    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('umkm-logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="umkm-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
</aside>
```

- [ ] **Step 2: Verify component resolves (no syntax errors)**

```bash
php artisan view:clear
```

Expected: no errors.

---

## Task 3: Create x-dinas-sidebar Blade Component

**Files:**
- Create: `resources/views/components/dinas-sidebar.blade.php`

Complete Dinas nav: Beranda, Verifikasi UMKM, Kelola Program, Approval Pengajuan, Review Laporan, Master Data.

- [ ] **Step 1: Create the component**

```blade
@props(['active' => ''])

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title">PORTAL UMKM</div>
        <div class="brand-subtitle">Kabupaten Bandung</div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('dinas.dashboard') }}" class="nav-item {{ $active === 'dashboard' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></span>
            Beranda
        </a>
        <a href="{{ route('dinas.verification.index') }}" class="nav-item {{ $active === 'verification' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
            Verifikasi UMKM
        </a>
        <a href="{{ route('dinas.program.index') }}" class="nav-item {{ $active === 'program' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg></span>
            Kelola Program
        </a>
        <a href="{{ route('dinas.pengajuan.index') }}" class="nav-item {{ $active === 'pengajuan' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
            Approval Pengajuan
        </a>
        <a href="{{ route('dinas.report.index') }}" class="nav-item {{ $active === 'report' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Review Laporan
        </a>
        <a href="{{ route('dinas.category.index') }}" class="nav-item {{ $active === 'master-data' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>
            Master Data
        </a>
    </nav>

    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('dinas-logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="dinas-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
</aside>
```

- [ ] **Step 2: Clear view cache**

```bash
php artisan view:clear
```

---

## Task 4: Update All UMKM View Sidebars

**Files to modify** (replace entire `@section('sidebar')...@endsection` block in each):

### 4a. `resources/views/umkm/dashboard.blade.php`

- [ ] Replace sidebar section:

Old:
```blade
@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand flex items-center gap-3">
```

New (replace entire `@section('sidebar')...@endsection` up to `@section('header')`):
```blade
@section('sidebar')
<x-umkm-sidebar active="dashboard" />
@endsection
```

### 4b. `resources/views/umkm/profile/show.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-umkm-sidebar active="profile" />
@endsection
```

### 4c. `resources/views/umkm/profile/edit.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-umkm-sidebar active="profile" />
@endsection
```

### 4d. `resources/views/umkm/pengajuan/index.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-umkm-sidebar active="pengajuan" />
@endsection
```

### 4e. `resources/views/umkm/event.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-umkm-sidebar active="event" />
@endsection
```

### 4f. `resources/views/umkm/eventdetail.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-umkm-sidebar active="event" />
@endsection
```

### 4g. `resources/views/umkm/reports/index.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-umkm-sidebar active="reports" />
@endsection
```

### 4h. `resources/views/umkm/reports/create.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-umkm-sidebar active="reports" />
@endsection
```

- [ ] **Verify no `href="#"` remain in UMKM views:**

```bash
grep -rn 'href="#"' resources/views/umkm/
```

Expected: only logout links (which use onclick submit form). If any dead `#` remain in nav items, fix them.

- [ ] **Commit:**
```bash
git add resources/views/umkm/ resources/views/components/umkm-sidebar.blade.php
git commit -m "feat: unify UMKM sidebar nav — add Profil Usaha to all views, fix dead links"
```

---

## Task 5: Update All Dinas View Sidebars

### 5a. `resources/views/dinas/dashboard.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-dinas-sidebar active="dashboard" />
@endsection
```

### 5b. `resources/views/dinas/verification/index.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-dinas-sidebar active="verification" />
@endsection
```

### 5c. `resources/views/dinas/pengajuan/index.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-dinas-sidebar active="pengajuan" />
@endsection
```

### 5d. `resources/views/dinas/pengajuan/show.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-dinas-sidebar active="pengajuan" />
@endsection
```

### 5e. `resources/views/dinas/report/index.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-dinas-sidebar active="report" />
@endsection
```

### 5f. `resources/views/dinas/report/show.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-dinas-sidebar active="report" />
@endsection
```

### 5g. `resources/views/dinas/program/index.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-dinas-sidebar active="program" />
@endsection
```

### 5h. `resources/views/dinas/program/create.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-dinas-sidebar active="program" />
@endsection
```

### 5i. `resources/views/dinas/program/edit.blade.php`

- [ ] Replace sidebar section:
```blade
@section('sidebar')
<x-dinas-sidebar active="program" />
@endsection
```

### 5j. `resources/views/dinas/category/_sidebar.blade.php`

- [ ] Replace entire file content with:
```blade
<x-dinas-sidebar active="master-data" />
```

### 5k. `resources/views/dinas/region/_sidebar.blade.php`

- [ ] Replace entire file content with:
```blade
<x-dinas-sidebar active="master-data" />
```

### 5l. `resources/views/dinas/scale/_sidebar.blade.php`

- [ ] Replace entire file content with:
```blade
<x-dinas-sidebar active="master-data" />
```

- [ ] **Verify no `href="#"` remain in dinas nav items:**
```bash
grep -rn 'href="#"' resources/views/dinas/
```

Expected: only logout button onclick forms. No nav items should have dead `#` links.

- [ ] **Commit:**
```bash
git add resources/views/dinas/ resources/views/components/dinas-sidebar.blade.php
git commit -m "feat: unify Dinas sidebar nav — add Review Laporan and Master Data to all views"
```

---

## Task 6: Fix Specific UX Issues

### 6a. Remove dead "Lupa Password?" link

**File:** `resources/views/auth/login.blade.php:39-41`

- [ ] Replace the label+link group:

Old:
```blade
<div class="flex justify-between items-center">
    <label class="input-label">PASSWORD</label>
    <a href="#" class="text-xs font-semibold link-brand" style="text-decoration: underline;">Lupa Password?</a>
</div>
```

New (just remove the dead link):
```blade
<div class="flex justify-between items-center">
    <label class="input-label">PASSWORD</label>
</div>
```

### 6b. Fix Step-3 Edit Buttons

**File:** `resources/views/umkm/register/step-3.blade.php`

The two pencil-icon `<button type="button">` have no action. Replace with anchor tags.

- [ ] Replace the account card edit button (line ~22):

Old:
```blade
<button type="button" class="absolute bg-input-bg text-muted" style="top: 20px; right: 20px; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: #F1F5F9;">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
</button>
```

New:
```blade
<a href="{{ route('umkm.register.step-1') }}" class="absolute" style="top: 20px; right: 20px; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: #F1F5F9; color: var(--color-text-muted);">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
</a>
```

- [ ] Replace the business card edit button (line ~46):

Old:
```blade
<button type="button" class="absolute bg-input-bg text-muted" style="top: 20px; right: 20px; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: #F1F5F9;">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
</button>
```

New:
```blade
<a href="{{ route('umkm.register.step-2') }}" class="absolute" style="top: 20px; right: 20px; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: #F1F5F9; color: var(--color-text-muted);">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
</a>
```

### 6c. Add kebutuhan_usaha to Dinas Pengajuan Show

**File:** `resources/views/dinas/pengajuan/show.blade.php`

The officer review screen is missing the most critical field: what the UMKM is actually requesting (`kebutuhan_usaha`) and their supporting document.

- [ ] After the "Program" section (around line 83-84), insert:

```blade
<div>
    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Kebutuhan Usaha</div>
    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px; padding: var(--space-3); background: var(--color-gray-50); border-radius: var(--radius-md); border: 1px solid var(--color-border); white-space: pre-line;">{{ $pengajuan->kebutuhan_usaha }}</div>
</div>
@if ($pengajuan->dokumen_pendukung)
<div>
    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Dokumen Pendukung</div>
    <div style="margin-top: 4px;">
        <a href="{{ Storage::url($pengajuan->dokumen_pendukung) }}" target="_blank" style="font-size: var(--text-sm); color: var(--color-secondary); text-decoration: underline;">
            Lihat Dokumen ↗
        </a>
    </div>
</div>
@endif
```

Note: Add `use Illuminate\Support\Facades\Storage;` is NOT needed in blade — use the `Storage` facade directly or add `storage_path()`. In Blade, `Storage::url()` works directly.

### 6d. Fix UMKM Dashboard — Add Flash + Actionable Banners

**File:** `resources/views/umkm/dashboard.blade.php`

- [ ] At the top of `@section('content')`, before the status banners, add session flash:

After `<div class="flex flex-col gap-6" style="max-width: 64rem; margin: 0 auto;">`, insert:

```blade
@if(session('success'))
    <div style="background-color: var(--color-success-bg); border-left: 4px solid var(--color-success); padding: 1.25rem 1.5rem; border-radius: var(--radius-md); color: #166534; font-size: 0.875rem; font-weight: 500;">
        {{ session('success') }}
    </div>
@endif
```

- [ ] Fix the "pending" status banner (lines 64-77) — add "Lihat Profil" CTA:

Old:
```blade
<div class="flex items-center justify-between" style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-warning);">
    <div class="flex items-center gap-4">
        <div style="background-color: rgba(245,158,11,0.2); padding: 0.5rem; border-radius: var(--radius-sm); color: var(--color-warning);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
        </div>
        <div>
            <h3 class="text-base font-bold" style="color: #854d0e;">Profil Anda belum diverifikasi</h3>
            <p class="text-sm" style="color: #a16207;">Tunggu petugas memverifikasi akun Anda untuk dapat mengajukan program.</p>
        </div>
    </div>
</div>
```

New:
```blade
<div class="flex items-center justify-between" style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-warning);">
    <div class="flex items-center gap-4">
        <div style="background-color: rgba(245,158,11,0.2); padding: 0.5rem; border-radius: var(--radius-sm); color: var(--color-warning);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
        </div>
        <div>
            <h3 class="text-base font-bold" style="color: #854d0e;">Profil Anda belum diverifikasi</h3>
            <p class="text-sm" style="color: #a16207;">Tunggu petugas Dinas memverifikasi akun Anda. Pastikan profil usaha sudah lengkap.</p>
        </div>
    </div>
    <a href="{{ route('umkm.profile.show') }}" style="font-size: var(--text-sm); font-weight: 600; color: #854d0e; text-decoration: underline; white-space: nowrap; margin-left: 1rem;">
        Cek Profil →
    </a>
</div>
```

- [ ] Fix the "rejected" status banner (lines 79-84) — add contact / re-check CTA:

Old:
```blade
<div style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-danger);">
    <h3 class="text-base font-bold" style="color: #991b1b;">Verifikasi ditolak</h3>
    <p class="text-sm" style="color: #b91c1c;">Hubungi petugas dinas untuk informasi lebih lanjut.</p>
</div>
```

New:
```blade
<div style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-danger);">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-base font-bold" style="color: #991b1b;">Verifikasi ditolak</h3>
            <p class="text-sm" style="color: #b91c1c;">Profil Anda ditolak oleh petugas Dinas. Perbarui data profil dan hubungi petugas.</p>
        </div>
        <a href="{{ route('umkm.profile.edit') }}" style="font-size: var(--text-sm); font-weight: 600; color: #991b1b; text-decoration: underline; white-space: nowrap; margin-left: 1rem;">
            Edit Profil →
        </a>
    </div>
</div>
```

### 6e. Fix UMKM Pengajuan — Actionable Unverified Banner

**File:** `resources/views/umkm/pengajuan/index.blade.php:85-89`

- [ ] Replace the static warning:

Old:
```blade
@if(Auth::user()->profile_status !== 'verified')
    <div style="background-color: #fefce8; border-left: 4px solid #f59e0b; padding: 1rem 1.25rem; border-radius: var(--radius-md); font-size: var(--text-sm); color: #92400e;">
        <strong>Akun belum diverifikasi.</strong> Anda belum dapat mengajukan program. Tunggu petugas dinas memverifikasi akun Anda.
    </div>
@endif
```

New:
```blade
@if(Auth::user()->profile_status !== 'verified')
    <div style="background-color: #fefce8; border-left: 4px solid #f59e0b; padding: 1rem 1.25rem; border-radius: var(--radius-md); font-size: var(--text-sm); color: #92400e; display: flex; justify-content: space-between; align-items: center;">
        <span><strong>Akun belum diverifikasi.</strong> Anda belum dapat mengajukan program. Pastikan profil usaha sudah lengkap.</span>
        <a href="{{ route('umkm.profile.show') }}" style="font-weight: 600; text-decoration: underline; white-space: nowrap; margin-left: 1rem;">Cek Profil →</a>
    </div>
@endif
```

- [ ] **Commit all UX fixes:**

```bash
git add resources/views/
git commit -m "fix: dead links, step-3 edit buttons, kebutuhan_usaha display, actionable status banners"
```

---

## Task 7: Create x-status-badge Component + Unified CSS

**Files:**
- Create: `resources/views/components/status-badge.blade.php`
- Modify: `public/css/style.css`

### 7a. Add badge CSS classes to style.css

- [ ] Open `public/css/style.css` and append these rules (after existing `.badge` styles):

```css
/* Status badge variants */
.badge-approved {
    background-color: #d1fae5;
    color: #059669;
}

.badge-pending {
    background-color: #fef3c7;
    color: #d97706;
}

.badge-rejected {
    background-color: #fee2e2;
    color: #dc2626;
}
```

### 7b. Create the component

- [ ] Create `resources/views/components/status-badge.blade.php`:

```blade
@props(['status'])

@php
$class = match($status) {
    'approved' => 'badge-approved',
    'rejected' => 'badge-rejected',
    default    => 'badge-pending',
};
$label = match($status) {
    'approved' => 'Disetujui',
    'rejected' => 'Ditolak',
    default    => 'Menunggu',
};
@endphp

<span class="badge {{ $class }}">{{ $label }}</span>
```

### 7c. Replace inline badge code in umkm/dashboard.blade.php

**File:** `resources/views/umkm/dashboard.blade.php` — the `@forelse $recentPengajuans` table and `@forelse $recentReports` table.

- [ ] In the pengajuan table (around line 136-155), replace the entire `@php ... @endphp` + inline `<span style="...">` block:

Old:
```blade
@php
    $colors = match($pengajuan->status) { ... };
    $label = match($pengajuan->status) { ... };
@endphp
...
<span style="display:inline-flex; ...background-color: {{ $colors['bg'] }}...">{{ $label }}</span>
```

New:
```blade
<x-status-badge :status="$pengajuan->status" />
```

- [ ] Repeat for the reports table (around line 185-204): replace similar `@php ... @endphp` + inline span.

New:
```blade
<x-status-badge :status="$report->status" />
```

### 7d. Replace inline badge code in umkm/reports/index.blade.php

**File:** `resources/views/umkm/reports/index.blade.php:116-129` — the three `@if / @elseif / @else` span blocks.

- [ ] Replace entire status cell content with:
```blade
<x-status-badge :status="$report->status" />
```

### 7e. Replace inline badge code in dinas/pengajuan/show.blade.php

**File:** `resources/views/dinas/pengajuan/show.blade.php:92-108` — the `@php $statusColor` + inline `<span class="badge" style="...">` block.

- [ ] Replace with:
```blade
<div style="margin-top: 4px;">
    <x-status-badge :status="$pengajuan->status" />
</div>
```

- [ ] **Commit:**
```bash
git add resources/views/components/status-badge.blade.php public/css/style.css resources/views/
git commit -m "feat: add x-status-badge component, unify status colors via CSS classes"
```

---

## Task 8: Verify Everything Works

- [ ] **Start dev server:**
```bash
php artisan serve
```

- [ ] **Manually test these routes** (open browser):

**UMKM flow:**
1. `/umkm/register/step-1` — fill form → next
2. Step 2 → next
3. Step 3 — verify edit buttons redirect to step-1 / step-2
4. Submit registration → lands on `/umkm/dashboard` with success banner visible
5. Dashboard sidebar: Beranda ✓, Profil Usaha ✓, Pengajuan ✓, Event ✓, Laporan ✓
6. Click every sidebar link — all navigate correctly, no 404

**Dinas flow:**
7. Login as dinas → `/dinas/dashboard`
8. Sidebar: Beranda ✓, Verifikasi UMKM ✓, Kelola Program ✓, Approval Pengajuan ✓, Review Laporan ✓, Master Data ✓
9. Click "Review Laporan" → opens list ✓
10. Click "Master Data" → opens category index ✓
11. Click a pengajuan in approval list → show page displays `kebutuhan_usaha` field ✓
12. Verify + Reject buttons on verification page work ✓

**Auth:**
13. `/login` — "Lupa Password?" link is gone ✓

- [ ] **Check no 500 errors in logs:**
```bash
php artisan log:clear; # then navigate all pages
tail -50 storage/logs/laravel.log
```

Expected: no exceptions.

- [ ] **Final commit:**
```bash
git add -A
git commit -m "chore: verify all navigation and UX fixes complete"
```

---

## Self-Review Checklist

- [x] **Spec coverage:** All 10 issues from audit mapped to tasks above
- [x] **Duplicate migration:** Task 1 ✓
- [x] **Dead href="#" links:** Tasks 4g, 4h, 6a ✓
- [x] **Step-3 edit buttons:** Task 6b ✓
- [x] **Missing kebutuhan_usaha in dinas:** Task 6c ✓
- [x] **UMKM dashboard session flash:** Task 6d ✓
- [x] **Actionable status banners:** Task 6d, 6e ✓
- [x] **Profil Usaha missing from UMKM nav:** Tasks 2, 4a, 4d, 4e ✓
- [x] **Review Laporan missing from Dinas nav:** Tasks 3, 5a-5l ✓
- [x] **Master Data unreachable:** Task 3, 5a-5l ✓
- [x] **report/show only 2 nav items:** Task 5f ✓
- [x] **Status badge inconsistency:** Task 7 ✓
- [x] **No placeholder steps:** All steps have exact code ✓
