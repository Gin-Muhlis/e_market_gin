<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'technoadmin@admin.com',
                'password' => Hash::make('admintechno'),
            ]);
        $this->call(PermissionsSeeder::class);

        // $this->call(BarangSeeder::class);
        // $this->call(DetailPenjualanSeeder::class);
        // $this->call(DetailTransaksiSeeder::class);
        // $this->call(JenisPembayaranSeeder::class);
        // $this->call(PelangganSeeder::class);
        // $this->call(PemasokSeeder::class);
        // $this->call(PembelianSeeder::class);
        // $this->call(PenjualanSeeder::class);
        // $this->call(ProdukSeeder::class);
        // $this->call(RombelSeeder::class);
        // $this->call(TransaksiSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
