# DOKUMENTASI SISTEM — SIP UMKM Kabupaten Bandung

Sistem Informasi Pemberdayaan (SIP) UMKM berbasis web untuk manajemen data, pengajuan program, verifikasi, dan pelaporan UMKM di Kabupaten Bandung.

---

## 1. DATABASE SCHEMA

### Diagram Relasi

```
users
  ├── hasOne  → umkm_profiles
  ├── hasMany → pengajuans
  └── hasMany → reports

umkm_profiles
  ├── belongsTo → users
  ├── belongsTo → categories
  ├── belongsTo → regions
  └── belongsTo → scales

programs
  └── hasMany → pengajuans

pengajuans
  ├── belongsTo → users
  └── belongsTo → programs

events         (standalone, dikelola Dinas)
categories     (master data)
regions        (master data)
scales         (master data)
```

---

### Tabel: `users`

| Kolom              | Tipe      | Constraint              | Keterangan                          |
|--------------------|-----------|-------------------------|-------------------------------------|
| id                 | bigint    | PK, auto-increment      |                                     |
| name               | string    | NOT NULL                | Nama lengkap                        |
| email              | string    | UNIQUE, NOT NULL        |                                     |
| email_verified_at  | timestamp | nullable                |                                     |
| password           | string    | NOT NULL                | Bcrypt hash                         |
| role               | string    | default: `umkm`         | `umkm` / `dinas`                    |
| profile_status     | string    | default: `pending`      | `pending` / `verified` / `rejected` |
| remember_token     | string    | nullable                |                                     |
| created_at         | timestamp |                         |                                     |
| updated_at         | timestamp |                         |                                     |

---

### Tabel: `umkm_profiles`

| Kolom            | Tipe    | Constraint                          | Keterangan          |
|------------------|---------|-------------------------------------|---------------------|
| id               | bigint  | PK, auto-increment                  |                     |
| user_id          | bigint  | FK → users(id), UNIQUE, CASCADE DEL |                     |
| business_name    | string  | NOT NULL                            | Nama usaha          |
| phone            | string  | nullable                            | No. HP/WhatsApp     |
| nib              | string  | nullable                            | Nomor Induk Berusaha|
| business_address | text    | NOT NULL                            | Alamat usaha        |
| category_id      | bigint  | FK → categories(id), nullable, NULL | Kategori usaha      |
| region_id        | bigint  | FK → regions(id), nullable, NULL    | Wilayah usaha       |
| scale_id         | bigint  | FK → scales(id), nullable, NULL     | Skala usaha         |
| created_at       | timestamp |                                   |                     |
| updated_at       | timestamp |                                   |                     |

---

### Tabel: `programs`

| Kolom       | Tipe    | Constraint                                | Keterangan              |
|-------------|---------|-------------------------------------------|-------------------------|
| id          | bigint  | PK, auto-increment                        |                         |
| name        | string  | NOT NULL                                  | Nama program            |
| jenis       | enum    | `pendanaan`, `pembinaan`, default: `pembinaan` | Jenis program      |
| description | text    | nullable                                  |                         |
| quota       | uint    | default: 0                                | Kuota peserta           |
| start_date  | date    | nullable                                  |                         |
| end_date    | date    | nullable                                  |                         |
| status      | enum    | `active`, `inactive`, default: `active`   |                         |
| created_at  | timestamp |                                         |                         |
| updated_at  | timestamp |                                         |                         |

---

### Tabel: `pengajuans`

| Kolom              | Tipe      | Constraint                              | Keterangan                          |
|--------------------|-----------|-----------------------------------------|-------------------------------------|
| id                 | bigint    | PK, auto-increment                      |                                     |
| user_id            | bigint    | FK → users(id), CASCADE DEL             |                                     |
| program_id         | bigint    | FK → programs(id), nullable, SET NULL   |                                     |
| jenis              | enum      | `pendanaan`, `pembinaan`                | Dari program.jenis saat store       |
| kebutuhan_usaha    | text      | NOT NULL                                | Deskripsi kebutuhan                 |
| dokumen_pendukung  | string    | nullable                                | Path file (storage/public)          |
| status             | enum      | `pending`, `approved`, `rejected`       | default: `pending`                  |
| notes              | text      | nullable                                | Catatan petugas saat approve/reject |
| created_at         | timestamp |                                         |                                     |
| updated_at         | timestamp |                                         |                                     |

---

### Tabel: `reports`

| Kolom           | Tipe      | Constraint                  | Keterangan                        |
|-----------------|-----------|-----------------------------|-----------------------------------|
| id              | bigint    | PK, auto-increment          |                                   |
| user_id         | bigint    | FK → users(id), CASCADE DEL |                                   |
| judul           | string    | NOT NULL                    | Judul laporan                     |
| deskripsi       | text      | NOT NULL                    | Isi laporan                       |
| status          | string    | default: `pending`          | `pending` / `reviewed`            |
| catatan_petugas | text      | nullable                    | Feedback dari petugas             |
| created_at      | timestamp |                             |                                   |
| updated_at      | timestamp |                             |                                   |

---

### Tabel: `events`

| Kolom       | Tipe      | Constraint                              | Keterangan                            |
|-------------|-----------|-----------------------------------------|---------------------------------------|
| id          | bigint    | PK, auto-increment                      |                                       |
| title       | string    | NOT NULL                                | Judul event                           |
| description | text      | nullable                                |                                       |
| location    | string    | NOT NULL                                |                                       |
| event_date  | dateTime  | NOT NULL                                |                                       |
| quota       | uint      | NOT NULL                                | Kapasitas peserta                     |
| type        | string    | default: `pelatihan`                    | `bootcamp`, `pelatihan`, `seminar`, dll|
| status      | enum      | `active`, `inactive`, default: `active` |                                       |
| created_at  | timestamp |                                         |                                       |
| updated_at  | timestamp |                                         |                                       |

---

### Tabel Master Data

#### `categories`
| Kolom       | Tipe      | Constraint     |
|-------------|-----------|----------------|
| id          | bigint    | PK             |
| name        | string    | UNIQUE         |
| description | text      | nullable       |
| created_at  | timestamp |                |
| updated_at  | timestamp |                |

#### `regions`
| Kolom       | Tipe      | Constraint     |
|-------------|-----------|----------------|
| id          | bigint    | PK             |
| name        | string    | UNIQUE         |
| description | text      | nullable       |
| created_at  | timestamp |                |
| updated_at  | timestamp |                |

#### `scales`
| Kolom       | Tipe      | Constraint     |
|-------------|-----------|----------------|
| id          | bigint    | PK             |
| name        | string    | UNIQUE         |
| description | text      | nullable       |
| created_at  | timestamp |                |
| updated_at  | timestamp |                |

---

## 2. API / ROUTE FLOW

Sistem menggunakan HTTP routes berbasis Laravel (web routes, bukan REST API). Semua endpoint menggunakan session-based auth.

### Auth Routes

| Method | URI                     | Controller                        | Middleware | Keterangan                        |
|--------|-------------------------|-----------------------------------|------------|-----------------------------------|
| GET    | `/`                     | closure (redirect)                | -          | Redirect ke dashboard sesuai role |
| GET    | `/login`                | AuthController@showLogin          | guest      |                                   |
| POST   | `/login`                | AuthController@processLogin       | guest      |                                   |
| POST   | `/logout`               | AuthController@logout             | auth       |                                   |

### Registrasi UMKM (Multi-step)

| Method | URI                          | Controller                             | Middleware | Keterangan                         |
|--------|------------------------------|----------------------------------------|------------|------------------------------------|
| GET    | `/umkm/register/step-1`      | closure (view)                         | guest      | Form data akun                     |
| POST   | `/umkm/register/step-1`      | AuthController@processRegisterStep1    | guest      | Validasi + simpan ke session       |
| GET    | `/umkm/register/step-2`      | AuthController@showRegisterStep2       | guest      | Form data usaha                    |
| POST   | `/umkm/register/step-2`      | AuthController@processRegisterStep2    | guest      | Validasi + simpan ke session       |
| GET    | `/umkm/register/step-3`      | AuthController@showRegisterStep3       | guest      | Halaman konfirmasi + summary       |
| POST   | `/umkm/register/step-3`      | AuthController@processRegisterStep3    | guest      | Buat user + umkm_profile di DB     |

### UMKM Routes

| Method | URI                     | Controller                        | Middleware       | Keterangan                          |
|--------|-------------------------|-----------------------------------|------------------|-------------------------------------|
| GET    | `/umkm/dashboard`       | DashboardController@umkm          | auth, role:umkm  |                                     |
| GET    | `/umkm/profile`         | UmkmController@show               | auth, role:umkm  | Detail profil usaha                 |
| GET    | `/umkm/profile/edit`    | UmkmController@edit               | auth, role:umkm  | Form edit profil                    |
| PUT    | `/umkm/profile`         | UmkmController@update             | auth, role:umkm  | Update profil + umkm_profile        |
| GET    | `/umkm/pengajuan`       | PengajuanController@umkmIndex     | auth, role:umkm  | Riwayat pengajuan pendanaan         |
| POST   | `/umkm/pengajuan`       | PengajuanController@store         | auth, role:umkm  | Submit pengajuan baru               |
| GET    | `/umkm/event`           | EventController@index             | auth, role:umkm  | Gallery event & pelatihan           |
| GET    | `/umkm/event/{event}`   | EventController@show              | auth, role:umkm  | Detail event                        |
| GET    | `/reports`              | ReportController@index            | auth, role:umkm  | Riwayat laporan usaha               |
| GET    | `/reports/create`       | ReportController@create           | auth, role:umkm  | Form laporan baru                   |
| POST   | `/reports`              | ReportController@store            | auth, role:umkm  | Submit laporan                      |

### Dinas Routes

| Method | URI                                  | Controller                            | Middleware        | Keterangan                        |
|--------|--------------------------------------|---------------------------------------|-------------------|-----------------------------------|
| GET    | `/dinas/dashboard`                   | DashboardController@dinas             | auth, role:dinas  |                                   |
| GET    | `/dinas/master-data`                 | MasterDataController@index            | auth, role:dinas  | Unified: category/region/scale    |
| GET    | `/dinas/verification`                | VerificationController@index          | auth, role:dinas  | Daftar UMKM pending verifikasi    |
| PUT    | `/dinas/verification/{user}/verify`  | VerificationController@verify         | auth, role:dinas  | Setujui UMKM                      |
| PUT    | `/dinas/verification/{user}/reject`  | VerificationController@reject         | auth, role:dinas  | Tolak UMKM                        |
| GET    | `/dinas/program`                     | ProgramController@index               | auth, role:dinas  | Daftar program                    |
| GET    | `/dinas/program/create`              | ProgramController@create              | auth, role:dinas  |                                   |
| POST   | `/dinas/program`                     | ProgramController@store               | auth, role:dinas  |                                   |
| GET    | `/dinas/program/{program}/edit`      | ProgramController@edit                | auth, role:dinas  |                                   |
| PUT    | `/dinas/program/{program}`           | ProgramController@update              | auth, role:dinas  |                                   |
| DELETE | `/dinas/program/{program}`           | ProgramController@destroy             | auth, role:dinas  |                                   |
| GET    | `/dinas/pengajuan`                   | PengajuanController@index             | auth, role:dinas  | Semua pengajuan                   |
| GET    | `/dinas/pengajuan/{pengajuan}`       | PengajuanController@show              | auth, role:dinas  | Detail + approve/reject form      |
| PUT    | `/dinas/pengajuan/{pengajuan}/approve`| PengajuanController@approve          | auth, role:dinas  |                                   |
| PUT    | `/dinas/pengajuan/{pengajuan}/reject` | PengajuanController@reject           | auth, role:dinas  |                                   |
| GET    | `/dinas/report`                      | ReportReviewController@index          | auth, role:dinas  | Daftar laporan UMKM               |
| GET    | `/dinas/report/{report}`             | ReportReviewController@show           | auth, role:dinas  | Detail laporan                    |
| PUT    | `/dinas/report/{report}`             | ReportReviewController@update         | auth, role:dinas  | Tambah catatan petugas            |
| CRUD   | `/dinas/category`                    | CategoryController (resource)         | auth, role:dinas  | Kelola kategori (via master-data) |
| CRUD   | `/dinas/region`                      | RegionController (resource)           | auth, role:dinas  | Kelola wilayah (via master-data)  |
| CRUD   | `/dinas/scale`                       | ScaleController (resource)            | auth, role:dinas  | Kelola skala usaha (via master-data)|

---

## 3. UI FLOW

### A. Alur UMKM

```
[/login]
    │
    ▼ (login berhasil, role=umkm)
[/umkm/dashboard]
    ├── Sidebar: Beranda         → /umkm/dashboard
    ├── Sidebar: Profil Usaha   → /umkm/profile
    │       └── Edit Profil     → /umkm/profile/edit → PUT /umkm/profile
    ├── Sidebar: Pengajuan      → /umkm/pengajuan
    │       └── Modal Ajukan    → POST /umkm/pengajuan
    ├── Sidebar: Event & Pelatihan → /umkm/event (gallery grid)
    │       └── Lihat Detail    → /umkm/event/{id}
    └── Sidebar: Laporan        → /reports
            ├── Buat Laporan    → /reports/create → POST /reports
            └── Lihat riwayat
```

#### Registrasi UMKM (Multi-step Wizard)

```
[/umkm/register/step-1]  →  Form: nama, email, no HP, password, konfirmasi
    │ POST (simpan ke session)
    ▼
[/umkm/register/step-2]  →  Form: nama usaha, kategori, wilayah, alamat, NIB (opsional), skala
    │ POST (simpan ke session)
    ▼
[/umkm/register/step-3]  →  Konfirmasi summary data akun + usaha, checkbox pernyataan
    │ POST (buat User + UmkmProfile di DB, login otomatis)
    ▼
[/umkm/dashboard]
```

#### Status Banner Dashboard UMKM

| `profile_status` | Banner yang muncul                                    |
|------------------|-------------------------------------------------------|
| `pending`        | "Akun menunggu verifikasi" + link → Profil            |
| `verified`       | Tidak ada banner (akses penuh)                        |
| `rejected`       | "Akun ditolak, silahkan edit profil" + link → Edit    |

---

### B. Alur Petugas Dinas

```
[/login]
    │
    ▼ (login berhasil, role=dinas)
[/dinas/dashboard]
    ├── Sidebar: Beranda             → /dinas/dashboard
    ├── Sidebar: Verifikasi UMKM    → /dinas/verification
    │       └── Tombol Verifikasi   → PUT /dinas/verification/{user}/verify
    │       └── Tombol Tolak        → PUT /dinas/verification/{user}/reject
    ├── Sidebar: Kelola Program     → /dinas/program
    │       ├── Tambah Program      → /dinas/program/create → POST
    │       ├── Edit Program        → /dinas/program/{id}/edit → PUT
    │       └── Hapus Program       → DELETE /dinas/program/{id}
    ├── Sidebar: Approval Pengajuan → /dinas/pengajuan
    │       └── Detail Pengajuan    → /dinas/pengajuan/{id}
    │               ├── Setujui     → PUT /dinas/pengajuan/{id}/approve
    │               └── Tolak       → PUT /dinas/pengajuan/{id}/reject
    ├── Sidebar: Review Laporan     → /dinas/report
    │       └── Detail Laporan      → /dinas/report/{id} → PUT (tambah catatan)
    └── Sidebar: Master Data        → /dinas/master-data (tab: Kategori / Wilayah / Skala)
            ├── Tambah              → /dinas/{category|region|scale}/create → POST
            ├── Edit                → /dinas/{category|region|scale}/{id}/edit → PUT
            └── Hapus               → DELETE /dinas/{category|region|scale}/{id}
```

---

## 4. BISNIS FLOW

### A. Registrasi & Verifikasi UMKM

```
UMKM mengisi form registrasi 3 langkah
    │
    ▼
User dibuat dengan role=umkm, profile_status=pending
UmkmProfile dibuat dengan data usaha
    │
    ▼
Dashboard UMKM tampil banner "Menunggu Verifikasi"
UMKM tidak dapat mengajukan program sampai diverifikasi
    │
    ▼
Petugas Dinas melihat daftar UMKM pending di /dinas/verification
    │
    ├── [Verifikasi] → profile_status = 'verified'
    │       UMKM dapat login & mengajukan program
    │
    └── [Tolak] → profile_status = 'rejected'
            UMKM melihat banner merah, diarahkan edit profil
            UMKM edit profil → profile_status kembali 'pending'
            Petugas re-verifikasi
```

**Aturan bisnis:**
- UMKM dengan `profile_status != 'verified'` diblokir dari form pengajuan
- Edit profil yang sudah rejected mengembalikan status ke `pending` untuk re-review

---

### B. Pengajuan Program Pendanaan

```
UMKM membuka halaman Pengajuan (hanya program pendanaan)
    │
    ▼ (cek: profile_status === 'verified' AND programs pendanaan aktif ada)
Modal pengajuan terbuka
    │
    ▼
UMKM pilih program, isi kebutuhan usaha, upload dokumen (opsional)
    │ POST /umkm/pengajuan
    ▼
Pengajuan dibuat: status=pending, jenis diambil dari program.jenis
    │
    ▼
Petugas Dinas review di /dinas/pengajuan → /dinas/pengajuan/{id}
    │
    ├── [Setujui] → status = 'approved', notes (opsional)
    └── [Tolak]   → status = 'rejected', notes (opsional)
            │
            ▼
UMKM melihat status terbaru di tabel riwayat pengajuan
```

**Aturan bisnis:**
- `jenis` pada pengajuan selalu mengikuti `program.jenis`, tidak dari input form
- UMKM yang belum verified mendapat redirect dengan pesan error
- Setiap UMKM dapat mengajukan lebih dari satu program

---

### C. Pengelolaan Program Pembinaan

```
Petugas Dinas buat program di /dinas/program
    │  (jenis: pendanaan / pembinaan, status: active/inactive)
    ▼
Program aktif tampil sebagai pilihan pengajuan UMKM (khusus pendanaan)
Program pembinaan dikelola Dinas sebagai data internal
    │
    ▼
Petugas dapat edit (ubah nama, kuota, tanggal, status) dan hapus program
```

---

### D. Event & Pelatihan

```
Petugas Dinas kelola event (dari database/seeder atau panel admin masa depan)
    │  Event: title, type, location, event_date, quota, status=active
    ▼
UMKM melihat gallery event di /umkm/event
    │  Grid 3 kolom, tiap card: type badge, judul, tanggal, lokasi, kuota
    ▼
UMKM klik "Lihat Detail" → /umkm/event/{id}
    (informasi lengkap event, tidak ada pendaftaran online di MVP)
```

---

### E. Laporan Perkembangan Usaha

```
UMKM mengisi laporan di /reports/create
    │  Field: judul, deskripsi
    ▼
Laporan dibuat: status=pending
    │
    ▼
Petugas Dinas review di /dinas/report → /dinas/report/{id}
    │
    ▼
Petugas tambah catatan → status diperbarui ke 'reviewed'
    │
    ▼
UMKM melihat status & catatan petugas di riwayat laporan
```

---

### F. Pengelolaan Master Data

```
Petugas Dinas akses /dinas/master-data
    │  Tiga tab: Kategori Usaha | Wilayah | Skala Usaha
    ▼
CRUD masing-masing (nama + deskripsi)
    │
    ▼
Data master digunakan sebagai dropdown pada:
    - Registrasi UMKM Step-2 (kategori, wilayah, skala)
    - Edit profil UMKM
    - Tampilan profil & laporan
```

---

## 5. STATUS & ENUM REFERENCE

| Entitas        | Field            | Nilai yang Valid                         |
|----------------|------------------|------------------------------------------|
| User           | `role`           | `umkm`, `dinas`                          |
| User           | `profile_status` | `pending`, `verified`, `rejected`        |
| Program        | `jenis`          | `pendanaan`, `pembinaan`                 |
| Program        | `status`         | `active`, `inactive`                     |
| Pengajuan      | `jenis`          | `pendanaan`, `pembinaan`                 |
| Pengajuan      | `status`         | `pending`, `approved`, `rejected`        |
| Report         | `status`         | `pending`, `reviewed`                    |
| Event          | `status`         | `active`, `inactive`                     |
| Event          | `type`           | `bootcamp`, `pelatihan`, `seminar`, `workshop`, dll |

---

## 6. MIDDLEWARE & AKSES KONTROL

| Middleware   | Deskripsi                                            |
|--------------|------------------------------------------------------|
| `auth`       | Wajib login (redirect ke `/login` jika belum)        |
| `guest`      | Hanya untuk tamu (redirect ke dashboard jika sudah login) |
| `role:umkm`  | Hanya untuk user dengan `role = 'umkm'`             |
| `role:dinas` | Hanya untuk user dengan `role = 'dinas'`            |

`RoleMiddleware` melakukan pengecekan `Auth::user()->role !== $role` dan redirect ke dashboard sesuai role jika akses ditolak.

---

## 7. FILE STORAGE

File `dokumen_pendukung` pada pengajuan disimpan di:

```
storage/app/public/dokumen_pengajuan/{filename}
```

Diakses via symlink: `public/storage/dokumen_pengajuan/{filename}`

Jalankan `php artisan storage:link` untuk membuat symlink jika belum ada.

---

*Dokumentasi ini dibuat berdasarkan state codebase per 2026-05-11.*
