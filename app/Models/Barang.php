<?php

namespace App\Models;

use App\Observers\BarangObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    
    public $incrementing = false;
    protected $keyType = 'string';
    
    const STATUS_ACTIVE = 1;
    const STATUS_UNACTIVE = 50;

    private static $statusName = array(
        self::STATUS_ACTIVE => "ACTIVE",
        self::STATUS_UNACTIVE => "UNACTIVE"
    );

    public function getStatusNameAttribute(): string
    {
        return self::$statusName[$this->status];
    }


    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'nama_barang',
        'kode_barang',
        'id_kategori',
        'id_brand',
        'atribute',
        'status',
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();

        self::observe(BarangObserver::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_barang');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_barang');
    }

    protected static function booted () {
        static::deleting(function(Barang $barang) {
             $barang->barangMasuk()->delete();
             $barang->barangKeluar()->delete();
        });
    }
    
}
