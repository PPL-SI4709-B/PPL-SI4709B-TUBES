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
| #10 | Profile | Andra | UmkmController + View |
| #11 | Event | Andra | EventController |
| #12 | Event Detail | Andra | View only |
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
| #16 | Register | Fatih | ✅ Done | AuthController fully implemented |
| #10 | Profil UMKM | Avan | ✅ Done | UmkmController & views complete |
| #7 | Verifikasi UMKM | Bagas | ✅ Done | VerificationController complete |
| #13 | Pengajuan | Davi | ✅ Done | PengajuanController store method complete |
| #5 | Approval | Andika | ✅ Done | PengajuanController approve/reject methods complete |
| #15 | Status Pengajuan | Davi | ✅ Done | UMKM index view for Pengajuan complete |

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

### Auth & Role — TELAH DIIMPLEMENTASI
- `AuthController` menggunakan `Auth::attempt()`.
- Kolom `role` sudah ada di tabel `users`.
- Middleware `auth`, `guest`, dan role-based access (`role:umkm`, `role:dinas`) telah diterapkan pada routes.
- Route protection menggunakan middleware Laravel bawaan dan custom.

### PBI #16 - Auth & Register — SELESAI
Seluruh isu login dan registrasi telah diselesaikan:
- Login menggunakan role-based redirect.
- Root `/` mengarahkan berdasarkan `Auth::user()->role`.
- Data registrasi (Step 1-3) divalidasi dengan `$request->validate()` dan disimpan ke database (tabel `users` dan `umkm_profiles`).
- Dashboard dan halaman lain mengambil data dinamis dari session user yang login.

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
