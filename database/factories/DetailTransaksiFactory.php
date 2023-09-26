<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DetailTransaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailTransaksiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailTransaksi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jumlah_bayar' => $this->faker->randomNumber(2),
            'transaksi_id' => \App\Models\Transaksi::factory(),
            'jenis_pembayaran_id' => \App\Models\JenisPembayaran::factory(),
        ];
    }
}
