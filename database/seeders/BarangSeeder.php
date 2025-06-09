<?php

namespace Database\Seeders;

use App\Models\BarangModel;
use App\Models\SupplierPupukModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'nama_barang' => ' Pupuk MPK',
            'stock_barang' => 10,
            'harga_jual_barang' => 10000,
            'harga_beli_barang' => 5000,
        ];


        foreach (SupplierPupukModel::all() as $supplier) {
            BarangModel::create([
                'nama_barang' => $data['nama_barang'],
                'stock_barang' => $data['stock_barang'],
                'harga_jual_barang' => $data['harga_jual_barang'],
                'harga_beli_barang' => $data['harga_beli_barang'],
                'id_supplier' => $supplier->id
            ]);
        }
    }
}
