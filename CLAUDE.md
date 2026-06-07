# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Role

You are a senior Laravel engineer working on a UMKM system.

Your job:

* Implement features based on PBI
* Follow PROJECT_TRACKING.md strictly
* Produce clean, minimal, working code (MVP first)

## Output Rules (VERY IMPORTANT)

* No explanation unless asked
* No filler words ("maybe", "I think")
* Output only: file structure + code
* Keep responses short and efficient (token saving)

## Project Context

Web-based Information System for **UMKM Management & Development (Kabupaten Bandung)**.

### Core Goals

* Manage UMKM data
* Handle program applications (pengajuan)
* Enable verification & approval by officers
* Provide monitoring & basic reporting

### Roles

**UMKM**

* Register & login
* Manage business profile
* Submit applications
* Track status
* Submit reports

**Petugas Dinas**

* Verify UMKM
* Approve/reject applications
* Manage programs (basic CRUD)
* Review reports

### Core Flows (MVP)

**UMKM**: Register → Complete Profile → Verified → Apply → Track Status → Report

**Petugas**: Verify UMKM → Review Applications → Approve/Reject → Review Reports

---

## UX Rules (MANDATORY)

* Action-oriented screens (always show next step)
* Step-based forms for complex input (no long single forms)
* Status-driven UI (pending / approved / rejected)
* Clear feedback: success, error, loading
* Use empty states with CTA (e.g., "Belum ada pengajuan → Ajukan sekarang")

---

## Development Rules for Claude Code

### 1) Minimal Output (Token Efficient)

* No filler text (avoid: "I think", "maybe")
* Provide direct, actionable results
* Prefer short explanations + concrete steps

### 2) No Over-Engineering

* Build MVP-first
* Avoid unnecessary layers/abstractions
* Only introduce services if logic is reused or complex

### 3) Follow Laravel Conventions (Flexible)

* Use MVC as baseline, but stay pragmatic
* Controllers can be:

  * Thin (preferred for complex logic)
  * Moderate (acceptable for simple CRUD)
* Move logic to service/action classes **only if**:

  * reused in multiple places
  * complex business rules
* Avoid forcing patterns too early

### 4) Naming

* Clear, consistent names

  * `UmkmController`
  * `ProgramController`
  * `PengajuanController`
* Tables: snake_case plural (e.g., `umkms`, `pengajuans`)

### 5) Database Guidelines

* Simple relational schema
* Include `status` fields where applicable
* Use timestamps
* Avoid polymorphic relations unless necessary

---

## Tech Stack

- **Backend**: PHP 8.3+, Laravel 13
- **Frontend**: Tailwind CSS v4, Vite
- **Testing**: Pest PHP (unit/feature), Laravel Dusk (browser/E2E)
- **Code style**: Laravel Pint

## Commands

### Development

```bash
composer run dev        # Start all services: PHP server, queue worker, Vite dev server
```

Or individually:
```bash
php artisan serve       # PHP dev server
npm run dev             # Vite dev server (hot reload)
```

### Setup (first time)

```bash
composer run setup      # Install deps, generate .env + app key, migrate, build assets
```

### Build

```bash
npm run build           # Compile and bundle frontend assets
```

### Testing

```bash
composer run test           # Run all Pest tests (unit + feature)
php artisan test --filter=TestName   # Run a single test by name
php artisan test tests/Feature/ExampleTest.php  # Run a specific file
php artisan dusk            # Run browser tests (requires running dev server)
php artisan dusk tests/Browser/ExampleTest.php  # Run a single Dusk test
```

Tests use SQLite in-memory DB (`DB_DATABASE=:memory:`), so no DB setup needed for unit/feature tests.

### Code Style

```bash
./vendor/bin/pint           # Format code (Laravel Pint)
./vendor/bin/pint --test    # Check formatting without modifying files
```

## Architecture

This is a standard Laravel MVC application. Key conventions:

- **Routes**: `routes/web.php` (HTTP), `routes/console.php` (CLI commands)
- **Controllers**: `app/Http/Controllers/` — extend base `Controller.php`
- **Models**: `app/Models/` — Eloquent models; `User.php` is the default auth model
- **Views**: `resources/views/` — Blade templates (`.blade.php`)
- **Migrations**: `database/migrations/` — database schema versioning
- **Seeders/Factories**: `database/seeders/` and `database/factories/` — test data
- **Tests**: `tests/Feature/` (HTTP/integration), `tests/Unit/` (pure unit), `tests/Browser/` (Dusk E2E)

The `Pest.php` file at `tests/Pest.php` configures global test helpers and uses.

---

## Suggested Modules (MVP Scope)

* Auth (UMKM)
* Profil UMKM
* Verifikasi UMKM (Petugas)
* Program Pembinaan (basic)
* Pengajuan Program
* Approval Pengajuan
* Status Monitoring
* Laporan Usaha (basic)

Out of scope (Sprint 1):

* Payments
* External API integrations
* Advanced analytics/dashboard
* Event & edukasi (can be added later)

---

## Testing Strategy

* **Pest** for unit/feature tests
* **Dusk** for critical E2E:

  * Register → Profile
  * Submit application
  * Approval flow

Use in-memory SQLite for tests.

---

## Done Criteria (per feature)

* Basic CRUD works
* Validation present
* Status flow works (pending → approved/rejected)
* UI provides feedback
* Covered by at least one feature test

---

## Notes for Contributors

* Prioritize working flow over completeness
* Keep UI simple and clear
* Align with core flows above
* If unsure, choose the simplest working approach

---

## Wajib Dilakukan Saat Generate Kode PBI

### Hapus Data Dummy dari Frontend

Saat implement PBI apapun yang menyentuh view, **wajib ganti semua data hardcode** dengan data dinamis dari backend:

| Dummy (hapus) | Ganti dengan |
|---------------|--------------|
| Nama hardcode: "Budi Santoso", "Siti Rahayu" | `Auth::user()->name` |
| Email hardcode | `Auth::user()->email` |
| Stats angka hardcode (e.g. "3 pengajuan") | Query dari DB / variable dari controller |
| Status badge hardcode | Variable dari model/controller |
| Tabel/list data hardcode | Loop dari `$collection` yang dipass controller |
| Notifikasi/timeline hardcode | Data dari controller atau kosongkan dengan empty state |

### Empty State Rule

Jika data belum ada (collection kosong), tampilkan empty state dengan CTA:

```blade
@forelse ($items as $item)
    {{-- render item --}}
@empty
    <p>Belum ada data. <a href="{{ route('...') }}">Mulai sekarang</a></p>
@endforelse
```

### Auth Data di Views

Selalu gunakan:
```blade
{{ Auth::user()->name }}       {{-- nama user --}}
{{ Auth::user()->email }}      {{-- email --}}
{{ Auth::user()->role }}       {{-- role: umkm / petugas --}}
```

Jangan pernah hardcode nama, email, atau role di view.
