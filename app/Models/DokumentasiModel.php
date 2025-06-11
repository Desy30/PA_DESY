<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DokumentasiModel extends Model
{
    use HasFactory,HasUuids;

    public $table = 'dokumentasi';

    public $fillable = [
        'id',
        'id_transaksi',
        'id_transaksi_items',
        'nomor_surat',
        'tanggal',
        'file_surat',
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
