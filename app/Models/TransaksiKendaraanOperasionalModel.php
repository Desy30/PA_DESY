<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TransaksiKendaraanOperasionalModel extends Model
{
    use HasUuids;

    protected $table = 'transaksi_kendaraan_operasional';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_transaksi',
        'jenis_kendaraan',
        'jenis_pengeluaran',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi', 'id');
    }
}
