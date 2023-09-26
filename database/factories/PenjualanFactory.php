<?php

namespace Database\Factories;

use App\Models\Penjualan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenjualanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penjualan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_faktur' => $this->faker->text(50),
            'tgl_faktur' => $this->faker->date(),
            'total_bayar' => $this->faker->randomNumber(2),
            'pelanggan_id' => \App\Models\Pelanggan::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
