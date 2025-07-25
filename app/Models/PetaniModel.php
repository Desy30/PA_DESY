<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PetaniModel extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'petani'; //memastikan yang digunakan adalah tabel petani

    protected $fillable = [
        'id',
        'nama_petani',
        'nomor_telepon_petani',
        'alamat_petani',
        'nomor_rekening_petani',
    ];

}
