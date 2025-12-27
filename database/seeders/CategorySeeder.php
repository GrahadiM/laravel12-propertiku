<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Rumah Tinggal', 'Apartemen', 'Ruko & Komersial'];

        foreach ($categories as $cat) {
            Category::create(['title' => $cat]);
        }
    }
}
