<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PetaniSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RolePermissionSeeder::class,
            KategoriSeeder::class,
            // TransaksiSeeder::class,
            PksSeeder::class,
            PetaniSeeder::class,
            SupplierSeeder::class,
            BarangSeeder::class,
            KaryawanSeeder::class
        ]);
    }
}
