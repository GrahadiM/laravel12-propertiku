<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            CategorySeeder::class,
            // PropertySeeder::class,
            // GallerySeeder::class,
            PostSeeder::class,
        ]);
        \App\Models\Property::factory()->count(10)->create();
        $this->call([
            GallerySeeder::class,
        ]);
    }
}
