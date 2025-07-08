<?php

namespace Database\Seeders;

use App\Models\PksModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'nama_pks' => 'Pks 1',
                'nomor_telepon_pks' => '08123456789',
                'alamat_pks' => 'Jl. Contoh 1',
            ]
        ];
        foreach ($datas as $data) {
            PksModel::create([
                'nama_pks' => $data['nama_pks'],
                'nomor_telepon_pks' => $data['nomor_telepon_pks'],
                'alamat_pks' => $data['alamat_pks'],
            ]);
        }
    }
}
