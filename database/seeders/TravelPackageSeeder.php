<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TravelPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $travelPackages = [
            // Wisata Alam (Category 1)
            [
                'category_id' => 1,
                'name' => 'Paket Danau Toba 3H2M',
                'slug' => Str::slug('Paket Danau Toba 3H2M'),
                'duration' => '3 Hari 2 Malam',
                'location' => 'Medan - Parapat - Danau Toba',
                'description' => 'Nikmati keindahan Danau Toba yang mempesona dengan paket lengkap 3 hari 2 malam. Kunjungi Pulau Samosir, lihat pemandangan dari Bukit Holbung, dan rasakan keramahan budaya Batak.',
                'price' => 1250000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Paket Bukit Lawang 2H1M',
                'slug' => Str::slug('Paket Bukit Lawang 2H1M'),
                'duration' => '2 Hari 1 Malam',
                'location' => 'Medan - Bukit Lawang',
                'description' => 'Petualangan seru melihat orangutan di habitat aslinya di Taman Nasional Gunung Leuser. Trekking menyusuri hutan dan berenang di sungai yang jernih.',
                'price' => 850000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Paket Air Terjun Sipiso-piso 1 Hari',
                'slug' => Str::slug('Paket Air Terjun Sipiso-piso 1 Hari'),
                'duration' => '1 Hari',
                'location' => 'Medan - Kabupaten Karo',
                'description' => 'Wisata sehari menikmati keindahan Air Terjun Sipiso-piso yang jatuh dari ketinggian 120 meter. Dilengkapi dengan kunjungan ke Desa Lingga dan Pemandian Air Panas.',
                'price' => 350000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Wisata Kuliner (Category 2)
            [
                'category_id' => 2,
                'name' => 'Tour Kuliner Medan Malam',
                'slug' => Str::slug('Tour Kuliner Medan Malam'),
                'duration' => '1 Hari',
                'location' => 'Kota Medan',
                'description' => 'Jelajahi kekayaan kuliner khas Medan di malam hari. Mencicipi soto Medan, bika ambon, mie pangsit, dan berbagai street food legendaris di pusat kuliner Medan.',
                'price' => 250000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Paket Wisata Durian Ucok',
                'slug' => Str::slug('Paket Wisata Durian Ucok'),
                'duration' => '1 Hari',
                'location' => 'Kota Medan',
                'description' => 'Pengalaman menyantap durian Medan yang terkenal lezat. Kunjungi tempat durian legendaris Ucok dan mencoba berbagai varietas durian khas Sumatera Utara.',
                'price' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Kuliner Tradisional Batak',
                'slug' => Str::slug('Kuliner Tradisional Batak'),
                'duration' => '1 Hari',
                'location' => 'Medan - Toba Samosir',
                'description' => 'Mencicipi masakan tradisional Batak yang autentik. Nikmati Arsik ikan mas, Saksang, Babi Panggang Karo, dan minuman khas Tuak dalam suasana rumah adat Batak.',
                'price' => 400000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Wisata Budaya & Sejarah (Category 3)
            [
                'category_id' => 3,
                'name' => 'Heritage Tour Istana Maimun',
                'slug' => Str::slug('Heritage Tour Istana Maimun'),
                'duration' => '1 Hari',
                'location' => 'Kota Medan',
                'description' => 'Menyusuri peninggalan sejarah Kesultanan Deli. Kunjungi Istana Maimun, Masjid Raya Al Mashun, Menara Air Tirtanadi, dan Rumah Tjong A Fie dengan pemandu berpengalaman.',
                'price' => 200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Budaya Batak di Pulau Samosir',
                'slug' => Str::slug('Budaya Batak di Pulau Samosir'),
                'duration' => '2 Hari 1 Malam',
                'location' => 'Medan - Pulau Samosir',
                'description' => 'Imersi budaya Batak di Pulau Samosir. Kunjungi Museum Batak Tomok, lihat makam raja-raja Batak, saksikan tari-tarian tradisional, dan pelajari aksara Batak kuno.',
                'price' => 950000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Tour Sejarah Perkebunan Deli',
                'slug' => Str::slug('Tour Sejarah Perkebunan Deli'),
                'duration' => '1 Hari',
                'location' => 'Medan - Deli Serdang',
                'description' => 'Menelusuri jejak kejayaan perkebunan tembakau di era kolonial. Kunjungi bekas perkebunan, lihat arsitektur heritage, dan pelajari sejarah kemakmuran Medan tempo dulu.',
                'price' => 280000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('travel_packages')->insert($travelPackages);
    }
}
