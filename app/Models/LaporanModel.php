<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanModel extends Model
{
    use HasFactory,HasUuids;

    public $table = 'laporan';

    public $fillable = [
        'id',
        'id_transaksi_items',
        'jenis_transaksi',
        'total',
        'tanggal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi');
    }
    public function transaksi_items()
    {
        return $this->belongsTo(TransaksiItemModel::class, 'id_transaksi_items');
    }

}
