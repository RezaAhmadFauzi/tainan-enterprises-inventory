<?php

namespace App\Models;

use App\Observers\BarangKeluarObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
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
        'id_barang',
        'kode_barang',
        'tanggal_keluar',
        'jumlah_keluar',
        'tujuan',
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();

        self::observe(BarangKeluarObserver::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
