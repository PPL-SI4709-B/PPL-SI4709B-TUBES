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
| #16 | Register | Fatih | ✅ Done | AuthController fully implemented |
| #10 | Profil UMKM | Avan | ✅ Done | UmkmController & views complete |
| #7 | Verifikasi UMKM | Bagas | ✅ Done | VerificationController complete |
| #13 | Pengajuan | Davi | ✅ Done | PengajuanController store method complete |
| #5 | Approval | Andika | ✅ Done | PengajuanController approve/reject methods complete |
| #15 | Status Pengajuan | Davi | ✅ Done | UMKM index view for Pengajuan complete |

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