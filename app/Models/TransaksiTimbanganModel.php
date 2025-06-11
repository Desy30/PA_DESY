<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TransaksiTimbanganModel extends Model
{
    use HasUuids;

    protected $table = 'transaksi_timbangan';

    protected $fillable = [
        'id_transaksi',
        'nama',
    ];
    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi');
    }
}
