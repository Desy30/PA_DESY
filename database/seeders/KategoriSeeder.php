<?php

namespace Database\Seeders;

use App\Models\KategoriModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'nama_kategori' => 'Penjualan Sawit',
                'tipe_form' => 'penjualan_sawit',
                'jenis_kategori' => 'pemasukan',
                'deskripsi' => 'Kategori untuk pemasukan',
            ],
            [
                'nama_kategori' => 'Penjualan Pupuk',
                'tipe_form' => 'penjualan_pupuk',
                'jenis_kategori' => 'pemasukan',
                'deskripsi' => 'Kategori untuk pemasukan',
            ],
            [
                'nama_kategori' => 'Sewa Timbangan',
                'tipe_form' => 'sewa_timbangan',
                'jenis_kategori' => 'pemasukan',
                'deskripsi' => 'Kategori untuk pemasukan',
            ],
            [
                'nama_kategori' => 'Pembelian Sawit',
                'tipe_form' => 'pembelian_sawit',
                'jenis_kategori' => 'pengeluaran',
                'deskripsi' => 'Kategori untuk pengeluaran',
            ],
            [
                'nama_kategori' => 'Kendaraan Operasional',
                'tipe_form' => 'kendaraan_operasional',
                'jenis_kategori' => 'pengeluaran',
                'deskripsi' => 'Kategori untuk pengeluaran',
            ],
            [
                'nama_kategori' => 'Gaji',
                'tipe_form' => 'pengeluaran_gaji',
                'jenis_kategori' => 'pengeluaran',
                'deskripsi' => 'Kategori untuk pengeluaran',
            ],
        ];

        foreach ($datas as $data) {
            KategoriModel::create([
                'nama_kategori' => $data['nama_kategori'],
                'tipe_form' => $data['tipe_form'],
                'jenis_kategori' => $data['jenis_kategori'],
                'deskripsi' => $data['deskripsi'],
            ]);
        }
    }
}
