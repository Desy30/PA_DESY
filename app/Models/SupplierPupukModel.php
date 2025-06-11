<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierPupukModel extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'supplier_pupuk';

    protected $fillable = [
        'nama_supplier',
        'nomor_telepon_supplier',
        'alamat_supplier',
        'nomor_rekening_supplier',
        'keterangan',
    ];
    

}
