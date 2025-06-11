<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{

    public function run(): void
    {
        // Buat role
        $roles = [
            Role::firstOrCreate(['name' => 'pemilik']),
            Role::firstOrCreate(['name' => 'kasir'])
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Buat permission
        $permissions = [
            'akses dashboard',
            'kelola pengguna',
            'lihat laporan',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Assign permission ke role
        $kasir = Role::where('name', 'kasir')->first();
        $pemilik = Role::where('name', 'pemilik')->first();

        $kasir->givePermissionTo(['akses dashboard']);
        $pemilik->givePermissionTo(['akses dashboard', 'kelola pengguna', 'lihat laporan']);

        // Buat user jika belum ada
        $user = User::firstOrCreate(
            ['username' => 'desy'],
            [
                'name' => 'Desy',
                'password' => Hash::make('Desy123'),
            ]
        );

        $user->assignRole('pemilik');
    }
}
