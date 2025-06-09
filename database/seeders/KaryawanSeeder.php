<?php

namespace Database\Seeders;

use App\Models\KaryawanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'nama_karyawan' => 'Karyawan 1',
                'jabatan_karyawan' => 'Kasir',
                'gaji' => 5000000
            ]
            ];

            foreach ($datas as $data) {
                KaryawanModel::create([
                    'nama_karyawan' => $data['nama_karyawan'],
                    'jabatan_karyawan' => $data['jabatan_karyawan'],
                    'gaji' => $data['gaji'],
                ]);
            }
    }
}
