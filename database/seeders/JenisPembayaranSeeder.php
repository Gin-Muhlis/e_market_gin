<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisPembayaran;

class JenisPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisPembayaran::factory()
            ->count(5)
            ->create();
    }
}
