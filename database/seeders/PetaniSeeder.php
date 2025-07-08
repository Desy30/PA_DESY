<?php

namespace Database\Seeders;

use App\Models\PetaniModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetaniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'nama_petani' => 'Petani 1',
                'nomor_telepon_petani' => '08123456789',
                'alamat_petani' => 'Jl. Contoh 1',
                'nomor_rekening_petani' => '1234567890',
            ]

            ];
            foreach ($datas as $data) {
                PetaniModel::create([
                    'nama_petani' => $data['nama_petani'],
                    'nomor_telepon_petani' => $data['nomor_telepon_petani'],
                    'alamat_petani' => $data['alamat_petani'],
                    'nomor_rekening_petani' => $data['nomor_rekening_petani'],
                ]);
            }
    }
}
