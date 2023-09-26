<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DetailPembelian;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailPembelianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailPembelian::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'harga_beli' => $this->faker->randomNumber(2),
            'jumlah' => $this->faker->randomNumber(0),
            'sub_total' => $this->faker->randomNumber(2),
            'pembelian_id' => \App\Models\Pembelian::factory(),
            'barang_id' => \App\Models\Barang::factory(),
        ];
    }
}
