<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Barang::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_barang' => $this->faker->text(50),
            'nama_barang' => $this->faker->text(100),
            'satuan' => $this->faker->text(10),
            'harga_jual' => $this->faker->randomNumber(2),
            'stok' => $this->faker->randomNumber(0),
            'ditarik' => $this->faker->randomNumber(0),
            'user_id' => \App\Models\User::factory(),
            'produk_id' => \App\Models\Produk::factory(),
        ];
    }
}
