<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Wisata Alam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Wisata Kuliner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Wisata Budaya & Sejarah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
