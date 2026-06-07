# BACKLOG_AUDIT_REFERENCE.md

## Project Overview

Sistem Informasi Pembinaan dan Monitoring UMKM oleh Dinas.

Tujuan audit:

1. Memverifikasi implementasi seluruh Product Backlog Item (PBI).
2. Mengidentifikasi fitur yang Complete, Partial, atau Missing.
3. Mengidentifikasi gap antara backlog dan implementasi.
4. Mengidentifikasi technical debt.
5. Mengidentifikasi risiko keamanan dan kualitas kode.

---

# Audit Rules

Untuk setiap PBI lakukan pemeriksaan:

* Route
* Controller
* Service
* Repository
* Model
* Migration
* Validation
* Policy / Authorization
* Frontend Page
* API Endpoint
* Feature Test
* Unit Test

Status harus salah satu:

* COMPLETE
* PARTIAL
* MISSING

Jangan menebak.

Semua status harus memiliki evidence berupa file path.

---

# Sprint 1

## Master Data Dasar UMKM

### PBI-1

Nama:
Mengelola Data Kategori Usaha

Expected Features:

* CRUD kategori usaha
* Validasi kategori
* Soft delete atau status aktif
* Daftar kategori usaha

---

### PBI-2

Nama:
Mengelola Data Wilayah dan Skala Usaha

Expected Features:

* CRUD wilayah
* CRUD skala usaha
* Relasi ke profil UMKM

---

### PBI-3

Nama:
Melihat Data Referensi Kategori, Wilayah, dan Skala Usaha Profil

Expected Features:

* Read only reference data
* Dropdown kategori
* Dropdown wilayah
* Dropdown skala usaha

---

## Core Program Pembinaan dan Approval

### PBI-4

Nama:
Mengelola Master Program Pembinaan dan Pendanaan

Expected Features:

* CRUD program
* Status program
* Periode program
* Detail program

---

### PBI-5

Nama:
Approval Pengajuan

Expected Features:

* Approve pengajuan
* Reject pengajuan
* Riwayat approval
* Update status

---

### PBI-6

Nama:
Menambahkan Catatan pada Pengajuan

User Story:
Sebagai Petugas Dinas, saya ingin menambahkan catatan pada pengajuan yang ditolak atau diproses agar UMKM mengetahui tindak lanjut pengajuannya.

Expected Features:

* Input catatan
* Catatan wajib saat ditolak
* Catatan saat diproses
* Riwayat catatan
* UMKM dapat melihat catatan

---

## Verifikasi dan Review Awal

### PBI-7

Nama:
Verifikasi Profil UMKM

Expected Features:

* Verifikasi profil
* Ubah status verifikasi
* Catatan verifikasi

---

### PBI-8

Nama:
Review Awal Terhadap Laporan Perkembangan Usaha

Expected Features:

* Review laporan
* Komentar reviewer
* Riwayat review

---

### PBI-9

Nama:
Mengubah Status Laporan Perkembangan

Expected Features:

* Draft
* Submitted
* Reviewed
* Rejected
* Approved

---

## Profil UMKM dan Informasi Event

### PBI-10

Nama:
Mengelola Profil Usaha Saya

Expected Features:

* CRUD profil UMKM
* Upload logo
* Data usaha
* Kontak usaha

---

### PBI-11

Nama:
Melihat Daftar Event dan Pameran Yang Tersedia

Expected Features:

* List event
* Search event
* Filter event

---

### PBI-12

Nama:
Melihat Detail Informasi Event dan Pameran

Expected Features:

* Detail event
* Jadwal
* Lokasi
* Kuota

---

## Pengajuan Program Pembinaan

### PBI-13

Nama:
Mengajukan Program Pendampingan Akses Layanan Pembiayaan

Expected Features:

* Form pengajuan
* Simpan pengajuan
* Validasi data

---

### PBI-14

Nama:
Mengunggah Dokumen Pendukung Pengajuan

Expected Features:

* Upload file
* Download file
* Validasi file

---

### PBI-15

Nama:
Melihat Riwayat dan Status Pengajuan Program

Expected Features:

* Riwayat pengajuan
* Tracking status
* Detail pengajuan

---

## Registrasi dan Pelaporan Dasar

### PBI-16

Melakukan Registrasi Akun dan Data Usaha

Expected Features:

* Registrasi akun
* Registrasi UMKM
* Aktivasi akun

---

### PBI-17

Mengirim Laporan Perkembangan Usaha

Expected Features:

* Form laporan
* Submit laporan
* Upload lampiran

---

### PBI-18

Melihat Hasil Review Awal Laporan Perkembangan

Expected Features:

* Hasil review
* Catatan reviewer

---

## Monitoring Dasar UMKM

### PBI-19

Melihat Status Verifikasi Profil Usaha Saya

Expected Features:

* Status verifikasi
* Riwayat verifikasi

---

### PBI-20

Melihat Perubahan Status Pengajuan Program Pembinaan

Expected Features:

* Tracking status
* Timeline status

---

### PBI-21

Melihat Ringkasan Pengajuan, Event, dan Laporan pada Halaman Utama

Expected Features:

* Dashboard UMKM
* Ringkasan pengajuan
* Ringkasan event
* Ringkasan laporan

---

# Sprint 2

## Master Data Lanjutan & Pengajuan Pendanaan

### PBI-22

Formulir Pengajuan Pendanaan UMKM

### PBI-23

Kelola Master Data Sumber Pendanaan

### PBI-24

Verifikasi dan Persetujuan Pengajuan Pendanaan

---

## Dashboard Monitoring & Reporting Dinas

### PBI-25

Dashboard Monitoring Lanjutan Dinas

### PBI-26

Laporan Rekap dan Export Data UMKM

### PBI-27

Dashboard UMKM dan Ringkasan Aktivitas

---

## Event, Pameran dan Pendaftaran UMKM

### PBI-28

CRUD Event dan Pelatihan oleh Dinas

### PBI-29

Pendaftaran Event oleh UMKM

### PBI-30

Evaluasi Laporan Perkembangan Usaha

---

## Riwayat dan Informasi Pendukung UMKM

### PBI-31

Riwayat Kegiatan Event UMKM

### PBI-32

Feedback dan Review Event oleh UMKM

### PBI-33

Halaman Informasi dan Panduan Penggunaan Sistem

---

## Laporan Perkembangan Usaha Lengkap

### PBI-34

Form Laporan Perkembangan Usaha Berkala

### PBI-35

Grafik Perkembangan Omzet UMKM

### PBI-36

Draft Laporan Perkembangan Usaha

---

## Materi Edukasi

### PBI-38

CRUD Materi Edukasi oleh Dinas

### PBI-39

Akses dan Unduh Materi Edukasi oleh UMKM

### PBI-40

Notifikasi In-App untuk Petugas Dinas

---

## Halaman Statis dan Pendukung Sistem

### PBI-41

Halaman Notifikasi dan Riwayat Status UMKM

### PBI-42

Timeline Perubahan Status Pengajuan Pendanaan

### PBI-43

Halaman FAQ dan Bantuan Penggunaan Sistem

---

# Expected Audit Output

Claude harus menghasilkan:

## Completion Matrix

| PBI   | Status   | Evidence                               |
| ----- | -------- | -------------------------------------- |
| PBI-1 | COMPLETE | routes/web.php, CategoryController.php |
| PBI-2 | PARTIAL  | ScaleController.php                    |
| PBI-3 | MISSING  | -                                      |

---

## Missing Features

Daftar seluruh fitur yang belum ditemukan.

---

## Technical Debt

Daftar technical debt berdasarkan codebase.

---

## Security Findings

* Critical
* High
* Medium
* Low

---

## Final Completion Percentage

Formula:

Complete = 100%
Partial = 50%
Missing = 0%

Tampilkan:

* Total Complete
* Total Partial
* Total Missing
* Overall Completion %
