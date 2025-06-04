<?php

namespace Database\Seeders;

use App\Models\SupplierPupukModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'nama_supplier' => 'Supplier 1',
                'nomor_telepon_supplier' => '08123456789',
                'alamat_supplier' => 'Jl. Contoh 1',
                'nomor_rekening_supplier' => '1234567890',
                'keterangan' => 'Supplier 1',
            ]
            ];
            foreach ($datas as $data) {
                SupplierPupukModel::create([
                    'nama_supplier' => $data['nama_supplier'],
                    'nomor_telepon_supplier' => $data['nomor_telepon_supplier'],
                    'alamat_supplier' => $data['alamat_supplier'],
                    'nomor_rekening_supplier' => $data['nomor_rekening_supplier'],
                    'keterangan' => $data['keterangan'],
                ]);
            }
    }
}
