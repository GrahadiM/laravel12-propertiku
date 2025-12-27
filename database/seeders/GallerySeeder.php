<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [];

        // Untuk setiap travel package (1-9), tambahkan 2-3 gambar
        for ($i = 1; $i <= 9; $i++) {
            $galleries = array_merge($galleries, [
                [
                    'travel_package_id' => $i,
                    'path' => 'assets/gallery/package' . $i . '.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        DB::table('galleries')->insert($galleries);
    }
}
