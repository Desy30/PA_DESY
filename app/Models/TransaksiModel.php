<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TransaksiSawitModel;

class TransaksiModel extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'transaksi';

    protected $fillable = [
        'id_petani',
        'id_pks',
        'id_supplier',
        'id_kategori',
        'id_barang',
        'id_karyawan',
        'id_user',
        'total',
        'tanggal',
        'metode_pembayaran',
        'status_pengiriman',
        'bukti_transaksi',
        'keterangan'
    ];



    public  function petani () {
        return $this->belongsTo(PetaniModel::class, 'id_petani');
    }

    public function pks () {
        return $this->belongsTo(PksModel::class, 'id_pks');
    }

    public function supplier_pupuk () {
        return $this->belongsTo(SupplierPupukModel::class, 'id_supplier');
    }

    public function kategori () {
        return $this->belongsTo(KategoriModel::class, 'id_kategori');
    }

    public function user () {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function transaksiSawit()
    {
        return $this->hasOne(TransaksiSawitModel::class, 'id_transaksi');
    }
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'id_barang');
    }
    public function transaksiPupuk()
    {
        return $this->hasOne(TransaksiPupukModel::class, 'id_transaksi');
    }

    public function transaksiGaji()
    {
        return $this->hasOne(TransaksiGajiModel::class, 'id_transaksi');
    }

    public function transaksiTimbangan()
    {
        return $this->hasOne(TransaksiTimbanganModel::class, 'id_transaksi');
    }

    public function transaksiKendaraanOperasional()
    {
        return $this->hasOne(TransaksiKendaraanOperasionalModel::class, 'id_transaksi');
    }

    public function transaksiItem()
    {
        return $this->hasOne(TransaksiItemModel::class, 'id_transaksi');
    }
    public function karyawan()
    {
        return $this->belongsTo(KaryawanModel::class, 'id_karyawan');
    }

}


