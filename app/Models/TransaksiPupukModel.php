<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class TransaksiPupukModel extends Model
{
    use HasUlids;

    protected $table = 'transaksi_pupuk_detail';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_transaksi',
        'jumlah_pupuk',
        'harga_perunit',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi', 'id');
    }
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'id_barang', 'id');
    }


}
