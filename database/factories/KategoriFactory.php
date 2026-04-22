<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kategori>
 */
class KategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Kategori::class;
    public function definition(): array
    {
        return [
        'nama_kategori' => $this->faker->unique()->randomElement([
            'Fiksi', 'Non-Fiksi', 'Edukasi', 'Teknologi', 'Kamus', 
            'Komik', 'Agama', 'Seni', 'Biografi', 'Sastra', 
            'Hukum', 'Bisnis', 'Kesehatan', 'Anak-anak', 'Sejarah'
        ])
        ];
    }
}
