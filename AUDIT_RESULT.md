# AUDIT_RESULT.md — PBI Completion Audit

Sistem Informasi Pembinaan dan Monitoring UMKM oleh Dinas.

Audit berbasis bukti terhadap 42 PBI (`BACKLOG_AUDIT_REFERENCE.md`). Setiap PBI diperiksa
terhadap routes/web.php, controller, model, migration, view, dan test.

Aturan status: **COMPLETE** = semua fitur inti ada; **PARTIAL** = sebagian ada; **MISSING** =
tidak ditemukan. Tidak menebak — bukti berupa file path nyata.

Catatan: PBI-37 tidak ada di spec (lompat 36 → 38). Total 42 PBI.

Tanggal audit: 2026-06-07.

---

> **⚠️ Catatan keterbaruan (2026-06-08):** Matriks asli dibuat pada HEAD lama. Repo kini di
> HEAD `ba71dda` yang **jauh lebih lengkap** (Event CRUD/registrasi/feedback, notifikasi, materi
> edukasi, laporan berkala, evaluasi, status-log sudah ada). Hanya **9 baris PARTIAL yang
> ditargetkan** (4,5,6,8,10,11,17,19,20) yang **diperbarui ke COMPLETE** di bawah ini setelah
> implementasi — lihat `IMPLEMENTATION_REPORT.md`. Baris MISSING lainnya kemungkinan sudah usang
> dan butuh re-audit penuh terhadap HEAD saat ini.

## Completion Matrix

| PBI | Status | Evidence / Gap |
|-----|--------|----------------|
| 1 Kategori | COMPLETE | `CategoryController` (resource), `…create_categories_table`, `tests/Browser/PBI1KategoriUsahaTest`. Tanpa soft-delete/status (opsional). |
| 2 Wilayah & Skala | COMPLETE | `Region/ScaleController`, `…regions/scales_table`, FK di `…umkm_profiles_table`, `PBI2…Test`. |
| 3 Reference dropdowns | COMPLETE | `AuthController::showRegisterStep2`, `umkm/register/step-2.blade`, `PBI3…Test`. |
| 4 Program CRUD | **COMPLETE** ✅ | +`ProgramController::show` + `dinas/program/show.blade` + route `dinas.program.show`. `Pbi4ProgramDetailTest`. |
| 5 Approval | **COMPLETE** ✅ | +kolom `pengajuans.reviewed_by/reviewed_at`, di-set saat approve/reject; riwayat di `dinas/pengajuan/show.blade`. `Pbi5PengajuanReviewTest`. |
| 6 Catatan pengajuan | **COMPLETE** ✅ | reject `notes` kini `required`; catatan tampil ke UMKM di `umkm/pengajuan/index.blade`. `Pbi6RejectNotesTest`. |
| 7 Verifikasi profil | COMPLETE | `VerificationController::verify/reject`, `users.verification_note`, `VerificationTest`. |
| 8 Review laporan | **COMPLETE** ✅ | +`reports.reviewed_by/reviewed_at` di-set saat review; tampil di `umkm/reports/index` & `dinas/report/show`. `Pbi8ReportReviewMetaTest`. |
| 9 Status laporan | PARTIAL | Hanya `pending/approved/rejected`. **Tanpa draft / submitted / reviewed.** |
| 10 Profil UMKM | **COMPLETE** ✅ | +kolom `umkm_profiles.logo` + upload (disk public) di `UmkmController::update`; tampil di profil. `Pbi10ProfileLogoTest`. |
| 11 Event list | **COMPLETE** ✅ | `EventController::index` + `?search=`/`?type=`; form di `umkm/event.blade`. `Pbi11EventSearchTest`. |
| 12 Event detail | COMPLETE | `EventController::show`, `umkm/eventdetail.blade`; jadwal/lokasi/kuota di `events`. |
| 13 Pengajuan | COMPLETE | `PengajuanController::store` + validasi, `PengajuanTest`. |
| 14 Upload dokumen | COMPLETE | simpan di disk privat + unduh via `pengajuan.dokumen`/`pendanaan.dokumen`, `DocumentAccessTest`. |
| 15 Riwayat & status pengajuan | COMPLETE | `PengajuanController::umkmIndex`, `umkm/pengajuan/index.blade`. |
| 16 Registrasi | PARTIAL | Register 3-langkah (`AuthController`). **Tanpa aktivasi akun / verifikasi email.** |
| 17 Kirim laporan | **COMPLETE** ✅ | +kolom `reports.lampiran` upload (disk privat) + serve berotorisasi `reports.lampiran`. `Pbi17ReportLampiranTest`. |
| 18 Hasil review laporan | COMPLETE | `umkm/reports/index.blade` status + `catatan_petugas`. |
| 19 Status verifikasi | **COMPLETE** ✅ | +kolom `users.verified_at` di-set saat verify/reject; tanggal + alasan di `umkm/profile/show.blade`. `Pbi19VerifiedAtTest`. |
| 20 Tracking status pengajuan | **COMPLETE** ✅ | mini-timeline (Diajukan→keputusan) pakai `reviewed_at` di `umkm/pengajuan/index.blade`. `Pbi20TimelineTest`. |
| 21 Dashboard UMKM | COMPLETE | `DashboardController::umkm` (total + recent pengajuan/laporan/pendanaan). |
| 22 Form pendanaan | COMPLETE | `PengajuanPendanaanController::create/store` + validasi lengkap. |
| 23 Master sumber pendanaan | COMPLETE | `SumberPendanaanController` (resource), `…sumber_pendanaans_table`. |
| 24 Verifikasi pendanaan | COMPLETE | `DinasPendanaanVerifikasiController::approve/reject` (status-guarded). |
| 25 Dashboard Dinas lanjutan | PARTIAL | `DashboardController::dinas` hanya counts dasar. **Tanpa monitoring lanjutan.** |
| 26 Export data | MISSING | Tidak ada kode export/excel/csv/pdf. |
| 27 Dashboard UMKM ringkasan | COMPLETE | Sama dengan PBI-21 (`DashboardController::umkm`). |
| 28 CRUD Event by Dinas | MISSING | Tidak ada route/controller event dinas; event hanya di-seed. |
| 29 Pendaftaran event | MISSING | Tidak ada model/route/tabel registrasi. |
| 30 Evaluasi laporan | PARTIAL | Review dasar dipakai ulang (`ReportReviewController`). Tanpa evaluasi terstruktur. |
| 31 Riwayat event UMKM | MISSING | Tidak ada fitur riwayat event. |
| 32 Feedback event | MISSING | Tidak ada model/route feedback. |
| 33 Info & panduan | MISSING | Hanya `components/help-banner.blade`; tanpa halaman panduan. |
| 34 Laporan berkala | PARTIAL | Hanya laporan dasar; tanpa struktur berkala. |
| 35 Grafik omzet | MISSING | Tidak ada chart/grafik/omzet. |
| 36 Draft laporan | MISSING | Tidak ada status/alur draft. |
| 38 CRUD materi edukasi | MISSING | Tidak ada model/controller/tabel edukasi. |
| 39 Akses materi edukasi | MISSING | Bergantung PBI-38; tidak ada. |
| 40 Notifikasi in-app (Dinas) | MISSING | Tidak ada tabel/fitur notifikasi (trait Notifiable tak terpakai). |
| 41 Notifikasi/riwayat UMKM | MISSING | Sama; tidak ada. |
| 42 Timeline pendanaan | MISSING | Hanya status badge (`pendanaan/show.blade`); tanpa timeline. |
| 43 FAQ & bantuan | MISSING | Tidak ada halaman/route FAQ. |

---

## Missing Features

- Export / reporting (PDF/Excel) — PBI-26.
- Lifecycle Event oleh Dinas: CRUD, pendaftaran, riwayat, feedback — PBI-28,29,31,32.
- Modul Materi Edukasi (CRUD + akses) — PBI-38,39.
- Notifikasi in-app (Dinas + UMKM) — PBI-40,41.
- Chart / analitik omzet — PBI-35.
- Laporan draft + berkala + status lifecycle (draft/submitted/reviewed) — PBI-9,34,36.
- Halaman statis: FAQ/panduan — PBI-33,43.
- Timeline status (pengajuan + pendanaan) — PBI-20,42.
- Upload logo profil — PBI-10; lampiran laporan — PBI-17; aktivasi akun — PBI-16.
- Audit/riwayat trail: approval, review, verifikasi — PBI-5,8,19.

## Technical Debt

- Tanpa service/repository layer (semua logika di controller) — wajar untuk MVP, tapi logika
  approval/review kini terduplikasi di `PengajuanController` / `DinasPendanaanVerifikasiController`.
- Nilai enum mati `menunggu_verifikasi`,`diproses` pada `pengajuan_pendanaans.status`.
- Tanpa kelas Policy/Gate — authz mengandalkan `role` middleware inline + cek `user_id` manual.
- Model reference (Category/Region/Scale) tipis — tanpa soft-delete/status walau diminta spec.
- Test menutup happy path + guard baru; area besar (event, master-data CRUD) belum punya feature
  test (hanya Dusk untuk PBI-1/2/3).

## Security Findings

- **Critical**: tidak ada.
- **High** (sudah diperbaiki sesi ini): upload dokumen tadinya di disk public → kini privat +
  route serve berotorisasi; `APP_KEY` dusk yang ter-commit telah dirotasi.
- **Medium**: tanpa Policy layer — authz mengandalkan cek inline; mudah terlewat di endpoint baru.
  `MasterDataController` + CRUD reference tanpa test per-aksi.
- **Low**: `APP_KEY` dusk lama masih ada di git history (perlu history scrub untuk remediasi
  penuh); tanpa rate-limit di login.

## Final Completion

| Status | Jumlah | Bobot | Skor |
|--------|--------|-------|------|
| COMPLETE | 14 | 100% | 1400 |
| PARTIAL | 14 | 50% | 700 |
| MISSING | 14 | 0% | 0 |
| **Total** | **42** | | **2100 / 4200** |

**Overall completion = 50%.**

Per sprint: Sprint 1 (PBI 1–21) kuat (mayoritas COMPLETE/PARTIAL); Sprint 2 (22–43) mayoritas
MISSING kecuali grup pendanaan (22,23,24,27).

---

*Bukti file path di atas dapat diverifikasi langsung. `php artisan test` → 21 lulus.
`php artisan route:list` mengonfirmasi route absen untuk PBI MISSING.*
