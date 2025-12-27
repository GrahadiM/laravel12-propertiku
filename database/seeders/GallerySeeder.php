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
        $galleries = \App\Models\Property::all();

        // Untuk setiap travel package (1-9), tambahkan 2-3 gambar
        foreach ($galleries as $property) {
            \App\Models\Gallery::create([
                'property_id' => $property->id,
                'path' => 'assets/gallery/property-default.png',
            ]);
        }
    }
}
