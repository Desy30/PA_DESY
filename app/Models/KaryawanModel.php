<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class KaryawanModel extends Model
{
    use HasUuids;

    protected $table = 'karyawan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_karyawan',
        'jabatan_karyawan',
        'gaji',
    ];


}
