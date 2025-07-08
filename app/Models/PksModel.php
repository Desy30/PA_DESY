<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PksModel extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'pks';

    protected $fillable = [
        'id',
        'nama_pks',
        'nomor_telepon_pks',
        'alamat_pks',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];
}
