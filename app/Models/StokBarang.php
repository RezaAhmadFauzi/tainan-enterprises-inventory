<?php

namespace App\Models;

use App\Observers\StokBarangObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'kode_barang',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'stok_akhir',
        'tanggal',
        'created_at',
        'updated_at'
    ];
}
