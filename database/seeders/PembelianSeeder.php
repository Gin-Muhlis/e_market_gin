<?php

namespace Database\Seeders;

use App\Models\Pembelian;
use Illuminate\Database\Seeder;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pembelian::factory()
            ->count(5)
            ->create();
    }
}
