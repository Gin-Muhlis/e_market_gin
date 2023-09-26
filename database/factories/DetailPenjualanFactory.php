<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailPenjualanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailPenjualan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'harga_jual' => $this->faker->randomNumber(2),
            'jumlah' => $this->faker->randomNumber(0),
            'sub_total' => $this->faker->randomNumber(2),
            'penjualan_id' => \App\Models\Penjualan::factory(),
            'barang_id' => \App\Models\Barang::factory(),
        ];
    }
}
