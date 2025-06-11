<?php

namespace App\Models;

use App\Models\KaryawanModel;
use App\Models\TransaksiModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TransaksiGajiModel extends Model
{
    use HasUuids;

    protected $table = 'transaksi_gaji';

    protected $primaryKey = 'id';

    protected $fillable =[
        'id_transaksi',
        'id_karyawan',
        'jumlah_gaji',
        'periode',
        'tunjangan',
        'potongan',
        'keterangan'
    ];
    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi', 'id');
    }

    public function karyawan()
    {
        return $this->belongsTo(KaryawanModel::class, 'id_karyawan', 'id');
    }
}
