<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Program;
use App\Models\Region;
use App\Models\Scale;
use App\Models\SumberPendanaan;
use Illuminate\Database\Seeder;

class ReferenceDataSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Kuliner',
            'Fashion & Tekstil',
            'Kerajinan & Kriya',
            'Pertanian & Perkebunan',
            'Peternakan',
            'Perikanan',
            'Jasa & Perdagangan',
            'Teknologi & Digital',
            'Kesehatan & Kecantikan',
            'Pendidikan & Pelatihan',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }

        $regions = [
            'Baleendah',
            'Bojongsoang',
            'Banjaran',
            'Ciparay',
            'Ciwidey',
            'Cikancung',
            'Cilengkrang',
            'Cileunyi',
            'Cimenyan',
            'Cicalengka',
            'Katapang',
            'Kutawaringin',
            'Majalaya',
            'Margaasih',
            'Margahayu',
            'Nagreg',
            'Pacet',
            'Pangalengan',
            'Parongpong',
            'Pasirjambu',
            'Pameungpeuk',
            'Rancabali',
            'Rancaekek',
            'Solokanjeruk',
            'Soreang',
            'Ibun',
            'Arjasari',
            'Kertasari',
            'Dayeuhkolot',
            'Lembang',
            'Padalarang',
        ];

        foreach ($regions as $name) {
            Region::firstOrCreate(['name' => $name]);
        }

        $scales = [
            'Mikro',
            'Kecil',
            'Menengah',
        ];

        foreach ($scales as $name) {
            Scale::firstOrCreate(['name' => $name]);
        }

        $programs = [
            [
                'name' => 'Bantuan Modal Usaha Mikro',
                'jenis' => 'pendanaan',
                'description' => 'Program bantuan permodalan bagi UMKM mikro untuk pengembangan usaha.',
                'quota' => 50,
                'status' => 'active',
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonths(3)->toDateString(),
            ],
            [
                'name' => 'Subsidi Peralatan Produksi',
                'jenis' => 'pendanaan',
                'description' => 'Bantuan dana pembelian peralatan produksi untuk UMKM yang memenuhi syarat.',
                'quota' => 30,
                'status' => 'active',
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonths(3)->toDateString(),
            ],
            [
                'name' => 'Pelatihan Digitalisasi UMKM',
                'jenis' => 'pembinaan',
                'description' => 'Program pelatihan transformasi digital untuk pelaku UMKM Kabupaten Bandung.',
                'quota' => 100,
                'status' => 'active',
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonths(2)->toDateString(),
            ],
            [
                'name' => 'Fasilitasi Sertifikasi Halal',
                'jenis' => 'pembinaan',
                'description' => 'Pendampingan dan subsidi biaya sertifikasi halal untuk produk UMKM.',
                'quota' => 30,
                'status' => 'active',
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonths(4)->toDateString(),
            ],
            [
                'name' => 'Akses Pasar & Pameran Produk',
                'jenis' => 'pembinaan',
                'description' => 'Fasilitasi keikutsertaan UMKM dalam pameran lokal dan nasional.',
                'quota' => 25,
                'status' => 'active',
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonth()->toDateString(),
            ],
        ];

        foreach ($programs as $data) {
            Program::firstOrCreate(['name' => $data['name']], $data);
        }

        // PBI-23: Sumber Pendanaan
        SumberPendanaan::firstOrCreate(['nama_program' => 'Rekomendasi Pendanaan UMKM'], [
            'mitra_penyalur' => 'BPR Kerta Raharja',
            'batas_maksimal' => 6000000,
            'deskripsi' => 'Skema rekomendasi pendanaan UMKM melalui BPR Kerta Raharja. Dinas memberikan surat rekomendasi/persetujuan untuk diteruskan oleh UMKM kepada pihak bank.',
            'persyaratan' => 'Profil UMKM terverifikasi, memiliki pengajuan pendanaan, dan memenuhi kelayakan awal dari Dinas.',
            'status' => 'aktif',
        ]);
    }
}
