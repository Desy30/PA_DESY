<?php

namespace Database\Seeders;

use App\Models\KategoriModel;
use App\Models\TransaksiModel;
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
        foreach (KategoriModel::all() as $kategori) {
            for ($i=0; $i < 5; $i++) {
                TransaksiModel::create([
                    'id_kategori' => $kategori->id,
                    'total' => fake()->randomNumber(5),
                    'tanggal' => fake()->dateTimeBetween('-2 year', 'now')
                ]);
            }
        }
    }
}


