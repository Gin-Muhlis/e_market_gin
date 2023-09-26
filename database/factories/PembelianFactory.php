<?php

namespace Database\Factories;

use App\Models\Pembelian;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembelianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pembelian::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_masuk' => $this->faker->text(50),
            'tanggal_masuk' => $this->faker->date(),
            'total' => $this->faker->randomNumber(2),
            'pemasok_id' => \App\Models\Pemasok::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
