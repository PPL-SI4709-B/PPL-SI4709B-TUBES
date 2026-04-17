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

## Final Rule

- Do exactly what PBI says
- Do not add features outside scope
- Keep code simple
