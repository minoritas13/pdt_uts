<?php

namespace Database\Factories;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Buku::class;
    public function definition(): array
    {
        return [
            'kategori_id' => Kategori::inRandomOrder()->first()->id,
            'penerbit_id' => Penerbit::inRandomOrder()->first()->id,
            'isbn' => $this->faker->unique()->isbn13(),
            'judul' => $this->faker->sentence(3),
            'penulis' => $this->faker->name(),
            'harga_nasional' => $this->faker->numberBetween(45, 300) * 1000,
        ];
    }
}
