# IMPLEMENTATION_REPORT.md

Implementasi 9 PBI berstatus PARTIAL → COMPLETE. Tanggal: 2026-06-08. HEAD saat mulai: `ba71dda`.

Aturan dipatuhi: route lama tidak dirusak; migration lama tidak diubah (hanya migration baru);
satu+ feature test per fitur; test dijalankan setelah implementasi; tanpa perubahan arsitektur.

Baseline test sebelum kerja: **36 Feature** lulus. Sesudah: **50 Feature** lulus (115 assertions).
Pint: `pass`.

## Migration baru
- `2026_06_08_000001_add_review_columns_to_pengajuans_table` — `reviewed_by`, `reviewed_at`
- `2026_06_08_000002_add_review_and_lampiran_to_reports_table` — `reviewed_by`, `reviewed_at`, `lampiran`
- `2026_06_08_000003_add_logo_to_umkm_profiles_table` — `logo`
- `2026_06_08_000004_add_verified_at_to_users_table` — `verified_at`

## Per-PBI

### PBI-4 — Detail Program (PARTIAL → COMPLETE)
- Backend: `ProgramController::show()` (+`loadCount('pengajuans')`); route `dinas.program.show`
  (hapus `->except(['show'])`).
- Frontend: `resources/views/dinas/program/show.blade.php` (baru) + link "Detail" di index.
- Authz: route group `role:dinas`.
- Test: `Pbi4ProgramDetailTest` (dinas 200 + lihat nama; umkm 403).

### PBI-5 — Riwayat Approval Pengajuan (PARTIAL → COMPLETE)
- Backend: `PengajuanController::approve/reject` set `reviewed_by`+`reviewed_at`; `Pengajuan`
  model + `reviewer()` relasi.
- Frontend: `dinas/pengajuan/show.blade` tampil "Riwayat Peninjauan" (reviewer + waktu).
- Test: `Pbi5PengajuanReviewTest` (reviewed_by/at tersimpan).

### PBI-6 — Catatan Wajib saat Ditolak + Tampil ke UMKM (PARTIAL → COMPLETE)
- Backend: `PengajuanController::reject` → `notes` `required` (+pesan).
- Frontend: kolom "CATATAN DINAS" di `umkm/pengajuan/index.blade`; label form dinas diperjelas.
- Validation/Authz: validasi `required`; route `role` middleware.
- Test: `Pbi6RejectNotesTest` (tanpa catatan → error; dengan catatan → tersimpan & tampil).

### PBI-8 — Riwayat Review Laporan (PARTIAL → COMPLETE)
- Backend: `ReportReviewController::update` set `reviewed_by`+`reviewed_at`; `Report::reviewer()`.
- Frontend: reviewer + tanggal di `umkm/reports/index.blade` & `dinas/report/show.blade`.
- Test: `Pbi8ReportReviewMetaTest`.

### PBI-10 — Upload Logo Profil (PARTIAL → COMPLETE)
- Backend: `UmkmController::update` validasi `logo` (`file|mimes:png,jpg,jpeg,webp|max:2048`),
  simpan disk `public` (`logos/`); `UmkmProfile` fillable + `logo`.
- Frontend: input file + `enctype` di `profile/edit.blade`; `<img>` di edit & `profile/show.blade`.
- Test: `Pbi10ProfileLogoTest` (tersimpan di disk public).

### PBI-11 — Search & Filter Event (PARTIAL → COMPLETE)
- Backend: `EventController::index` terima `?search=` (judul `like`) + `?type=`; daftar `types`.
- Frontend: form GET (input + select jenis + reset) di `umkm/event.blade`.
- Test: `Pbi11EventSearchTest` (search & filter jenis menyaring hasil).

### PBI-17 — Lampiran Laporan (PARTIAL → COMPLETE)
- Backend: `ReportController::store` validasi+simpan `lampiran` (disk **privat** `local`);
  `ReportController::lampiran()` serve berotorisasi (pemilik/dinas, else 403); route
  `reports.lampiran`; `Report` fillable + `lampiran`.
- Frontend: input file + `enctype` di `reports/create.blade`; link unduh di index & dinas show.
- Authz: cek pemilik-atau-dinas (mirror `PengajuanController::dokumen`).
- Test: `Pbi17ReportLampiranTest` (privat; owner 200 / other 403 / dinas 200).

### PBI-19 — Riwayat Status Verifikasi (PARTIAL → COMPLETE)
- Backend: `VerificationController::verify/reject` set `verified_at`; `User` fillable + cast.
- Frontend: `profile/show.blade` tampil tanggal diproses + alasan penolakan.
- Test: `Pbi19VerifiedAtTest` (verified_at tercatat; alasan tampil).

### PBI-20 — Timeline Status Pengajuan (PARTIAL → COMPLETE)
- Backend: pakai ulang `reviewed_at` (PBI-5).
- Frontend: mini-timeline (Diajukan → Disetujui/Ditolak / Menunggu) di `umkm/pengajuan/index.blade`.
- Test: `Pbi20TimelineTest` (timeline tampil tahap diajukan + keputusan).

## File diubah (ringkas)
Controllers: `Program, Pengajuan, ReportReview, Report, Umkm, Verification, Event`.
Models: `Pengajuan, Report, UmkmProfile, User`.
Routes: `routes/web.php` (program show + reports.lampiran).
Views: `dinas/program/show` (baru), `dinas/program/index`, `dinas/pengajuan/show`,
`dinas/report/show`, `umkm/pengajuan/index`, `umkm/event`, `umkm/profile/{edit,show}`,
`umkm/reports/{create,index}`.
Tests baru: `tests/Feature/Pbi{4,5,6,8,10,11,17,19,20}*.php`.

## Verifikasi
- `php artisan test --testsuite=Feature` → 50 lulus.
- `./vendor/bin/pint --test` → pass.
- Catatan: `EvaluationController` (PBI-30) tetap stub bawaan repo — di luar scope, tidak disentuh.
