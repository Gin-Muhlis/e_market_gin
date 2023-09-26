<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PelangganFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pelanggan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_pelanggan' => $this->faker->text(50),
            'nama' => $this->faker->text(50),
            'alamat' => $this->faker->text(200),
            'no_telp' => $this->faker->text(20),
            'email' => $this->faker->unique->email(),
        ];
    }
}
