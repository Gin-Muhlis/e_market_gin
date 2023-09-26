<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailPenjualan;

class DetailPenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailPenjualan::factory()
            ->count(5)
            ->create();
    }
}
