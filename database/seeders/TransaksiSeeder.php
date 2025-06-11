<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $datas = [ //ini salah karena tabelnya tidak ada.
                [
                    'sumber_pemasukan' => 'Penjualan Sawit',
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'pembayaran' => 'Cash',
                    'berat_bersih' => 1520.75,
                    'pks_id' => 1,
                    'surat_pengantar' => 'uploads/surat_pengantar1.pdf',
                    'bon' => 'uploads/bon1.pdf',
                    'jumlah' => 3041500,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'sumber_pemasukan' => 'Penjualan Sawit',
                    'tanggal' => Carbon::now()->subDays(1)->format('Y-m-d'),
                    'pembayaran' => 'Cash',
                    'berat_bersih' => 980.50,
                    'pks_id' => 2,
                    'surat_pengantar' => 'uploads/surat_pengantar2.pdf',
                    'bon' => 'uploads/bon2.pdf',
                    'jumlah' => 1961000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
        }
    }

