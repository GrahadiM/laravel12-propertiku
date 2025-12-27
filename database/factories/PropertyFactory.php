<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(3);
        return [
            'category_id' => rand(1, 3), // Mengasumsikan ada 3 kategori
            'name' => $name,
            'slug' => Str::slug($name),
            'location' => $this->faker->address,
            'description' => $this->faker->paragraph(5),
            'price' => $this->faker->numberBetween(500000000, 2000000000), // 500jt - 2M
            'bedroom' => rand(1, 5),
            'bathroom' => rand(1, 3),
            'surface_area' => rand(60, 200) . ' m2',
            'building_area' => rand(36, 150) . ' m2',
            'certificate' => $this->faker->randomElement(['SHM', 'HGB', 'AJB']),
        ];
    }
}
