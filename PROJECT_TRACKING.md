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

## Sprint 2 Table

| PBI | Feature | Owner | Deskripsi | Durasi | Files |
|-----|---------|-------|-----------|--------|-------|
| #22 | Formulir Pengajuan Pendanaan UMKM | Dzaki | Form digital pengajuan permohonan pendanaan usaha oleh UMKM | 7 hari | PengajuanPendanaan Model, Migration, Controller, View (form multi-step) |
| #23 | Kelola Master Data Sumber Pendanaan | Dzaki | CRUD sumber pendanaan oleh Petugas Dinas | 3 hari | SumberPendanaan Model, Migration, Controller, View |
| #24 | Verifikasi dan Persetujuan Pengajuan Pendanaan | Dzaki | Petugas memverifikasi & memberi keputusan pengajuan pendanaan | 5 hari | Update PengajuanPendanaanController (approve/reject + catatan) |
| #25 | Dashboard Monitoring Lanjutan Dinas | Andika | Statistik & grafik distribusi UMKM untuk Petugas Dinas | 5 hari | DashboardDinasController, View (chart.js / recharts) |
| #26 | Laporan Rekap & Export Data UMKM | Andika | Export laporan rekap UMKM ke PDF atau Excel | 5 hari | LaporanExportController, View, PDF/Excel export |
| #27 | Dashboard UMKM & Ringkasan Aktivitas | Andika | Ringkasan status pengajuan, laporan, dan event di dashboard UMKM | 4 hari | DashboardUmkmController, View (summary cards) |
| #28 | CRUD Event dan Pelatihan oleh Dinas | Bagas | Petugas Dinas kelola data event & pelatihan | 4 hari | Event Model, Migration, Controller, View (CRUD) |
| #29 | Pendaftaran Event oleh UMKM | Bagas | UMKM daftar ke event atau pelatihan yang tersedia | 4 hari | EventRegistration Model, Migration, Controller, View |
| #30 | Evaluasi Laporan Perkembangan Usaha | Bagas | Petugas memberi evaluasi terstruktur terhadap laporan UMKM | 3 hari | Update LaporanController + EvaluasiController, View |
| #31 | Riwayat Kegiatan Event UMKM | Avan | UMKM melihat riwayat event/pelatihan yang pernah diikuti | 3 hari | View riwayat event (query dari EventRegistration) |
| #32 | Feedback & Review Event oleh UMKM | Avan | UMKM memberi feedback/ulasan terhadap event yang telah diikuti | 3 hari | EventFeedback Model, Migration, Controller, View |
| #33 | Halaman Informasi & Panduan Penggunaan Sistem | Avan | Halaman panduan penggunaan sistem & kontak dinas untuk UMKM | 2 hari | View statis (panduan.blade.php + kontak) |
| #34 | Form Laporan Perkembangan Usaha Berkala | Davi | UMKM kirim laporan perkembangan usaha tiap 3 bulan (Q1–Q4) | 5 hari | LaporanBerkala Model, Migration, Controller, View (form per kuartal) |
| #35 | Grafik Perkembangan Omzet UMKM | Davi | Visualisasi grafik omzet berdasarkan laporan yang telah dikirim | 3 hari | View chart (chart.js/recharts), data dari LaporanBerkala |
| #36 | Draft Laporan Perkembangan Usaha | Davi | UMKM simpan laporan sebagai draft sebelum submit | 3 hari | Tambah kolom `status` (draft/submitted) di LaporanBerkala + update Controller |
| #37 | CRUD Materi Edukasi oleh Dinas | Fatih | Petugas Dinas kelola konten materi edukasi digital untuk UMKM | 5 hari | MateriEdukasi Model, Migration, Controller, View (CRUD + upload file) |
| #38 | Akses dan Unduh Materi Edukasi oleh UMKM | Fatih | UMKM akses & unduh materi edukasi yang tersedia | 4 hari | View index & detail materi, download handler |
| #39 | Notifikasi In-App untuk Petugas Dinas | Fatih | Petugas terima notifikasi pengajuan baru, laporan masuk, UMKM baru daftar | 2 hari | Notification Model, Migration, NotificationController, View (bell icon + list) |
| #40 | Halaman Notifikasi & Riwayat Status UMKM | Althaf | UMKM lihat daftar notifikasi & riwayat perubahan status pengajuan | 2 hari | View notifikasi UMKM (query Notification + StatusLog) |
| #41 | Timeline Perubahan Status Pengajuan Pendanaan | Althaf | UMKM lihat riwayat kronologis perubahan status pengajuan pendanaan | 2 hari | PengajuanStatusLog Model, Migration, View timeline |
| #42 | Halaman FAQ dan Bantuan Penggunaan Sistem | Althaf | UMKM baca FAQ & petunjuk penggunaan sistem secara mandiri | 3 hari | View statis (faq.blade.php) |

---

## Priority (Strict Order)

### Sprint 1
1. #16 Register
2. #10 Profile
3. #7 Verification
4. #13 Pengajuan
5. #5 Approval
6. #15 Status

### Sprint 2
1. #16 Register *(prereq — harus selesai sebelum Sprint 2 dimulai)*
2. #22 Formulir Pengajuan Pendanaan
3. #23 Master Data Sumber Pendanaan
4. #24 Verifikasi Pengajuan Pendanaan
5. #28 CRUD Event & Pelatihan
6. #29 Pendaftaran Event
7. #34 Form Laporan Berkala
8. #36 Draft Laporan
9. #35 Grafik Omzet
10. #37 CRUD Materi Edukasi
11. #25 Dashboard Monitoring Dinas
12. #27 Dashboard UMKM
13. #26 Export Laporan
14. #30 Evaluasi Laporan
15. #39 Notifikasi Dinas
16. #40 Notifikasi UMKM
17. #41 Timeline Status Pengajuan
18. #31 Riwayat Event UMKM
19. #32 Feedback Event
20. #38 Akses Materi Edukasi
21. #33 Halaman Panduan
22. #42 Halaman FAQ

---

## Progress Tracking

### Sprint 1

| PBI | Feature | Owner | Status | Notes |
|-----|---------|-------|--------|-------|
| #16 | Register | Fatih | ⬜ Not Started | Prereq untuk semua PBI Sprint 2 |
| #10 | Profil UMKM | Avan | ⬜ Not Started | |
| #7 | Verifikasi UMKM | Bagas | ⬜ Not Started | |
| #13 | Pengajuan | Davi | ⬜ Not Started | |
| #5 | Approval | Andika | ⬜ Not Started | |
| #15 | Status Pengajuan | Davi | ⬜ Not Started | |

### Sprint 2

| PBI | Feature | Owner | Status | Notes |
|-----|---------|-------|--------|-------|
| #22 | Formulir Pengajuan Pendanaan | Dzaki | ⬜ Not Started | Bergantung pada #16, #23 |
| #23 | Master Data Sumber Pendanaan | Dzaki | ⬜ Not Started | |
| #24 | Verifikasi Pengajuan Pendanaan | Dzaki | ⬜ Not Started | Bergantung pada #22 |
| #25 | Dashboard Monitoring Dinas | Andika | ⬜ Not Started | Bergantung pada #22, #34 |
| #26 | Export Laporan UMKM | Andika | ⬜ Not Started | Bergantung pada #25 |
| #27 | Dashboard UMKM | Andika | ⬜ Not Started | Bergantung pada #22, #29, #34 |
| #28 | CRUD Event & Pelatihan | Bagas | ⬜ Not Started | |
| #29 | Pendaftaran Event | Bagas | ⬜ Not Started | Bergantung pada #28 |
| #30 | Evaluasi Laporan | Bagas | ⬜ Not Started | Bergantung pada #34 |
| #31 | Riwayat Event UMKM | Avan | ⬜ Not Started | Bergantung pada #29 |
| #32 | Feedback Event | Avan | ⬜ Not Started | Bergantung pada #29, #31 |
| #33 | Halaman Panduan | Avan | ⬜ Not Started | |
| #34 | Form Laporan Berkala | Davi | ⬜ Not Started | Bergantung pada #16 |
| #35 | Grafik Omzet | Davi | ⬜ Not Started | Bergantung pada #34 |
| #36 | Draft Laporan | Davi | ⬜ Not Started | Bergantung pada #34 |
| #37 | CRUD Materi Edukasi | Fatih | ⬜ Not Started | |
| #38 | Akses Materi Edukasi | Fatih | ⬜ Not Started | Bergantung pada #37 |
| #39 | Notifikasi Dinas | Fatih | ⬜ Not Started | Bergantung pada #22, #34, #16 |
| #40 | Notifikasi UMKM | Althaf | ⬜ Not Started | Bergantung pada #39 |
| #41 | Timeline Status Pengajuan | Althaf | ⬜ Not Started | Bergantung pada #22, #24 |
| #42 | Halaman FAQ | Althaf | ⬜ Not Started | |

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
- `components/stepper.blade.php` — props `current` (1–3), gunakan di register flow & form multi-step
- `components/help-banner.blade.php` — reusable info banner
- `layouts/app.blade.php` — layout dashboard (sidebar + header)
- `layouts/auth.blade.php` — layout halaman auth

### Existing Routes
- Prefix `/umkm/` dan `/dinas/` sudah ada — lanjutkan konvensi ini
- Nama route: `umkm.dashboard`, `dinas.dashboard`, `umkm.register.step-1` dst

### Sprint 2 — Dependency Kritis
- **#22, #29, #34** adalah PBI inti Sprint 2 — harus diselesaikan lebih dulu
- **#39 (Notifikasi Dinas)** dan **#40 (Notifikasi UMKM)** harus pakai model `Notification` yang sama
- **#41 (Timeline)** butuh tabel log status tersendiri (`pengajuan_status_logs`)
- **#25 & #27 (Dashboard)** bergantung pada data dari #22, #29, #34 — implement terakhir
- **#26 (Export)** gunakan library `barryvdh/laravel-dompdf` (PDF) dan `maatwebsite/excel` (Excel)

---

## Final Rule

- Do exactly what PBI says
- Do not add features outside scope
- Keep code simple
