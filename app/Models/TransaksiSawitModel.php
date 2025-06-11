<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TransaksiSawitModel extends Model
{
    use HasUuids;

    protected $table = 'transaksi_sawit_detail';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_transaksi',
        'bruto',
        'potongan',
        'tara',
        'berat_bersih',
        'harga',
        'netto',
        'surat_pengantar',
        'bon',
    ];
    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi', 'id');
    }
}
