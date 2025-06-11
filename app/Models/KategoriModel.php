<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriModel extends Model
{
    use HasFactory, HasUuids;

    public $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'jenis_kategori',
        'tipe_form',
        'deskripsi',
        'is_pengiriman',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];


    public function transactions(): HasMany
    {
        return $this->hasMany(TransaksiModel::class, 'id_kategori', 'id');
    }
}
