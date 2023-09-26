<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list barangs']);
        Permission::create(['name' => 'view barangs']);
        Permission::create(['name' => 'create barangs']);
        Permission::create(['name' => 'update barangs']);
        Permission::create(['name' => 'delete barangs']);

        Permission::create(['name' => 'list detailpembelians']);
        Permission::create(['name' => 'view detailpembelians']);
        Permission::create(['name' => 'create detailpembelians']);
        Permission::create(['name' => 'update detailpembelians']);
        Permission::create(['name' => 'delete detailpembelians']);

        Permission::create(['name' => 'list detailpenjualans']);
        Permission::create(['name' => 'view detailpenjualans']);
        Permission::create(['name' => 'create detailpenjualans']);
        Permission::create(['name' => 'update detailpenjualans']);
        Permission::create(['name' => 'delete detailpenjualans']);

        Permission::create(['name' => 'list detailtransaksis']);
        Permission::create(['name' => 'view detailtransaksis']);
        Permission::create(['name' => 'create detailtransaksis']);
        Permission::create(['name' => 'update detailtransaksis']);
        Permission::create(['name' => 'delete detailtransaksis']);

        Permission::create(['name' => 'list jenispembayarans']);
        Permission::create(['name' => 'view jenispembayarans']);
        Permission::create(['name' => 'create jenispembayarans']);
        Permission::create(['name' => 'update jenispembayarans']);
        Permission::create(['name' => 'delete jenispembayarans']);

        Permission::create(['name' => 'list pelanggans']);
        Permission::create(['name' => 'view pelanggans']);
        Permission::create(['name' => 'create pelanggans']);
        Permission::create(['name' => 'update pelanggans']);
        Permission::create(['name' => 'delete pelanggans']);

        Permission::create(['name' => 'list pemasoks']);
        Permission::create(['name' => 'view pemasoks']);
        Permission::create(['name' => 'create pemasoks']);
        Permission::create(['name' => 'update pemasoks']);
        Permission::create(['name' => 'delete pemasoks']);

        Permission::create(['name' => 'list pembelians']);
        Permission::create(['name' => 'view pembelians']);
        Permission::create(['name' => 'create pembelians']);
        Permission::create(['name' => 'update pembelians']);
        Permission::create(['name' => 'delete pembelians']);

        Permission::create(['name' => 'list penjualans']);
        Permission::create(['name' => 'view penjualans']);
        Permission::create(['name' => 'create penjualans']);
        Permission::create(['name' => 'update penjualans']);
        Permission::create(['name' => 'delete penjualans']);

        Permission::create(['name' => 'list produks']);
        Permission::create(['name' => 'view produks']);
        Permission::create(['name' => 'create produks']);
        Permission::create(['name' => 'update produks']);
        Permission::create(['name' => 'delete produks']);

        Permission::create(['name' => 'list rombels']);
        Permission::create(['name' => 'view rombels']);
        Permission::create(['name' => 'create rombels']);
        Permission::create(['name' => 'update rombels']);
        Permission::create(['name' => 'delete rombels']);

        Permission::create(['name' => 'list transaksis']);
        Permission::create(['name' => 'view transaksis']);
        Permission::create(['name' => 'create transaksis']);
        Permission::create(['name' => 'update transaksis']);
        Permission::create(['name' => 'delete transaksis']);

        Permission::create(['name' => 'list tampungbayars']);
        Permission::create(['name' => 'view tampungbayars']);
        Permission::create(['name' => 'create tampungbayars']);
        Permission::create(['name' => 'update tampungbayars']);
        Permission::create(['name' => 'delete tampungbayars']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('technoadmin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
