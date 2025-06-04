<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'barang';
    protected $fillable = [
        'id_supplier',
        'nama_barang',
        'stock_barang',
        'harga_jual_barang',
        'harga_beli_barang',
    ];


    public function supplier()
    {
        return $this->belongsTo(SupplierPupukModel::class, 'id_supplier');
    }
}
