<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Region;
use App\Models\Scale;
use Illuminate\Database\Seeder;

class UmkmDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Kategori Usaha
        $categories = [
            'Kuliner (Makanan & Minuman)',
            'Fashion & Pakaian',
            'Kriya / Kerajinan Tangan',
            'Agrobisnis & Pertanian',
            'Jasa & Layanan',
            'Perdagangan / Retail',
            'Kecantikan & Kesehatan',
            'Teknologi / Digital',
            'Lainnya',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }

        // 2. Wilayah Usaha (Kecamatan di Kabupaten Bandung)
        $regions = [
            'Arjasari', 'Baleendah', 'Banjaran', 'Bojongsoang', 'Cangkuang',
            'Cicalengka', 'Cikancung', 'Cilengkrang', 'Cileunyi', 'Cimaung',
            'Cimenyan', 'Ciparay', 'Ciwidey', 'Dayeuhkolot', 'Ibun',
            'Katapang', 'Kertasari', 'Kutawaringin', 'Majalaya', 'Margaasih',
            'Margahayu', 'Nagreg', 'Pacet', 'Pameungpeuk', 'Pangalengan',
            'Paseh', 'Pasirjambu', 'Rancabali', 'Rancaekek', 'Solokanjeruk',
            'Soreang',
        ];

        foreach ($regions as $region) {
            Region::firstOrCreate(['name' => $region]);
        }

        // 3. Skala Usaha
        $scales = [
            'Usaha Mikro (Modal usaha < Rp 1 Miliar)',
            'Usaha Kecil (Modal usaha Rp 1 Miliar - Rp 5 Miliar)',
            'Usaha Menengah (Modal usaha Rp 5 Miliar - Rp 10 Miliar)',
            'Usaha Besar (Modal usaha > Rp 10 Miliar)',
        ];

        foreach ($scales as $scale) {
            Scale::firstOrCreate(['name' => $scale]);
        }
    }
}
