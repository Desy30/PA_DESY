<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiItemModel extends Model
{
    use HasFactory,HasUuids;
    public $table = 'transaksi_items';
    public $fillable = [
        'id',
        'id_barang',
        'jumlah', //qty
        'harga'];


    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi');
    }
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'id_barang');
    }
}
