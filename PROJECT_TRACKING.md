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

---

# Sprint 2 Table

| PBI | Feature | Owner | Files |
|-----|---------|-------|-------|
| #22 | Formulir Pengajuan Pendanaan UMKM | Dzaki | PengajuanPendanaanController, Migration, Form View |
| #23 | Kelola Master Data Sumber Pendanaan | Dzaki | FundingSource Model, Migration, Controller |
| #24 | Verifikasi & Persetujuan Pengajuan Pendanaan | Dzaki | ApprovalController, Status Update |
| #25 | Dashboard Monitoring Lanjutan Dinas | Andika | DashboardController, Statistik View |
| #26 | Laporan Rekap & Export Data UMKM | Andika | Export Service, ReportController |
| #27 | Dashboard UMKM & Ringkasan Aktivitas | Andika | Dashboard View Update |
| #28 | CRUD Event dan Pelatihan oleh Dinas | Bagas | EventController, Migration, CRUD View |
| #29 | Pendaftaran Event oleh UMKM | Bagas | EventRegistrationController, Registration Logic |
| #30 | Evaluasi Laporan Perkembangan Usaha | Bagas | EvaluationController, Evaluation Form |
| #31 | Riwayat Kegiatan Event UMKM | Avan | History View, Participation Query |
| #32 | Feedback & Review Event oleh UMKM | Avan | FeedbackController, Review Form |
| #33 | Halaman Informasi & Panduan Penggunaan Sistem | Avan | Static Page View |
| #34 | Form Laporan Perkembangan Usaha Berkala | Davi | ReportController, Quarterly Form |
| #35 | Grafik Perkembangan Omzet UMKM | Davi | Chart Integration, Dashboard Widget |
| #36 | Draft Laporan Perkembangan Usaha | Davi | Draft Save Logic |
| #37 | CRUD Materi Edukasi oleh Dinas | Fatih | EdukasiController, Migration, CRUD View |
| #38 | Akses & Unduh Materi Edukasi oleh UMKM | Fatih | Download Logic, Material View |
| #39 | Notifikasi In-App untuk Petugas Dinas | Fatih | Notification Service |
| #40 | Halaman Notifikasi & Riwayat Status UMKM | Althaf | NotificationController, History View |
| #41 | Timeline Perubahan Status Pengajuan Pendanaan | Althaf | Timeline Component |
| #42 | Halaman FAQ & Bantuan Penggunaan Sistem | Althaf | FAQ Page, Help View |

---

# Sprint 2 Priority (Strict Order)

1. #22 Form Pengajuan Pendanaan
2. #28 CRUD Event
3. #29 Pendaftaran Event
4. #34 Laporan Berkala
5. #25 Dashboard Monitoring
6. #39 Notifikasi In-App

---

# Sprint 2 Progress Tracking

| PBI | Feature | Owner | Status | Notes |
|-----|---------|-------|--------|-------|
| #22 | Form Pengajuan Pendanaan | Dzaki | ⬜ Not Started | |
| #23 | Master Data Sumber Pendanaan | Dzaki | ⬜ Not Started | |
| #24 | Approval Pendanaan | Dzaki | ⬜ Not Started | |
| #25 | Dashboard Monitoring Dinas | Andika | ⬜ Not Started | |
| #26 | Export Rekap Data UMKM | Andika | ⬜ Not Started | |
| #27 | Dashboard Aktivitas UMKM | Andika | ⬜ Not Started | |
| #28 | CRUD Event & Pelatihan | Bagas | ⬜ Not Started | |
| #29 | Pendaftaran Event UMKM | Bagas | ⬜ Not Started | |
| #30 | Evaluasi Laporan Usaha | Bagas | ⬜ Not Started | |
| #31 | Riwayat Event UMKM | Avan | ⬜ Not Started | |
| #32 | Feedback & Review Event | Avan | ⬜ Not Started | |
| #33 | Panduan Penggunaan Sistem | Avan | ⬜ Not Started | |
| #34 | Form Laporan Berkala | Davi | ⬜ Not Started | |
| #35 | Grafik Omzet UMKM | Davi | ⬜ Not Started | |
| #36 | Draft Laporan | Davi | ⬜ Not Started | |
| #37 | CRUD Materi Edukasi | Fatih | ⬜ Not Started | |
| #38 | Akses & Download Materi | Fatih | ⬜ Not Started | |
| #39 | Notifikasi In-App | Fatih | ⬜ Not Started | |
| #40 | Notifikasi & Riwayat Status | Althaf | ⬜ Not Started | |
| #41 | Timeline Status Pengajuan | Althaf | ⬜ Not Started | |
| #42 | FAQ & Bantuan Sistem | Althaf | ⬜ Not Started | |

---