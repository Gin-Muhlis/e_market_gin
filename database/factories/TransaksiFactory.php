<?php

namespace Database\Factories;

use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaksi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_transaksi' => $this->faker->text(255),
            'tgl_bayar' => $this->faker->date(),
            'user_input' => $this->faker->text(255),
            'rombel_id' => \App\Models\Rombel::factory(),
        ];
    }
}
