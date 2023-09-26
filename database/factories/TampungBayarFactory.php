<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TampungBayar;
use Illuminate\Database\Eloquent\Factories\Factory;

class TampungBayarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TampungBayar::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total' => $this->faker->randomNumber(2),
            'terima' => $this->faker->randomNumber(2),
            'kembali' => $this->faker->randomNumber(2),
            'penjualan_id' => \App\Models\Penjualan::factory(),
        ];
    }
}
