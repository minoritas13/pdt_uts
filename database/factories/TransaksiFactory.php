<?php

namespace Database\Factories;

use App\Models\PelangganLokal;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Transaksi::class;
    public function definition(): array
    {
        return [
            'no_struk' => 'STRUK-' . strtoupper($this->faker->bothify('??###')),
            'pelanggan_id' => PelangganLokal::inRandomOrder()->first()->id,
            'total' => 0, // Akan dihitung manual di Seeder
            'status_sinkronisasi' => 'SUKSES',
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
