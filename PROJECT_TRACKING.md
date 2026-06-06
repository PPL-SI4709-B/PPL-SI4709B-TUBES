# PROJECT_TRACKING.md

## Rule for Claude

When user says: **"buatkan PBI #X"**

You MUST:
- Follow this table
- Generate ONLY related files
- Do NOT add extra features

---

## Sprint 1 Table

| PBI | Feature | Owner | Files |
|-----|---------|-------|-------|
| #1 | Category | Dzaki | Category Model, Migration, Controller, View |
| #2 | Region & Scale | Dzaki | Region, Scale Model + Migration + Controller |
| #3 | Reference Data | Dzaki | Use existing controller + form integration |
| #4 | Program | Andika | Program Model, Migration, Controller, View |
| #5 | Approval | Andika | Update PengajuanController |
| #6 | Notes | Andika | Add column + update controller |
| #7 | Verify UMKM | Bagas | VerificationController |
| #8 | Review Report | Bagas | ReportReviewController |
| #9 | Report Status | Bagas | Add status field |
| #10 | Profile | Avan | UmkmController + View |
| #11 | Event | Avan | EventController |
| #12 | Event Detail | Avan | View only |
| #13 | Pengajuan | Davi | Pengajuan Model, Migration, Controller |
| #14 | Upload Doc | Davi | Add file upload |
| #15 | Status View | Davi | View index |
| #16 | Register | Fatih | Auth setup |
| #17 | Report | Fatih | Report Model, Migration, Controller |
| #18 | Report Feedback | Fatih | Update report view |
| #19 | Profile Status | Althaf | Add field |
| #20 | Pengajuan Status | Althaf | Reuse logic |
| #21 | Dashboard | Althaf | DashboardController |

---

## Priority (Strict Order)

1. #16 Register
2. #10 Profile
3. #7 Verification
4. #13 Pengajuan
5. #5 Approval
6. #15 Status

---

## Progress Tracking

| PBI | Feature | Owner | Status | Notes |
|-----|---------|-------|--------|-------|
| #16 | Register | Fatih | ⬜ Not Started | |
| #10 | Profil UMKM | Avan | ⬜ Not Started | |
| #7 | Verifikasi UMKM | Bagas | ⬜ Not Started | |
| #13 | Pengajuan | Davi | ⬜ Not Started | |
| #5 | Approval | Andika | ⬜ Not Started | |
| #15 | Status Pengajuan | Davi | ⬜ Not Started | |

**Legend:**
- ⬜ Not Started
- 🔄 In Progress
- ✅ Done

---

## Existing Code Context (Audit Result)

> Dibaca dari kondisi project saat ini. Wajib diperhatikan sebelum implement PBI apapun.

### Auth & Role — BELUM ADA (semua dummy)
- `AuthController` pakai `Session::put('is_logged_in', true)` — BUKAN `Auth::attempt()`
- Tidak ada kolom `role` di tabel `users`
- Tidak ada middleware, tidak ada policies, tidak ada gates
- Route protection pakai inline `if (!session()->has('is_logged_in'))` — bukan middleware

### Tabrakan yang Harus Diperbaiki di PBI #16

| # | Masalah | Lokasi | Fix |
|---|---------|--------|-----|
| 1 | Login selalu redirect ke `umkm.dashboard`, Petugas ikut ke sana | `AuthController@processLogin` | Role-based redirect setelah `Auth::attempt()` |
| 2 | Root `/` tidak tahu role, selalu arahkan ke UMKM | `routes/web.php` baris root | Cek `Auth::user()->role` |
| 3 | Register step-3 hardcode email `newuser@umkm.local`, data tidak masuk DB | `AuthController@processRegisterStep3` | Simpan ke DB, pakai `Auth::login()` |
| 4 | Register step 1–3 tidak ada validasi sama sekali | Semua `processRegisterStep*` | Tambah `$request->validate()` |
| 5 | Dashboard views hardcode nama user ("Budi Santoso", "Siti Rahayu") | `umkm/dashboard.blade.php`, `dinas/dashboard.blade.php` | Ganti dengan `Auth::user()->name` |

### Existing Views yang Bisa Dipakai Ulang
- `components/stepper.blade.php` — props `current` (1–3), gunakan di register flow
- `components/help-banner.blade.php` — reusable info banner
- `layouts/app.blade.php` — layout dashboard (sidebar + header)
- `layouts/auth.blade.php` — layout halaman auth

### Existing Routes
- Prefix `/umkm/` dan `/dinas/` sudah ada — lanjutkan konvensi ini
- Nama route: `umkm.dashboard`, `dinas.dashboard`, `umkm.register.step-1` dst

---

## Final Rule

- Do exactly what PBI says
- Do not add features outside scope
- Keep code simple
